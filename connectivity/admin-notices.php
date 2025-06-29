<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notices Management | Hostel Admin</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js" defer></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
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
                    <a href="admin-notices.php" class="flex items-center space-x-3 p-3 bg-gray-700">
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
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-800">Notices Management</h1>
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
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4">Create New Notice</h2>
                <form id="noticeForm" action="php/php/admin-notices.php" method="post">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Title</label>
                        <input type="text" name="title" class="w-full px-3 py-2 border rounded" placeholder="Notice title" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Content</label>
                        <textarea name="content" class="w-full px-3 py-2 border rounded h-32" placeholder="Notice content" required></textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Start Date</label>
                            <input type="date" name="start_date" class="w-full px-3 py-2 border rounded" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">End Date</label>
                            <input type="date" name="end_date" class="w-full px-3 py-2 border rounded" required>
                        </div>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        <i class="fas fa-paper-plane mr-2"></i> Publish Notice
                    </button>
                </form>
            </div>
            
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Published Notices</h2>
                    <div class="relative">
                        <input type="text" placeholder="Search notices..." class="pl-8 pr-4 py-2 border rounded">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <div class="divide-y divide-gray-200" id="noticesList">
                    <!-- Notices will be loaded here -->
                    <div class="p-4 hover:bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium">Hostel Maintenance</h3>
                                <p class="text-sm text-gray-600">Water supply will be interrupted on 15th June</p>
                            </div>
                            <div class="text-sm text-gray-500">
                                <span>10 Jun - 15 Jun</span>
                            </div>
                        </div>
                    </div>
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

        // Form submission for notices
        // $('#noticeForm').submit(function(e) {
        //     e.preventDefault();
            
        //     // Here you would typically make an AJAX call to save the notice
        //     // For now we'll just add it to the list
        //     const formData = $(this).serializeArray();
        //     const noticeData = {};
        //     formData.forEach(item => {
        //         noticeData[item.name] = item.value;
        //     });
            
        //     // Format dates for display
        //     const startDate = new Date(noticeData.start_date).toLocaleDateString('en-US', { day: 'numeric', month: 'short' });
        //     const endDate = new Date(noticeData.end_date).toLocaleDateString('en-US', { day: 'numeric', month: 'short' });
            
        //     // Create new notice element
        //     const noticeElement = `
        //         <div class="p-4 hover:bg-gray-50">
        //             <div class="flex justify-between items-start">
        //                 <div>
        //                     <h3 class="font-medium">${noticeData.title}</h3>
        //                     <p class="text-sm text-gray-600">${noticeData.content}</p>
        //                 </div>
        //                 <div class="text-sm text-gray-500">
        //                     <span>${startDate} - ${endDate}</span>
        //                 </div>
        //             </div>
        //         </div>
        //     `;
            
        //     // Prepend to the notices list
        //     $('#noticesList').prepend(noticeElement);
            
        //     // Reset form
        //     this.reset();
            
        //     // Show success message
        //     alert('Notice published successfully!');
        // });
    });
    </script>
</body>
</html>