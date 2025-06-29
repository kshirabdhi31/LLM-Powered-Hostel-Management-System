<!DOCTYPE html>
<html lang="en">

<!DOCTYPE php>
<?php

?>
<head>
  <meta charset="UTF-8">
  <title>RAG Query System</title>
  <style>
    body {
  font-family: Arial, sans-serif;
  background: #f0f4f8;
  padding: 40px;
  text-align: center;
}

.container {
  background: white;
  padding: 20px;
  border-radius: 10px;
  max-width: 700px;
  margin: auto;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

textarea {
  width: 100%;
  height: 100px;
  margin-bottom: 15px;
  padding: 10px;
  font-size: 16px;
}

button {
  padding: 10px 25px;
  font-size: 16px;
  cursor: pointer;
  background: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
}

#answerBox {
  margin-top: 20px;
  text-align: left;
}

  </style>
</head>
<body>
  <div class="container">
    <h1>Ask Your Question</h1>
    <textarea id="question" placeholder="Enter your query..."></textarea>
    <button onclick="askQuestion()">Ask</button>
    <div id="answerBox">
      <h2>Answer:</h2>
      <p id="answerText">Your answer will appear here...</p>
    </div>
  </div>
  <script>
    function askQuestion() {
  const question = document.getElementById("question").value;
  const answerBox = document.getElementById("answerText");
  answerBox.textContent = "Loading...";

  fetch("http://localhost:8000/query", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({ question })
  })
  .then(response => response.json())
  .then(data => {
    answerBox.textContent = data.answer;
  })
  .catch(error => {
    answerBox.textContent = "Error: Could not get answer.";
    console.error(error);
  });
}

  </script>
</body>
</html>
