<!DOCTYPE php>
<?php
// Start session and check login
session_start();

include('php/php/db_connection.php');

// Get student ID from session
//$reg_no = $_SESSION['student_id'];

// Fetch student details from database
$query = "SELECT * FROM complaint WHERE status != 'Completed'";
$stmt = $conn->prepare($query);

$stmt->execute();
$result = $stmt->get_result();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Management | Hostel Admin</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js" defer></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color:rgb(220, 198, 254);
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
        .sidebar li:nth-child(1) a:hover { background-color: #3b82f6; }
        .sidebar li:nth-child(2) a:hover { background-color: #10b981; }
        .sidebar li:nth-child(3) a:hover { background-color: #8b5cf6; }
        .sidebar li:nth-child(4) a:hover { background-color: #f59e0b; }
        .sidebar li:nth-child(5) a:hover { background-color: #ef4444; }
        .sidebar li:nth-child(6) a:hover { background-color: #6366f1; }
        .sidebar li:nth-child(7) a:hover { background-color: #ec4899; }
        .sidebar li:nth-child(8) a:hover { background-color: #14b8a6; }
    </style>
</head>
<body class="flex h-screen">
    <div class="sidebar text-white p-6 hidden md:block">
        <div class="flex items-center justify-center p-3 mb-3">
            <i class="fas fa-user-shield text-4xl"></i>
        </div>
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="admin-dashboard.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700">
                        <i class="fas fa-arrow-left text-md w-6 text-center"></i>
                        <span class="text-sm">Back to Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="admin-students.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700">
                        <i class="fas fa-users text-md w-6 text-center"></i>
                        <span class="text-sm">Student Details</span>
                    </a>
                </li>
                <li>
                    <a href="admin-attendance.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700">
                        <i class="fas fa-calendar-check text-md w-6 text-center"></i>
                        <span class="text-sm">Upload Attendance</span>
                    </a>
                </li>
                
                <li>
                    <a href="admin-notices.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700">
                        <i class="fas fa-bullhorn text-md w-6 text-center"></i>
                        <span class="text-sm">Upload Notices</span>
                    </a>
                </li>
                <li>
                    <a href="admin-payments.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700">
                        <i class="fas fa-money-check-alt text-md w-6 text-center"></i>
                        <span class="text-sm">Check Fee Payments</span>
                    </a>
                </li>
                <li>
                    <a href="admin-guests.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700">
                        <i class="fas fa-user-friends text-md w-6 text-center"></i>
                        <span class="text-sm">Manage Guests</span>
                    </a>
                </li>
                <li>
                    <a href="admin-maintenance.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700">
                        <i class="fas fa-tools text-md w-6 text-center"></i>
                        <span class="text-sm">Maintenance Requests</span>
                    </a>
                </li>
                <li>
                    <a href="admin-llm.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700">
                        <i class="fas fa-tools text-md w-6 text-center"></i>
                        <span class="text-sm">AI Chat Bot</span>
                    </a>
                </li>
                <li>
                    <a href="admin-complaints.php" class="flex items-center space-x-3 p-3 bg-gray-700">
                        <i class="fas fa-exclamation-circle text-md w-6 text-center"></i>
                        <span class="text-sm">Complaints</span>
                    </a>
                </li>
                <li>
                    <a href="index.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700 mt-8">
                        <i class="fas fa-sign-out-alt text-md w-6 text-center"></i>
                        <span class="text-sm">Logout</span>
                    </a>
                </li>
                
            </ul>
        </nav>
    </div>
    <div class="flex-1 overflow-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Complaints Management</h1>
        
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-lg font-semibold">All Complaints</h2>
                <div class="flex space-x-2">
                    <select class="form-input text-sm" >
                        <option>All Status</option>
                        <option>Open</option>
                        <option>In Progress</option>
                        <option>Resolved</option>
                    </select>
                    <button class="btn btn-primary text-sm">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                </div>
            </div>
            
            <div class="divide-y divide-gray-200">
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex justify-between items-start">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div>
                            <h3 class="font-medium"><?php echo htmlspecialchars($row['complaint_id']); ?></h3>
                            <p class="text-sm text-gray-600"><?php echo htmlspecialchars($row['student_id']); ?></p>
                            <p class="text-xs text-gray-500 mt-1"><?php echo htmlspecialchars($row['complaint_type']); ?></p>
                            <p class="text-xs text-gray-500 mt-1"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="text-xs text-gray-500 mt-1"><?php echo htmlspecialchars($row['status']); ?></p>
                            <p class="text-xs text-gray-500 mt-1"><?php echo htmlspecialchars($row['date_submitted']); ?></p>
                            
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Open</span>
                    </div>
                    <?php endwhile; ?>
                    <?php $stmt->close(); $conn->close(); ?>
                </div>
                <div class="p-4 hover:bg-gray-50">
                    
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold mb-4">Update Complaint Status</h2>
    <form method="POST" action="php/php/update_complaint_status.php">
        <!-- Complaint ID and Resolution Group Box -->
        <div class="bg-gray-100 p-4 rounded-lg border border-gray-300 mb-6">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2 font-medium">Complaint ID</label>
                <input type="text" name="complaint_id" class="form-input w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-purple-500 focus:border-purple-500" placeholder="Enter complaint ID">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2 font-medium">Resolution Notes</label>
                <textarea name="resolution" class="form-input w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-purple-500 focus:border-purple-500 h-28" placeholder="Enter resolution details"></textarea>
            </div>
        </div>

        <!-- Status Dropdown Outside Box -->
        <div class="mb-6">
            <label class="block text-gray-700 mb-2 font-medium">Status</label>
            <select name="status" class="form-input w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-purple-500 focus:border-purple-500">
                <option value="Pending">Pending</option>
                <option value="Resolved">Resolved</option>
            </select>
        </div>
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded shadow-md transition duration-200">
    <i class="fas fa-check-circle mr-2"></i>Update
</button>
            </form>
        </div>
    </div>
</body>
</html>