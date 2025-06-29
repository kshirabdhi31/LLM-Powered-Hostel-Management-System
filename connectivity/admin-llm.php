<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mess Management | Hostel Admin</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #aabde4;
        }
        .sidebar {
            transition: all 0.3s;
            width: 300px;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            height: 100vh;
        }
        .sidebar a {
            transition: all 0.3s;
            margin: 0 8px;
            border-radius: 8px;
            padding: 10px 12px;
        }
        .sidebar a:hover {
            transform: translateX(5px);
        }
    </style>
</head>
<body class="flex h-screen">
    <!-- Sidebar -->
    <div class="sidebar text-white p-6 hidden md:block">
        <div class="flex items-center justify-center p-3 mb-3">
            <i class="fas fa-user-shield text-4xl"></i>
        </div>
        <nav>
            <ul class="space-y-2">
                <li><a href="admin-dashboard.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700"><i class="fas fa-arrow-left w-6 text-center"></i><span>Back to Dashboard</span></a></li>
                <li><a href="admin-students.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700"><i class="fas fa-users w-6 text-center"></i><span>Student Details</span></a></li>
                <li><a href="admin-attendance.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700"><i class="fas fa-calendar-check w-6 text-center"></i><span>Upload Attendance</span></a></li>
                <li><a href="admin-notices.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700"><i class="fas fa-bullhorn w-6 text-center"></i><span>Upload Notices</span></a></li>
                <li><a href="admin-payments.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700"><i class="fas fa-money-check-alt w-6 text-center"></i><span>Check Fee Payments</span></a></li>
                <li><a href="admin-guests.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700"><i class="fas fa-user-friends w-6 text-center"></i><span>Manage Guests</span></a></li>
                <li><a href="admin-maintenance.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700"><i class="fas fa-tools w-6 text-center"></i><span>Maintenance Requests</span></a></li>
                <li><a href="admin-llm.php" class="flex items-center space-x-3 p-3 bg-gray-700"><i class="fas fa-tools w-6 text-center"></i><span>AI Chat Bots</span></a></li>
                <li><a href="admin-complaints.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700"><i class="fas fa-exclamation-circle w-6 text-center"></i><span>Complaints</span></a></li>
                <li><a href="index.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700 mt-8"><i class="fas fa-sign-out-alt w-6 text-center"></i><span>Logout</span></a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Mess Management</h1>

        <!-- LLM Query Box -->
        <div class="bg-white rounded-lg shadow p-6 max-w-3xl">
            <h2 class="text-xl font-semibold mb-4">Ask a Question (LLM Powered)</h2>
            <textarea id="question" class="w-full p-3 border rounded mb-4" placeholder="Enter your query..."></textarea>
            <button onclick="askQuestion()" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Ask</button>
            <div id="answerBox" class="mt-6">
                <h3 class="font-semibold text-lg">Answer:</h3>
                <p id="answerText" class="mt-2 text-gray-700">Your answer will appear here...</p>
            </div>
        </div>
    </div>

    <!-- JS -->
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
