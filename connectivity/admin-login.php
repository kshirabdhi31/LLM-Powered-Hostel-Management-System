<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Hostel Management</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="script.js" defer></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://media.gettyimages.com/id/1279615641/vector/abstract-blue-background-geometric-texture.jpg?s=612x612&w=0&k=20&c=hJoOBakUkcGCzbdMU2W5MRyaNXYBwwpCI12CEVMP1Qc=') no-repeat center center fixed;
            background-size: cover;
        }
        .login-card {
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background-color: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center">
    <div class="login-card w-full max-w-md p-8 space-y-6 rounded-xl">
        <div class="text-center">
            <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                <i class="fas fa-user-shield text-blue-600 text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Admin Login</h1>
            <p class="mt-2 text-gray-600">Enter your credentials to access the dashboard</p>
        </div>
        
        <form class="space-y-4" action="php/php/admin_login.php" method="POST" >
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" id="username"  name="username" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Enter admin username" required>
                </div>
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="password" name="password" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your password" required>
                </div>
            </div>
            
            <div class="flex items-center justify-between">
               
              
            </div>
            
            
            <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        Login
    </button>
            </div>
        </form>
        
        <div class="text-center text-sm text-gray-500">
            <p>Not an admin? <a href="./index.php" class="text-green-600 hover:text-green-500">Go back</a></p>
        </div>
    </div>
    
    <script>
    function validateForm() {
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();
        
        // Simple client-side validation example
        if (username === '' || password === '') {
            alert('Please fill in both username and password fields');
            return false;
        }
        return true;
    }
</script>
    <script>
    // Check for invalid login parameter in URL
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            alert('Invalid username or password! Please try again.');
            // Clear the error parameter from URL
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });
</script>
</body>
</html>