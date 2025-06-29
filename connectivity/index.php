<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="script.js" defer></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('https://images.unsplash.com/photo-1557683316-973673baf926?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-9 space-y-6 bg-blue-100 rounded-2xl shadow-lg">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-800" style="font-family: 'Arial', sans-serif;">MAHE Hostel Management</h1>
            <p class="mt-2 text-gray-600">Please select your login type:</p>
        </div>
        
        <div class="space-y-4">
            <a href="./admin-login.php" class="block w-full px-4 py-3 text-center text-white bg-blue-500 rounded-lg hover:bg-blue-700 transition duration-300">
                <i class="fas fa-user-shield mr-2"></i> Login as Admin
            </a>
            
            <a href="./student-login.php" class="block w-full px-4 py-3 text-center text-white bg-teal-500 rounded-lg hover:bg-teal-700 transition duration-300">
                <i class="fas fa-user-graduate mr-2"></i> Login as Student
            </a>
        </div>
        
        <div class="text-center text-sm text-gray-500">
            <p>Need help? Contact support@MAHEhostel.com</p>
        </div>
    </div>
</body>
</html>