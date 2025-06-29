<?php
session_start();
require_once('php/php/db_connection.php');

// Get payment details for the logged-in student
$student_id = $_SESSION['student_id']; // Make sure you have student_id in session
$payment_query = "SELECT pay_due, pay_amt, balance FROM payment WHERE student_id = '$student_id'";
$payment_result = mysqli_query($conn, $payment_query);
$payment_data = mysqli_fetch_assoc($payment_result);

// Get payment history
$history_query = "SELECT * FROM payment WHERE student_id = '$student_id' ORDER BY payment_date DESC";
$history_result = mysqli_query($conn, $history_query);

// Get payment details for the logged-in student, including the reminder
$payment_query = "SELECT pay_due, pay_amt, balance, CASE WHEN status = 'completed' THEN 'No reminder' ELSE reminder END AS reminder FROM payment WHERE student_id = '$student_id'";

$payment_result = mysqli_query($conn, $payment_query);
$payment_data = mysqli_fetch_assoc($payment_result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fees | Hostel Student</title>
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
            background-color:rgb(55, 44, 70);
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
            background: rgb(248, 234, 255);
            border-left: 4px solidrgb(12, 2, 16);
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
            border-color:rgb(70, 65, 77);
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
                    <a href="student-fees.php" class="flex items-center space-x-3 p-3 bg-teal-900">
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
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-800">Fee Payments</h1>
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

        <!-- Fee Payments Content -->
        <main class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Payment Summary Cards -->
                <div class="summary-card p-6 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-700">Total Due</h3>
                    <p class="text-2xl font-bold text-blue-500">$<?php echo number_format($payment_data['pay_due'], 2); ?></p>
                </div>
                <div class="summary-card p-6 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-700">Paid Amount</h3>
                    <p class="text-2xl font-bold text-green-600">$<?php echo number_format($payment_data['pay_amt'], 2); ?></p>
                </div>
                <div class="summary-card p-6 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-700">Balance</h3>
                    <p class="text-2xl font-bold text-red-600">$<?php echo number_format($payment_data['balance'], 2); ?></p>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="highlight-card rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4 accent-text">Make Payment</h2>
                <form id="paymentForm">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2 font-medium">Amount</label>
                        <input type="number" name="amount" class="form-input" placeholder="Enter amount" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2 font-medium">Payment Method</label>
                        <select name="payment_method" class="form-input" required>
                            <option value="Credit/Debit Card">Credit/Debit Card</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2 font-medium">Due Date</label>
                        <p class="font-medium accent-text">15 July 2023</p>
                    </div>
                    <button type="submit" class="btn-primary w-full">
                        <i class="fas fa-credit-card mr-2"></i> Proceed to Payment
                    </button>
                </form>
            </div>
            
           
            <!-- Reminder Section -->
    <!-- Reminder Section with Custom Background Color -->
    <div class="highlight-card rounded-lg p-6 mb-6 bg-purple-100 border-l-4 border-purple-500">
        <h2 class="text-lg font-semibold mb-4 accent-text">Reminder</h2>
        <?php if (!empty($payment_data['reminder'])): ?>
            <p class="text-gray-700"><?php echo $payment_data['reminder']; ?></p>
        <?php else: ?>
            <p class="text-gray-500">No reminder at the moment.</p>
        <?php endif; ?>
    </div>
        
            
                
            </div>
        </main>
    </div>

    <script>
        // Mobile menu toggle functionality
        document.querySelector('.md\\:hidden').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hidden');
        });

        // Payment form submission
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('php/php/student-feess.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Update the displayed amounts
                    document.querySelector('p.text-blue-500').textContent = '$' + data.pay_due.toFixed(2);
                    document.querySelector('p.text-green-600').textContent = '$' + data.pay_amt.toFixed(2);
                    document.querySelector('p.text-red-600').textContent = '$' + data.balance.toFixed(2);
                    // Reload the page to show updated payment history
                    location.reload();
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing the payment');
            });
        });
    </script>
</body>
</html>