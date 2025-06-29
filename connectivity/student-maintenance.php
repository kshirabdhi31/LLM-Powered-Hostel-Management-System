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
$query = "SELECT * FROM maintenancerequest WHERE student_id = ?";
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color:rgb(233, 252, 221); }
        .sidebar { transition: all 0.3s; width: 300px; background: linear-gradient(135deg, #1e343b 0%, #023c58 100%); height: 100vh; }
        .sidebar a { transition: all 0.3s; margin: 0 8px; border-radius: 8px; padding: 10px 12px; }
        .sidebar a:hover { transform: translateX(5px); background-color: #334155; }
        .btn-primary { background-color:rgb(59, 246, 209); color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: 500; text-decoration: none; }
        .btn-danger { background-color: #ef4444; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: 500; text-decoration: none; }
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
                    <a href="student-maintenance.php" class="flex items-center space-x-3 p-3 bg-teal-900">
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
                    <a href="student-complaints.php" class="flex items-center space-x-3 p-3">
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

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Maintenance Requests</h1>
            <div class="flex items-center space-x-4">
                <button class="text-gray-600"><i class="fas fa-bell"></i></button>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white"><i class="fas fa-user"></i></div>
                    <span class="hidden md:inline">Student</span>
                </div>
            </div>
        </header>

        <div class="p-6">

            <!-- New Request Form -->
            <div class="bg-white rounded-md shadow p-6 mb-6">
                <h2 class="text-md font-semibold mb-4">Submit New Request</h2>
                <form id="studmain" action="php/php/student-main_req.php" method="post">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Request Type</label>
                        <select name="request_type" class="w-full px-3 py-2 border rounded" required>
                            <option>Plumbing</option>
                            <option>Electrical</option>
                            <option>Furniture</option>
                            <option>Cleaning</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Description</label>
                        <textarea name="description" class="w-full px-3 py-2 border rounded h-32" required placeholder="Describe the issue in detail"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Date</label>
                        <input type="date" name="date_submitted" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-md transition duration-300">
                        <i class="fas fa-paper-plane mr-2"></i> Submit Request
                    </button>
                </form>
            </div>

            <!-- List of Requests -->
            <div class="bg-white rounded-md shadow overflow-hidden">
                <div class="p-4 border-b">
                    <h2 class="text-md font-semibold">My Requests</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="p-4 hover:bg-gray-50">
                            <h3 class="font-medium"><?php echo htmlspecialchars($row['request_type']); ?></h3>
                            <p class="text-sm text-gray-1000"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="text-s text-gray-1000 mt-1">Submitted: <?php echo date('Y-m-d', strtotime($row['date_submitted'])); ?></p>
                            <p class="text-s text-gray-1000"><?php echo htmlspecialchars($row['status']); ?></p>
                            <div class="mt-2 flex gap-3">
                                <a href="#" class="btn-primary">Edit</a>
                                <a href="#" class="btn-danger">Delete</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php $stmt->close();
                     $conn->close(); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
