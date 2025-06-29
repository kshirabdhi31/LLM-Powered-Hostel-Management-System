<?php
// Start session and check login
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: php/php/student-login.php");
    exit();
}
include('php/php/db_connection.php');

// Get student ID from session
$reg_no = $_SESSION['student_id'];

// Fetch student details from database
$query = "SELECT * FROM complaint WHERE student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $reg_no);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints | Hostel Student</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color:rgb(209, 248, 254);
        }
        .sidebar {
            transition: all 0.3s;
            width: 300px;
            background: linear-gradient(135deg, #1e343b 0%, #023c58 100%);
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
            background-color: #334155;
        }
        .btn-primary {
            background-color: #3b82f6;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
        }
        .highlight-card {
            background: white;
            border-left: 4px solid #21b8da;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .accent-text {
            color: #103c4d;
        }
        .accent-bg {
            background-color: #a3e1ef;
        }
        .form-input {
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            width: 100%;
            transition: all 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .user-badge {
            background-color: #3b82f6;
        }
    </style>
</head>
<body class="flex h-screen flex-row">
<div class="sidebar text-white p-6 flex-shrink-0 hidden md:block">
        <div class="flex items-center justify-center p-3 mb-3">
            <i class="fas fa-user-graduate text-4xl"></i>
        </div>
        
        <nav>
        <ul class="space-y-2 text-lg">
        <li>
                    <a href="student-dashboard.php" class="flex items-center space-x-3 p-3">
                        <i class="fas fa-arrow-left text-md w-4 text-center"></i>
                        <span class="text-sm">Back to Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="student-profile.php" class="flex items-center space-x-3 p-3">
                        <i class="fas fa-user text-md w-4 text-center"></i>
                        <span class="text-sm">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="student-guestlog.php" class="flex items-center space-x-3 p-3">
                        <i class="fas fa-users text-md w-4 text-center"></i>
                        <span class="text-sm">Guest Log</span>
                    </a>
                </li>
                <li>
                    <a href="student-fees.php" class="flex items-center space-x-3 p-3 ">
                        <i class="fas fa-money-bill-wave text-md w-4 text-center"></i>
                        <span class="text-sm">Fee Payments</span>
                    </a>
                </li>
                
                <li>
                    <a href="student-attendance.php" class="flex items-center space-x-3 p-3">
                        <i class="fas fa-clipboard-check text-md w-6 text-center"></i>
                        <span class="text-sm">Attendance Log</span>
                    </a>
                </li>
                <li>
                    <a href="student-mess.php" class="flex items-center space-x-3 p-3">
                        <i class="fas fa-users text-md w-6 text-center"></i>
                        <span class="text-sm">Mess</span>
                    </a>
                </li>
                <li>
                    <a href="student-maintenance.php" class="flex items-center space-x-3 p-3">
                        <i class="fas fa-tools text-md w-6 text-center"></i>
                        <span class="text-sm">Maintenance Requests</span>
                    </a>
                </li>
                <li>
                    <a href="student-notices.php" class="flex items-center space-x-3 p-3">
                        <i class="fas fa-bell text-md w-6 text-center"></i>
                        <span class="text-sm">Check Notices</span>
                    </a>
                </li>
                <li>
                    <a href="student-complaints.php" class="flex items-center space-x-3 p-3 bg-teal-900">
                        <i class="fas fa-exclamation-triangle text-md w-6 text-center"></i>
                        <span class="text-sm">Raise Complaints</span>
                    </a>
                </li>
                <li>
                    <a href="index.php" class="flex items-center space-x-3 p-3 mt-8">
                        <i class="fas fa-sign-out-alt text-md w-6 text-center"></i>
                        <span class="text-sm">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="flex-1 overflow-auto">
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-800">Submit Complaint</h1>
            </div>
            <div class="flex items-center space-x-4">
                <button class="text-gray-600">
                    <i class="fas fa-bell"></i>
                </button>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full user-badge flex items-center justify-center text-white">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="hidden md:inline">Student</span>
                </div>
            </div>
        </header>

        <div class="p-6">
            
            <div class="highlight-card rounded-md shadow p-6 mb-6">
                <h2 class="text-md font-semibold mb-4 accent-text">New Complaint</h2>
                <form action="php/php/complain_stud.php" method="post">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2 font-medium">Complaint Type</label>
                        <select class="form-input" name="complaint_type">
                            <option>Noise</option>
                            <option>Cleanliness</option>
                            <option>Facilities</option>
                            <option>Security</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2 font-medium">Description</label>
                        <textarea name="description" class="form-input h-32" placeholder="Describe your complaint in detail"></textarea>
                    </div>
                    <button type="submit" class="btn-primary w-full">
                        <i class="fas fa-paper-plane mr-2"></i> Submit Complaint
                    </button>
                </form>
            </div>
            
            <div class="bg-white rounded-md shadow overflow-hidden">
                <div class="p-4 border-b accent-bg">
                    <h2 class="text-md font-semibold accent-text">My Complaints</h2>
                </div>
                <div class="divide-y divide-gray-200">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="p-4 hover:bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium">Noise Complaint</h3>
                                <p class="text-sm text-gray-600">complaint type: <?php echo htmlspecialchars($row['complaint_type']); ?></p>
                                <p class="text-sm text-gray-600">description of the problem:  <?php echo htmlspecialchars($row['description']); ?></p>
                                <p class="text-sm text-gray-600 mt-1">note from admin:  <?php echo htmlspecialchars($row['resolution']); ?></p>
                                <p class="text-sm text-gray-600 mt-1"><?php echo htmlspecialchars($row['date_submitted']); ?></p>
                                <p class="text-sm text-gray-600 mt-1">status: <?php echo htmlspecialchars($row['status']); ?></p>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php $stmt->close();
                     $conn->close(); ?>
                    </div>
                    
                </div>
                <div class="p-4 border-t flex justify-between items-center">
                    <p class="text-sm text-gray-500">Showing 1 to 2 of 2 entries</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle functionality
        document.querySelector('.md\\:hidden').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hidden');
        });
    </script>
</body>
    </html>