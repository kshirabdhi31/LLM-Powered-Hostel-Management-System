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
            background-color:rgb(254, 232, 241);
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
                    <a href="student-attendance.php" class="flex items-center space-x-3 p-3">
                        <i class="fas fa-clipboard-check text-md w-6 text-center"></i>
                        <span class="text-sm">Attendance Log</span>
                    </a>
                </li>
                <li>
                    <a href="student-mess.php" class="flex items-center space-x-3 p-3 bg-teal-900">
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
    <!--main conetent -->
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-800">Mess Management</h1>
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

        <!-- Mess Management Content -->
        <main class="p-6">
            <!-- Tabs Navigation -->
            <div class="flex border-b border-gray-200 mb-6">
                <button class="tab-btn px-4 py-2 font-medium text-gray-600 active-tab" data-tab="menu">
                    <i class="fas fa-utensils mr-2"></i>Weekly Menu
                </button>
                <button class="tab-btn px-4 py-2 font-medium text-gray-600" data-tab="schedule">
                    <i class="far fa-calendar-alt mr-2"></i>Mess Schedule
                </button>
             
            </div>

            <!-- Tab Contents -->
            <div class="tab-content" id="menu-tab">
                <!-- Weekly Menu Section -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800 flex items-center">
                        <i class="fas fa-utensils mr-2 accent-text"></i>
                        This Week's Menu
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <!-- Monday -->
                        <div class="menu-day bg-white rounded-lg shadow p-4">
                            <h3 class="font-bold text-lg mb-3 text-gray-800">Monday</h3>
                            <div class="space-y-3">
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Breakfast</h4>
                                    <p class="text-sm text-gray-600">Poha, Bread, Butter, Tea</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Lunch</h4>
                                    <p class="text-sm text-gray-600">Rice, Dal, Mix Veg, Chapati, Salad</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Dinner</h4>
                                    <p class="text-sm text-gray-600">Roti, Chana Masala, Rice, Curd</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tuesday -->
                        <div class="menu-day bg-white rounded-lg shadow p-4">
                            <h3 class="font-bold text-lg mb-3 text-gray-800">Tuesday</h3>
                            <div class="space-y-3">
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Breakfast</h4>
                                    <p class="text-sm text-gray-600">Idli, Sambar, Chutney, Coffee</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Lunch</h4>
                                    <p class="text-sm text-gray-600">Jeera Rice, Rajma, Chapati, Salad</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Dinner</h4>
                                    <p class="text-sm text-gray-600">Paratha, Dal Fry, Rice, Pickle</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Wednesday -->
                        <div class="menu-day bg-white rounded-lg shadow p-4">
                            <h3 class="font-bold text-lg mb-3 text-gray-800">Wednesday</h3>
                            <div class="space-y-3">
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Breakfast</h4>
                                    <p class="text-sm text-gray-600">Upma, Bread Jam, Tea</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Lunch</h4>
                                    <p class="text-sm text-gray-600">Veg Biryani, Raita, Papad</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Dinner</h4>
                                    <p class="text-sm text-gray-600">Roti, Palak Paneer, Rice, Dal</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Thursday -->
                        <div class="menu-day bg-white rounded-lg shadow p-4">
                            <h3 class="font-bold text-lg mb-3 text-gray-800">Thursday</h3>
                            <div class="space-y-3">
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Breakfast</h4>
                                    <p class="text-sm text-gray-600">Dosa, Chutney, Sambar, Coffee</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Lunch</h4>
                                    <p class="text-sm text-gray-600">Rice, Sambar, Chapati, Veg Curry</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Dinner</h4>
                                    <p class="text-sm text-gray-600">Khichdi, Kadhi, Papad</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Friday -->
                        <div class="menu-day bg-white rounded-lg shadow p-4">
                            <h3 class="font-bold text-lg mb-3 text-gray-800">Friday</h3>
                            <div class="space-y-3">
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Breakfast</h4>
                                    <p class="text-sm text-gray-600">Aloo Paratha, Curd, Tea</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Lunch</h4>
                                    <p class="text-sm text-gray-600">Rice, Dal Tadka, Chapati, Bhindi</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Dinner</h4>
                                    <p class="text-sm text-gray-600">Roti, Matar Paneer, Rice, Salad</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Saturday -->
                        <div class="menu-day bg-white rounded-lg shadow p-4">
                            <h3 class="font-bold text-lg mb-3 text-gray-800">Saturday</h3>
                            <div class="space-y-3">
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Breakfast</h4>
                                    <p class="text-sm text-gray-600">Sandwich, Juice, Fruit</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Lunch</h4>
                                    <p class="text-sm text-gray-600">Fried Rice, Manchurian, Noodles</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Dinner</h4>
                                    <p class="text-sm text-gray-600">Roti, Dal Makhani, Rice, Salad</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sunday -->
                        <div class="menu-day bg-white rounded-lg shadow p-4">
                            <h3 class="font-bold text-lg mb-3 text-gray-800">Sunday</h3>
                            <div class="space-y-3">
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Breakfast</h4>
                                    <p class="text-sm text-gray-600">Puri, Chole, Halwa</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Lunch</h4>
                                    <p class="text-sm text-gray-600">Special Thali (5 Items)</p>
                                </div>
                                <div class="meal-card bg-gray-50 p-3 rounded">
                                    <h4 class="font-medium text-gray-700">Dinner</h4>
                                    <p class="text-sm text-gray-600">Pulao, Raita, Papad, Sweet</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mess Schedule Tab (Hidden by default) -->
            <div class="tab-content hidden" id="schedule-tab">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800 flex items-center">
                        <i class="far fa-calendar-alt mr-2 accent-text"></i>
                        Mess Timings & Schedule
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Regular Days Schedule -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-bold text-lg mb-3 text-gray-800">Regular Days (Mon-Sat)</h3>
                            <ul class="space-y-3">
                                <li class="flex justify-between items-center border-b pb-2">
                                    <span class="font-medium">Breakfast</span>
                                    <span class="accent-bg text-green-800 px-2 py-1 rounded text-sm">7:30 AM - 9:00 AM</span>
                                </li>
                                <li class="flex justify-between items-center border-b pb-2">
                                    <span class="font-medium">Lunch</span>
                                    <span class="accent-bg text-green-800 px-2 py-1 rounded text-sm">12:30 PM - 2:30 PM</span>
                                </li>
                                <li class="flex justify-between items-center border-b pb-2">
                                    <span class="font-medium">Snacks</span>
                                    <span class="accent-bg text-green-800 px-2 py-1 rounded text-sm">4:30 PM - 5:30 PM</span>
                                </li>
                                <li class="flex justify-between items-center">
                                    <span class="font-medium">Dinner</span>
                                    <span class="accent-bg text-green-800 px-2 py-1 rounded text-sm">8:00 PM - 10:00 PM</span>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Sunday/Holiday Schedule -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-bold text-lg mb-3 text-gray-800">Sunday/Holidays</h3>
                            <ul class="space-y-3">
                                <li class="flex justify-between items-center border-b pb-2">
                                    <span class="font-medium">Breakfast</span>
                                    <span class="accent-bg text-green-800 px-2 py-1 rounded text-sm">8:00 AM - 10:00 AM</span>
                                </li>
                                <li class="flex justify-between items-center border-b pb-2">
                                    <span class="font-medium">Brunch</span>
                                    <span class="accent-bg text-green-800 px-2 py-1 rounded text-sm">11:00 AM - 1:00 PM</span>
                                </li>
                                <li class="flex justify-between items-center">
                                    <span class="font-medium">Dinner</span>
                                    <span class="accent-bg text-green-800 px-2 py-1 rounded text-sm">7:30 PM - 9:30 PM</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Special Notices -->
                    <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Special Notice</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p>Mess will remain closed on 15th August (Independence Day). Special dinner will be served from 7:00 PM to 9:00 PM.</p>
                                </div>
                            </div>
                        </div>
                    </div>
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

        // Tab switching functionality
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.tab-btn').forEach(b => {
                    b.classList.remove('active-tab');
                    b.classList.add('text-gray-600');
                });
                
                // Add active class to clicked button
                this.classList.add('active-tab');
                this.classList.remove('text-gray-600');
                
                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Show selected tab content
                const tabId = this.getAttribute('data-tab') + '-tab';
                document.getElementById(tabId).classList.remove('hidden');
            });
        });

        // Star rating functionality
        const stars = document.querySelectorAll('.fa-star, .fa-star-half-alt');
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const parent = this.parentElement;
                const index = Array.from(parent.children).indexOf(this);
                
                // Toggle between full, half, and empty stars
                for (let i = 0; i < parent.children.length; i++) {
                    if (i <= index) {
                        parent.children[i].classList.remove('far', 'fa-star-half-alt');
                        parent.children[i].classList.add('fas');
                    } else {
                        parent.children[i].classList.remove('fas');
                        parent.children[i].classList.add('far');
                    }
                }
            });
        });
    </script>
</body>
</html>