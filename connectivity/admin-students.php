<!DOCTYPE html>
<html lang="en">

<!DOCTYPE php>
<?php
require_once('php/php/db_connection.php');
$query = "select * from student";
$result = mysqli_query($conn, $query);

// Query for hostel details
$hostel_query = "SELECT * FROM hostels";
$hostel_result = mysqli_query($conn, $hostel_query);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management | Hostel Admin</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js" defer></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f8ff;
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
        .status-occupied {
            background-color: #fecaca;
            color: #dc2626;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
        }
        .status-vacant {
            background-color: #bbf7d0;
            color: #16a34a;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
        }
        .modal-content {
            max-height: 80vh;
            overflow-y: auto;
        }
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
                    <a href="admin-students.php" class="flex items-center space-x-3 p-3 bg-gray-700">
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
                    <a href="admin-complaints.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700">
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

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        <header class="bg-blue-200 shadow p-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-800">Student Management</h1>
            </div>
            <div class="flex items-center space-x-4">
                <button class="text-gray-600">
                    <i class="fas fa-bell"></i>
                </button>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full bg-gray-500 flex items-center justify-center text-white">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="hidden md:inline">Admin</span>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="p-6">
            <!-- Add Student Modal -->
            <div id="addStudentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                <div class="bg-white rounded-lg p-6 w-full max-w-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Add New Student</h3>
                        <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-content">
                        <form id="studentForm" action="php/php/add_student.php" method="post"> 
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">student ID</label>
                                <input type="text" name="studentID" class="w-full px-3 py-2 border rounded" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="fullname" class="w-full px-3 py-2 border rounded" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" class="w-full px-3 py-2 border rounded" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Phone</label>
                                <input type="tel" name="phone" class="w-full px-3 py-2 border rounded" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Block</label>
                                <input type="text" name="block" class="w-full px-3 py-2 border rounded" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Room Number</label>
                                <input type="text" name="room" class="w-full px-3 py-2 border rounded" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Room Type</label>
                                <select name="room_type" class="w-full px-3 py-2 border rounded" required>
                                    <option value="">Select Room Type</option>
                                    <option value="Double AC">Double AC</option>
                                    <option value="Single AC">Single AC</option>
                                    <option value="Double NONAC">Double NONAC</option>
                                    <option value="Single NONAC">Single NONAC</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Status</label>
                                <select name="status" class="w-full px-3 py-2 border rounded" required>
                                    <option value="">Select Status</option>
                                    <option value="Occupied">Occupied</option>
                                    <option value="Vacant">Vacant</option>
                                </select>
                            </div>
                            <div class="flex justify-end space-x-2 pt-4">
                                <button type="button" id="cancelAdd" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Student Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                <div class="p-4 border-b flex justify-between items-center">
                    <h2 class="text-lg font-semibold">All Students</h2>
                    <button id="addStudentBtn" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i> Add Student
                    </button>
                </div>
                
                <div class="overflow-x-auto" style="max-height: 60vh; overflow-y: auto;">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <td class="px-6 py-3 text-left text-lg font-bold text-gray-500 uppercase">ID</td>
                                <td class="px-6 py-3 text-left text-lg font-bold text-gray-500 uppercase">Name</td>
                                <td class="px-6 py-3 text-left text-lg font-bold text-gray-500 uppercase">Email</td>
                                <td class="px-6 py-3 text-left text-lg font-bold text-gray-500 uppercase">Phone</td>
                                <td class="px-6 py-3 text-left text-lg font-bold text-gray-500 uppercase">Block</td>
                                <td class="px-6 py-3 text-left text-lg font-bold text-gray-500 uppercase">Room</td>
                                <td class="px-6 py-3 text-left text-lg font-bold text-gray-500 uppercase">Room Type</td>
                                <td class="px-6 py-3 text-left text-lg font-bold text-gray-500 uppercase">Status</td>
                                
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="px-6 py-4 text-left text-base"><?php echo $row['student_id']; ?></td>
                                <td class="px-6 py-4 text-left text-base"><?php echo $row['name']; ?></td>
                                <td class="px-6 py-4 text-left text-base"><?php echo $row['email']; ?></td>
                                <td class="px-6 py-4 text-left text-base"><?php echo $row['phone_no']; ?></td>
                                <td class="px-6 py-4 text-left text-base"><?php echo $row['block_no']; ?></td>
                                <td class="px-6 py-4 text-left text-base"><?php echo $row['room_no']; ?></td>
                                <td class="px-6 py-4 text-left text-base"><?php echo $row['room_type']; ?></td>
                                <td class="px-6 py-4 text-left text-base"><?php echo $row['status']; ?></td>
                                <td class="px-6 py-4 text-left text-base">
                                    <a href="#" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                                    <a href="#" class="text-red-600 hover:text-red-800">Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Hostel Details Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold">Hostel Room Details</h2>
                </div>
                
                <div class="overflow-x-auto" style="max-height: 60vh; overflow-y: auto;">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <td class="px-6 py-3 text-left text-lg font-bold text-gray-500 uppercase">Hostel No.</th>
                                <td class="px-6 py-3 text-left text-lg font-bold text-gray-500 uppercase">Room No.</th>
                                <td class="px-6 py-3 text-left text-lg font-bold text-gray-500 uppercase">Occupancy</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php while($hostel_row = mysqli_fetch_assoc($hostel_result)): ?>
                            <tr>
                                
                                <td class="px-6 py-4 text-left text-base"><?php echo $hostel_row['hostel_no']; ?></td>
                                <td class="px-6 py-4 text-left text-base"><?php echo $hostel_row['room_no']; ?></td>
                                <td class="px-6 py-4 text-left text-base"><?php echo $hostel_row['status']; ?></td>
                           
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        // Mobile menu toggle functionality
        document.querySelector('.md\\:hidden').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hidden');
        });

        // Modal handling
        $('#addStudentBtn').click(function() {
            $('#addStudentModal').removeClass('hidden');
        });
        
        $('#closeModal, #cancelAdd').click(function() {
            $('#addStudentModal').addClass('hidden');
            $('#studentForm')[0].reset();
        });
    });
    </script>
</body>
</html>