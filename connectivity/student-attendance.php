<!DOCTYPE php>
<?php
// Start session and check login
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: php/php/student-login.php");
    exit();
}
require_once('php/php/db_connection.php');

// Get student ID from session
$reg_no = $_SESSION['student_id'];

// Query for attendance summary statistics
$sql = "SELECT COUNT(*) AS total_days,
    SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) AS present_days,
    SUM(CASE WHEN status = 'Absent' THEN 1 ELSE 0 END) AS absent_days
    FROM attendance
    WHERE student_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $reg_no);
$stmt->execute();
$result = $stmt->get_result();
$summar = $result->fetch_assoc();

// Fetch attendance records
$query = "SELECT date, status FROM attendance WHERE student_id = ? ORDER BY date ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $reg_no);
$stmt->execute();
$attendance_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Log | Hostel Student</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
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
            background-color:rgb(28, 43, 98);
            transform: translateY(-1px);
        }
        .highlight-card {
            background: rgb(198, 230, 247);
            border-left: 4px solidrgb(121, 248, 248);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .accent-text {
            color: #1a044c;
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
            border-color:rgb(59, 90, 246);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .user-badge {
            background-color: #3b82f6;
        }
        .attendance-present {
            background-color: #d1fae5;
            color: #065f46;
        }
        .attendance-absent {
            background-color: #fee2e2;
            color: #b91c1c;
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
                    <a href="student-fees.php" class="flex items-center space-x-3 p-3">
                        <i class="fas fa-money-bill-wave text-md w-4 text-center"></i>
                        <span class="text-sm">Fee Payments</span>
                    </a>
                </li>
                
                <li>
                    <a href="student-attendance.php" class="flex items-center space-x-3 p-3 bg-teal-900">
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
        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-800">Attendance Log</h1>
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

        <!-- Attendance Content -->
        <main class="p-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="summary-card p-6 rounded-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Days</p>
                            <p class="text-xl font-bold text-blue-500"><?php echo htmlspecialchars($summar['total_days'] ?? 0); ?></p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full text-blue-500">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="summary-card p-6 rounded-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Present</p>
                            <p class="text-xl font-bold text-emerald-500"><?php echo htmlspecialchars($summar['present_days'] ?? 0); ?></p>
                        </div>
                        <div class="p-3 bg-emerald-100 rounded-full text-emerald-500">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="summary-card p-6 rounded-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Absent</p>
                            <p class="text-xl font-bold text-red-500"><?php echo htmlspecialchars($summar['absent_days'] ?? 0); ?></p>
                        </div>
                        <div class="p-3 bg-red-100 rounded-full text-red-500">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="bg-white rounded-md shadow overflow-hidden">
                <div class="p-3 border-b accent-bg">
                    <h2 class="text-md font-semibold accent-text">Attendance Record</h2>
                    <div class="flex space-x-2 mt-2">
                       
                        
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="accent-bg">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase accent-text tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase accent-text tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <?php while($row = $attendance_result->fetch_assoc()): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?php echo htmlspecialchars($row['date']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $row['status'] === 'Present' ? 'attendance-present' : 'attendance-absent'; ?>">
                                        <?php echo htmlspecialchars($row['status']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t flex justify-between items-center">
                    <p class="text-sm text-gray-500">Showing all entries</p>
                </div>
            </div>

            <!-- Notes Section -->
            <div class="mt-6 highlight-card rounded-md p-3">
                <h2 class="text-md font-semibold mb-4 accent-text">Attendance Policy</h2>
                <ul class="list-disc pl-5 space-y-2 text-gray-600">
                    <li>Minimum 80% attendance is required to maintain hostel residency</li>
                    <li>Check-in after 11:00 PM will be marked as late entry</li>
                    <li>3 consecutive absent days without notice may lead to disciplinary action</li>
                    <li>Medical leaves must be supported with proper documentation</li>
                </ul>
            </div>
        </main>
    </div>

    <script>
        // Mobile menu toggle functionality
        document.querySelector('.md\\:hidden').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hidden');
        });
    </script>
</body>
</html>