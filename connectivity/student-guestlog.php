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
$query = "SELECT * FROM guest_visits WHERE student_id = ?";
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
    background-color:rgb(224, 250, 242);
    font-size: 14px;
}

        .sidebar {
            transition: all 0.3s;
            width: 300px;
            background: linear-gradient(135deg, #1e343b 0%, #023c58 100%);
            height: 102vh;
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
        .form-select {
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            width: 100%;
            transition: all 0.2s;
            background-color: white;
        }
        .form-select:focus {
            outline: none;
            border-color: #923bf6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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
                    <a href="student-guestlog.php" class="flex items-center space-x-3 p-3 bg-teal-900">
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
    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">    
            <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-800">Guest Log</h1>
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

        <!-- Guest Log Content -->
        <main class="p-6 flex-1 overflow-auto">
        <div class="bg-white rounded-md shadow p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4">Add New Guest:</h2>
                <form action="php/php/student_guest.php" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Guest Name</label>
                            <input type="text" name="guest_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600" placeholder="Guest's full name">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Relationship</label>
                            <input type="text" name="relationship" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600" placeholder="Family/Friend/etc.">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Visit Date</label>
                            <input type="date" name="visit_date"  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">ID Type</label>
                            <select class="form-select" name="id_proof_type">
                                <option value="">Select ID Type</option>
                                <option value="aadhaar">Aadhaar Card</option>
                                <option value="passport">Passport</option>
                                <option value="driving_license">Driving License</option>
                                <option value="pan_card">PAN Card</option>
                                <option value="voter_id">Voter ID</option>
                                <option value="other">Other Government ID</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 mb-2">ID Number</label>
                            <input type="text" name="id_proof_no" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600" placeholder="Enter ID number">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Contact Number</label>
                            <input type="tel" name="contact_no" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600" placeholder="Guest's phone number">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Purpose</label>
                        <textarea name="purpose" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600" placeholder="Visit purpose"></textarea>
                    </div>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-user-plus mr-2"></i> Submit Guest Request
                    </button>
                </form>
            </div>
            
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b">
                    <h2 class="text-md font-semibold">Guest Visit History</h2>
                </div>
                <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-blue-100 text-xs"> <!-- Reduced base font size -->
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">Student ID</th> <!-- Reduced padding -->
                <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">Guest Name</th>
                <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">Relationship</th>
                <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">Date</th>
                <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">ID proof type</th>
                <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">ID</th>
                <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">Phone number</th>
                <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">Purpose</th>
                <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <!-- Add this style for even smaller text if needed -->
        <style>
            .smaller-text td, .smaller-text th {
                font-size: 0.65rem; /* Custom smaller font size */
                padding: 0.25rem 0.5rem; /* Custom smaller padding */
            }
        </style>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Change the table body row to match headers -->
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="px-6 py-4"><?php echo $row['student_id']; ?></td>
                                <td class="px-6 py-4"><?php echo $row['guest_name']; ?></td>
                                <td class="px-6 py-4"><?php echo $row['relationship']; ?></td>
                                <td class="px-6 py-4"><?php echo $row['visit_date']; ?></td>
                                <td class="px-6 py-4"><?php echo $row['id_proof_type']; ?></td>
                                <td class="px-6 py-4"><?php echo $row['id_proof_no']; ?></td>
                                <td class="px-6 py-4"><?php echo $row['contact_no']; ?></td>
                                <td class="px-6 py-4"><?php echo $row['purpose']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800"><?php echo $row['status']; ?></span>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t flex justify-between items-center">
                    <p class="text-sm text-gray-500">Showing 1 to 3 of 3 entries</p>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border rounded text-sm" disabled>Previous</button>
                        <button class="px-3 py-1 border rounded bg-purple-600 text-white text-sm">1</button>
                        <button class="px-3 py-1 border rounded text-sm" disabled>Next</button>
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