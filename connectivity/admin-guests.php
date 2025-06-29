<!DOCTYPE html>
<html lang="en">
<!DOCTYPE php>
<?php
require_once('php/php/db_connection.php');
$query="select * from guest_visits";
$result= mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Management | Hostel Admin</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color:rgb(249, 228, 199);
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
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
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
                    <a href="admin-guests.php" class="flex items-center space-x-3 p-3 bg-gray-700">
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
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-800">Guest Management</h1>
            </div>
            <div class="flex items-center space-x-4">
                <button class="text-gray-600">
                    <i class="fas fa-bell"></i>
                </button>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="hidden md:inline">Admin</span>
                </div>
            </div>
        </header>

        <!-- Guest Management Content -->
        <main class="p-6">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4">Manage Guest Requests</h2>
                <form action="php/php/admin_guests.php" method="post">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Student ID</label>
                            <input type="text" name ="studentId" class="form-input w-full" placeholder="Enter student ID">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Visit ID</label>
                            <input type="text" name ="visitId" class="form-input w-full" placeholder="Enter visit ID">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Status</label>
                            <select name ="status" class="form-select">
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i> Update Status
                    </button>
                </form>
            </div>
            
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold">Guest Requests</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Visit ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Guest Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Relationship</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Visit Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Purpose</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                              
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
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