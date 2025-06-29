import subprocess
import platform
import time
import json
import os
import shutil

from fastapi import FastAPI, Request
from fastapi.middleware.cors import CORSMiddleware
from fastapi.staticfiles import StaticFiles
from fastapi.templating import Jinja2Templates
from fastapi.responses import HTMLResponse
from pydantic import BaseModel

from langchain.chains import RetrievalQA
from langchain_community.vectorstores import Chroma
from langchain_huggingface import HuggingFaceEmbeddings
from langchain_ollama import OllamaLLM
from langchain.prompts import PromptTemplate
from langchain.schema import Document

# Suppress warnings
os.environ["TF_CPP_MIN_LOG_LEVEL"] = "3"
os.environ["TF_ENABLE_ONEDNN_OPTS"] = "0"

# === START OLLAMA AUTOMATICALLY ===
def start_ollama():
    try:
        print("[INFO] Checking if 'llama3' model is available...")
        result = subprocess.run(["ollama", "list"], capture_output=True, text=True)
        if "llama3" not in result.stdout:
            print("[INFO] Pulling 'llama3' model...")
            subprocess.run(["ollama", "pull", "llama3"], check=True)

        print("[INFO] Starting 'ollama run llama3' in a new terminal...")
        if platform.system() == "Windows":
            subprocess.Popen(["start", "cmd", "/k", "ollama run llama3"], shell=True)
        else:
            subprocess.Popen(["ollama", "run", "llama3"])

        time.sleep(5)  # Give it time to boot up
    except Exception as e:
        print(f"[ERROR] Could not start Ollama: {e}")

start_ollama()

# === Load JSON and Prepare Embeddings ===
def load_data(filepath="data.json"):
    with open(filepath, "r") as f:
        return json.load(f)

def prepare_docs(raw_data):
    docs = []
    for entry in raw_data:
        if entry.get("type") == "table":
            table_name = entry["name"]
            rows = entry["data"]
            for row in rows:
                text = f"Table: {table_name}. " + ", ".join([f"{k}: {v}" for k, v in row.items()])
                docs.append(Document(page_content=text))
    return docs

# === Setup Chroma DB ===
CHROMA_DIR = "db"
if os.path.exists(CHROMA_DIR):
    shutil.rmtree(CHROMA_DIR)

raw_data = load_data()
docs = prepare_docs(raw_data)

embedding = HuggingFaceEmbeddings(model_name="sentence-transformers/all-MiniLM-L6-v2")
vectorstore = Chroma.from_documents(documents=docs, embedding=embedding, persist_directory=CHROMA_DIR)

# === Prompt ===
custom_prompt = PromptTemplate.from_template("""
You are a helpful assistant. ONLY answer using the context provided.
If the answer is not found in the context, say "I don't know".

Context:
{context}

Question:
{question}
""")

# === LLM and QA Chain ===
llm = OllamaLLM(model="llama3", temperature=0.6)
retriever = vectorstore.as_retriever(search_kwargs={"k": 5})
qa_chain = RetrievalQA.from_chain_type(
    llm=llm,
    retriever=retriever,
    chain_type_kwargs={"prompt": custom_prompt}
)

# === FastAPI App Setup ===
app = FastAPI()

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# === API Model and Endpoint ===
class QueryRequest(BaseModel):
    question: str

@app.post("/query")
def get_answer(req: QueryRequest):
    print(f"[INFO] Received query: {req.question}")
    try:
        result = qa_chain.invoke(req.question)
        print(f"[INFO] Answer: {result['result']}")
        return {"answer": result["result"]}
    except Exception as e:
        print(f"[ERROR] During LLM invocation: {e}")
        return {"answer": "Sorry, something went wrong."}

# === Serve Static Files and Frontend ===
app.mount("/static", StaticFiles(directory="static"), name="static")
templates = Jinja2Templates(directory="templates")

@app.get("/", response_class=HTMLResponse)
def serve_home(request: Request):
    return templates.TemplateResponse("index.html", {"request": request})
