<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | Hostel Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Keep all existing styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        .flex.h-screen {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            background-color: #1e3a8a;
            color: rgb(123, 198, 232);
            width: 16rem;
            padding: 1rem;
            display: none;
            flex-direction: column;
        }
        @media (min-width: 768px) {
            .sidebar {
                display: flex;
            }
        }
        /* Modified dashboard card styles */
        .dashboard-card {
    background: rgb(230, 241, 245);
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    padding: 1rem; /* Reduced from 1.5rem */
    transition: all 0.3s ease;
    height: 220px; /* Increased from 160px to make buttons taller */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .dashboard-icon {
            width: 36px; /* Reduced from default */
            height: 36px; /* Reduced from default */
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1rem; /* Reduced icon size */
        }
        .dashboard-title {
            font-size: 1rem; /* Reduced from 1.125rem (lg) */
            margin-bottom: 0.25rem; /* Reduced space */
        }
        .dashboard-desc {
            font-size: 0.875rem; /* Slightly smaller text */
            margin-bottom: 0.5rem; /* Reduced space */
        }
        .dashboard-link {
            font-size: 0.875rem; /* Smaller link text */
        }
        /* Keep all other existing styles */
        .sidebar-image-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin: 0.5rem 0;
            border: 2px solid #3b82f6;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .sidebar-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .sidebar-content {
            padding: 1rem;
            text-align: center;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            margin-top: 0.25rem;
            width: 12rem;
            background: white;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            z-index: 10;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .notification-dropdown {
            display: none;
            position: absolute;
            right: 0;
            margin-top: 0.25rem;
            width: 20rem;
            max-height: 24rem;
            overflow-y: auto;
            background: white;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            z-index: 10;
        }
        .notification-item {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
            cursor: pointer;
        }
        .notification-item:hover {
            background-color: #f9fafb;
        }
        .notification-item.unread {
            background-color: #f0f9ff;
        }
        .notification-time {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }
        .notification-header {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .notification-footer {
            padding: 0.5rem 1rem;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body class="flex h-screen">
    <!-- Sidebar - Unchanged -->
    <div class="sidebar">
        <div class="sidebar-image-container">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&h=800&q=80" 
                 alt="Students collaborating in modern campus" 
                 class="sidebar-image">
        </div>
        <div class="sidebar-content">
            <p class="text-sm">Welcome to your student dashboard</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto bg-gray-50">
        <!-- Header - Unchanged -->
        <header class="bg-blue-200 shadow p-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button id="mobileMenuButton" class="md:hidden text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-800">MAHE Hostel Management System- Student Dashboard</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button id="notificationButton" class="text-gray-600 relative">
                        <!--<span id="notificationBadge" class="notification-badge hidden">0</span>-->
                    </button>
                    <div id="notificationDropdown" class="notification-dropdown">
                        <div class="notification-header">
                            <h3 class="font-medium">Notifications</h3>
                            <button id="markAllRead" class="text-xs text-blue-600">Mark all as read</button>
                        </div>
                        <div id="notificationList">
                            
                        </div>
                        <div class="notification-footer">
                            <a href="#" class="text-sm text-blue-600">View all notifications</a>
                        </div>
                    </div>
                </div>
                <div class="dropdown relative">
                    <button class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="hidden md:inline">Student</span>
                    </button>
                    <div class="dropdown-menu">
                        <button id="logoutBtn" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content - Modified Cards -->
        <main class="p-4"> <!-- Reduced padding from p-6 to p-4 -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4"> <!-- Changed to 4 columns and reduced gap -->
                <!-- Profile Card -->
                <div class="dashboard-card">
                    <div class="flex items-center space-x-4"> <!-- Reduced space-x from 4 to 3 -->
                        <div class="dashboard-icon bg-blue-100 text-blue-600">
                            <i class="fas fa-user"></i>
                        </div>
                        <h2 class="dashboard-title font-semibold">Profile</h2>
                    </div>
                    <p class="dashboard-desc text-gray-600">View and update your personal information</p>
                    <a href="student-profile.php" class="dashboard-link text-blue-600 font-medium">View Profile →</a>
                </div>

                <!-- Guest Log Card -->
                <div class="dashboard-card">
                    <div class="flex items-center space-x-3">
                        <div class="dashboard-icon bg-purple-100 text-purple-600">
                            <i class="fas fa-users"></i>
                        </div>
                        <h2 class="dashboard-title font-semibold">Guest Log</h2>
                    </div>
                    <p class="dashboard-desc text-gray-600">Register and view guest entries</p>
                    <a href="student-guestlog.php" class="dashboard-link text-purple-600 font-medium">Manage Guests →</a>
                </div>

                <!-- Fee Payments Card -->
                <div class="dashboard-card">
                    <div class="flex items-center space-x-3">
                        <div class="dashboard-icon bg-yellow-100 text-yellow-600">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h2 class="dashboard-title font-semibold">Fee Payments</h2>
                    </div>
                    <p class="dashboard-desc text-gray-600">View and make fee payments</p>
                    <a href="student-fees.php" class="dashboard-link text-yellow-600 font-medium">Pay Fees →</a>
                </div>

                <!-- Attendance Log Card -->
                <div class="dashboard-card">
                    <div class="flex items-center space-x-3">
                        <div class="dashboard-icon bg-green-100 text-green-600">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h2 class="dashboard-title font-semibold">Attendance</h2>
                    </div>
                    <p class="dashboard-desc text-gray-600">View your hostel attendance</p>
                    <a href="student-attendance.php" class="dashboard-link text-green-600 font-medium">View Log →</a>
                </div>

                <!-- Maintenance Card -->
                <div class="dashboard-card">
                    <div class="flex items-center space-x-3">
                        <div class="dashboard-icon bg-indigo-100 text-indigo-600">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h2 class="dashboard-title font-semibold">Maintenance</h2>
                    </div>
                    <p class="dashboard-desc text-gray-600">Submit maintenance requests</p>
                    <a href="student-maintenance.php" class="dashboard-link text-indigo-600 font-medium">Request Service →</a>
                </div>

                <!-- Notices Card -->
                <div class="dashboard-card">
                    <div class="flex items-center space-x-3">
                        <div class="dashboard-icon bg-pink-100 text-pink-600">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <h2 class="dashboard-title font-semibold">Notices</h2>
                    </div>
                    <p class="dashboard-desc text-gray-600">View important notices</p>
                    <a href="student-notices.php" class="dashboard-link text-pink-600 font-medium">View Notices →</a>
                </div>

                <!-- Complaints Card -->
                <div class="dashboard-card">
                    <div class="flex items-center space-x-3">
                        <div class="dashboard-icon bg-orange-100 text-orange-600">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h2 class="dashboard-title font-semibold">Complaints</h2>
                    </div>
                    <p class="dashboard-desc text-gray-600">Submit complaints</p>
                    <a href="student-complaints.php" class="dashboard-link text-orange-600 font-medium">Submit Complaint →</a>
                </div>

                <!-- Mess Management Card -->
                <div class="dashboard-card">
                    <div class="flex items-center space-x-3">
                        <div class="dashboard-icon bg-teal-100 text-teal-600">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h2 class="dashboard-title font-semibold">Mess</h2>
                    </div>
                    <p class="dashboard-desc text-gray-600">View mess details</p>
                    <a href="student-mess.php" class="dashboard-link text-teal-600 font-medium">Manage Mess →</a>
                </div>
            </div>
        </main>
    </div>

    <!-- Keep all existing JavaScript -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuButton').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hidden');
        });

        // Logout functionality
        document.getElementById('logoutBtn').addEventListener('click', function() {
            window.location.href = 'index.php';
        });

        // Dropdown functionality
        const dropdown = document.querySelector('.dropdown');
        dropdown.addEventListener('click', function(e) {
            if (window.innerWidth < 768) {
                e.preventDefault();
                this.querySelector('.dropdown-menu').classList.toggle('hidden');
            }
        });

        // Notification functionality
        const notificationButton = document.getElementById('notificationButton');
        const notificationDropdown = document.getElementById('notificationDropdown');
        const notificationBadge = document.getElementById('notificationBadge');
        const notificationList = document.getElementById('notificationList');
        const markAllRead = document.getElementById('markAllRead');

        // Count unread notifications and update badge
        function updateNotificationBadge() {
            const unreadCount = document.querySelectorAll('.notification-item.unread').length;
            if (unreadCount > 0) {
                notificationBadge.textContent = unreadCount;
                notificationBadge.classList.remove('hidden');
            } else {
                notificationBadge.classList.add('hidden');
            }
        }

        // Toggle notification dropdown
        notificationButton.addEventListener('click', function(e) {
            e.stopPropagation();
            notificationDropdown.classList.toggle('hidden');
            
            // Mark notifications as read when dropdown is opened
            if (!notificationDropdown.classList.contains('hidden')) {
                document.querySelectorAll('.notification-item.unread').forEach(item => {
                    item.classList.remove('unread');
                });
                updateNotificationBadge();
            }
        });

        // Mark all notifications as read
        markAllRead.addEventListener('click', function(e) {
            e.stopPropagation();
            document.querySelectorAll('.notification-item.unread').forEach(item => {
                item.classList.remove('unread');
            });
            updateNotificationBadge();
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function() {
            notificationDropdown.classList.add('hidden');
            document.querySelector('.dropdown-menu').classList.add('hidden');
        });

        // Prevent dropdown from closing when clicking inside
        notificationDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Simulate receiving a new notification (for demo)
        function simulateNewNotification() {
            const now = new Date();
            const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            
            const newNotification = document.createElement('div');
            newNotification.className = 'notification-item unread';
            newNotification.innerHTML = `
                <div class="font-medium">New system message</div>
                <p class="text-sm">Hostel curfew time has been updated to 11 PM</p>
                <div class="notification-time">Just now (${timeString})</div>
            `;
            
            notificationList.insertBefore(newNotification, notificationList.firstChild);
            updateNotificationBadge();
            
            // Show a subtle alert if dropdown is closed
            if (notificationDropdown.classList.contains('hidden')) {
                notificationBadge.classList.add('animate-pulse');
                setTimeout(() => {
                    notificationBadge.classList.remove('animate-pulse');
                }, 2000);
            }
        }

        // Initialize notification badge
        updateNotificationBadge();

        // For demo purposes: add a new notification every 30 seconds
        setInterval(simulateNewNotification, 30000);
    </script>
</body>
</html>