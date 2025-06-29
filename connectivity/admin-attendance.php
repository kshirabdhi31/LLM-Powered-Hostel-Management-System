<!DOCTYPE html>
<html lang="en">
<!DOCTYPE php>
<?php
require_once('php/php/db_connection.php');
$query="select * from attendance";
$result= mysqli_query($conn,$query);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management | Hostel Admin</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js" defer></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3e8ff; /* Light purple background */
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
        .present-status {
            background-color: #bbf7d0;
            color: #16a34a;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
        }
        .absent-status {
            background-color: #fecaca;
            color: #dc2626;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
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
                    <a href="admin-attendance.php" class="flex items-center space-x-3 p-3 bg-gray-700">
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
    <div class="flex-1 overflow-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Attendance Management</h1>
        
        <!-- Manual Attendance Entry Form -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Mark Attendance</h2>
            <form id="attendanceForm" class="space-y-4" action="php/php/admin-attendance.php" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Student ID</label>
                        <input type="text" id="studentId" name="studentId" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Date</label>
                        <input type="date" id="attendanceDate" name="date" class="w-full px-3 py-2 border rounded" required>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Status</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="Present" class="form-radio text-green-500" checked>
                            <span class="ml-2">Present</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="Absent" class="form-radio text-red-500">
                            <span class="ml-2">Absent</span>
                        </label>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                        <i class="fas fa-save mr-2"></i> Save Attendance
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Attendance Records Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-lg font-semibold">Attendance Records</h2>
                <div class="flex space-x-2">
                    <input type="date" id="filterDate" class="px-3 py-1 border rounded">
                    <button id="filterBtn" class="px-3 py-1 bg-purple-600 text-white rounded hover:bg-purple-700">
                        Filter
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                           <td class="px-6 py-3 text-left text-lg font-bold text-gray-800 uppercase">Date</td>
                            <td class="px-6 py-3 text-left text-lg font-bold text-gray-800 uppercase">Student ID</td>
                            <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th> -->
                            <td class="px-6 py-3 text-left text-lg font-bold text-gray-800 uppercase">Status</td>

                
                        </tr>
                        <?php
                        while($row=mysqli_fetch_assoc($result)){
                            ?>
                             <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"><?php echo $row['date']; ?></td>
                                <td  class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase"><?php echo $row['student_id']; ?></td>
                                <td  class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase"><?php echo $row['status']; ?></td>
                                
                                
                                <td><a href="#" class ="btn btn-primary"Edit</a></a></td>
                                <td><a href="#" class="btn btn-danger"?Delete</a></a></td>
                                </tr>
                                <?php
                                }
                            

                                ?>

                    </thead>
                  
                     
                </table>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        // Mobile menu toggle functionality
        document.querySelector('.md\\:hidden').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hidden');
        });

    //     // Set today's date as default
    //     const today = new Date().toISOString().split('T')[0];
    //     $('#attendanceDate').val(today);
    //     $('#filterDate').val(today);

    //     // Form submission
    //     $('#attendanceForm').submit(function(e) {
    //         e.preventDefault();
            
    //         // Get form data
    //         const formData = {
    //             studentId: $('#studentId').val(),
    //             date: $('#attendanceDate').val(),
    //             status: $('input[name="status"]:checked').val()
    //         };
            
    //         // Here you would typically send this to your backend
    //         console.log('Attendance data:', formData);
            
    //         // For demo purposes, we'll just add it to the table
    //         const newRow = `
    //             <tr>
    //                 <td class="px-6 py-4 whitespace-nowrap">${formData.date}</td>
    //                 <td class="px-6 py-4 whitespace-nowrap">${formData.studentId}</td>
    //                 <td class="px-6 py-4 whitespace-nowrap">Student Name</td>
    //                 <td class="px-6 py-4 whitespace-nowrap">
    //                     <span class="${formData.status === 'Present' ? 'present-status' : 'absent-status'}">${formData.status}</span>
    //                 </td>
    //                 <td class="px-6 py-4 whitespace-nowrap">
    //                     <button class="text-red-500 hover:text-red-700">
    //                         <i class="fas fa-trash-alt"></i>
    //                     </button>
    //                 </td>
    //             </tr>
    //         `;
            
    //         $('#attendanceTableBody').prepend(newRow);
            
    //         // Reset form
    //         $('#studentId').val('');
    //         $('#studentId').focus();
            
    //         // Show success message
    //         alert('Attendance recorded successfully!');
    //     });
        
    //     // Filter button functionality
    //     $('#filterBtn').click(function() {
    //         const filterDate = $('#filterDate').val();
    //         // Here you would typically filter records from your backend
    //         // For demo, we'll just show an alert
    //         alert(`Filtering records for date: ${filterDate}`);
    //     });
        
    //     // Delete record functionality
    //     $(document).on('click', '.fa-trash-alt', function() {
    //         if(confirm('Are you sure you want to delete this attendance record?')) {
    //             $(this).closest('tr').remove();
    //             alert('Attendance record deleted!');
    //         }
    //     });
    // });
    </script>
</body>
</html>