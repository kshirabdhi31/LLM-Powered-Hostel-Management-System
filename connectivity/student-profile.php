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

// Fetch student details from database
$student_data = [];
$query = "SELECT * FROM student WHERE student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $reg_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $student_data = $result->fetch_assoc();
} else {
    die("Student not found in database");
}

$stmt->close();
$conn->close();
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
            background-color:rgb(216, 251, 253);
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
            background-color: #3f1c62;
            transform: translateY(-1px);
        }
        .highlight-card {
            background: rgb(206, 198, 247);
            border-left: 4px solid #d279f8;
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
            border-color: #923bf6;
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
                    <a href="student-profile.php" class="flex items-center space-x-3 p-3 bg-teal-900">
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

    <div class="flex-1 overflow-auto">
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-800">My Profile</h1>
            </div>
            <div class="flex items-center space-x-4">
                <button class="text-gray-600">
                    <i class="fas fa-bell"></i>
                </button>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="hidden md:inline">Student</span>
                </div>
            </div>
        </header>

        <main class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Removed profile picture column -->
        
                <div class="md:col-span-3">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-semibold mb-4">Personal Information</h2>
                        <form>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-gray-700 mb-2">Full Name</label>
                                    <input type="text" class="form-input w-full" value="<?php echo htmlspecialchars($student_data['name']); ?>" readonly>
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2">Student ID</label>
                                    <input type="text" class="form-input w-full" value="<?php echo htmlspecialchars($student_data['student_id']); ?>" readonly>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-gray-700 mb-2">Email</label>
                                    <input type="email" class="form-input w-full" value="<?php echo htmlspecialchars($student_data['email']); ?>" readonly>
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2">Phone</label>
                                    <input type="tel" class="form-input w-full" value="<?php echo htmlspecialchars($student_data['phone_no']); ?>" readonly>
                                </div>
                            </div>
                            <!-- <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Address</label>
                                <textarea class="form-input w-full">Room A101, Hostel Building, University Campus</textarea>
                            </div> -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <!-- <div>
                                    <label class="block text-gray-700 mb-2">Date of Birth</label>
                                    <input type="date" class="form-input w-full" value="2000-01-15">
                                </div> -->
                                <!-- <div>
                                    <label class="block text-gray-700 mb-2">Blood Group</label>
                                    <select class="form-input w-full">
                                        <option>A+</option>
                                        <option>A-</option>
                                        <option>B+</option>
                                        <option>B-</option>
                                        <option>AB+</option>
                                        <option>AB-</option>
                                        <option>O+</option>
                                        <option>O-</option>
                                    </select>
                                </div> -->
                            </div>
        
                            <!-- New Hostel Info Section -->
                            <h2 class="text-lg font-semibold mb-4 mt-6">Hostel Information</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div>
                                    <label class="block text-gray-700 mb-2">Block</label>
                                    <input type="text" class="form-input w-full" value="<?php echo htmlspecialchars($student_data['block_no']); ?>" readonly>
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2">Room Number</label>
                                    <input type="text" class="form-input w-full" value="<?php echo htmlspecialchars($student_data['room_no']); ?>" readonly>
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2">Room Type</label>
                                    <input type="text" class="form-input w-full" value="<?php echo htmlspecialchars($student_data['room_type']); ?>" readonly>
                                </div>
                            </div>
        
                            <!-- <button type="submit" class="btn-primary">
                                <i class="fas fa-save mr-2"></i> Update Profile
                            </button> -->
                        </form>
                    </div>
                </div>
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