<?php
session_start();
require_once('php/php/db_connection.php');

$payment_data = null;
$history_result = null;

// If form was submitted
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];  // use GET since form uses GET method

    // Fetch payment summary
    $payment_query = "SELECT pay_due, pay_amt, balance FROM payment WHERE student_id = '$student_id'";
    $payment_result = mysqli_query($conn, $payment_query);
    $payment_data = mysqli_fetch_assoc($payment_result);

    // Fetch payment history
    $history_query = "SELECT * FROM payment WHERE student_id = '$student_id'";
    $history_result = mysqli_query($conn, $history_query);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Management | Hostel Admin</title>
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
                    <a href="admin-notices.php" class="flex items-center space-x-3 p-3 hover:bg-gray-700">
                        <i class="fas fa-bullhorn text-md w-6 text-center"></i>
                        <span class="text-sm">Upload Notices</span>
                    </a>
                </li>
                <li>
                    <a href="admin-payments.php" class="flex items-center space-x-3 p-3 bg-gray-700">
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
    <div class="flex-1 overflow-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Fee Management</h1>
        
        <!-- Student Selection and Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6 md:col-span-1">
                <h2 class="text-lg font-semibold mb-4">Student Details</h2>
                <form method="GET" action="">
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Enter Student ID</label>
        <div class="flex gap-2">
            <input type="text" id="studentIdInput" 
                   name="student_id" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500"
                   placeholder="Enter Student ID"  value="<?php echo isset($_GET['student_id']) ? htmlspecialchars($_GET['student_id']) : ''; ?>" required>
            <button type="submit" 
                    class="px-4 py-2 bg-teal-800 text-white rounded hover:bg-teal-990 whitespace-nowrap">
                View Payments
            </button>
        </div>
    </div>
</form>
</div>
            
            <div class="bg-white rounded-lg shadow p-6 md:col-span-2">
                <h2 class="text-lg font-semibold mb-4">Fee Summary</h2>
                <div class="grid grid-cols-3 gap-4">
                    <div class="p-3 bg-blue-50 rounded">
                        <p class="text-sm text-gray-500">Total Due</p>
                        <p class="text-xl font-bold" id="totalDue">$ <?php echo $payment_data ? htmlspecialchars($payment_data['pay_due']) : '0.00'; ?></p>
                    </div>
                    <div class="p-3 bg-green-50 rounded">
                        <p class="text-sm text-gray-500">Amount Paid</p>
                        <p class="text-xl font-bold text-green-600" id="amountPaid">$<?php echo $payment_data ? htmlspecialchars($payment_data['pay_amt']) : '0.00'; ?></p>
                    </div>
                    <div class="p-3 bg-red-50 rounded">
                        <p class="text-sm text-gray-500">Balance</p>
                        <p class="text-xl font-bold text-red-600" id="balance">$<?php echo $payment_data ? htmlspecialchars($payment_data['balance']) : '0.00'; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fee Management Tools -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="p-4 border-b">
                <h2 class="text-lg font-semibold">Fee Actions</h2>
            </div>
            <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Send Reminder Section -->
                <form method="POST" action="php/php/admin-fees.php">
    <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($_GET['student_id'] ?? ''); ?>">
    
    <label class="block text-gray-700 mb-2">Add Reminder</label>
    <textarea name="reminder" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-teal-500" required></textarea>
    
    <button type="submit" 
            class="mt-2 px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">
         Reminder
    </button>
</form>


   

                <!-- Payment History Section -->
                <div class="col-span-1">
                    <h3 class="font-medium mb-2">Payment History</h3>
                    <div class="border rounded-lg overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    
                                    <th class="px-4 py-2 text-left text-sm">Amount</th>
                                    <th class="px-4 py-2 text-left text-sm">status</th>
                                </tr>
                            </thead>
                            <tbody id="paymentHistory" class="text-sm">
    <?php if ($history_result && mysqli_num_rows($history_result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($history_result)): ?>
            <tr>
                <td class="px-4 py-2"><?php echo htmlspecialchars($row['pay_amt']); ?></td>
                <td class="px-4 py-2"><?php echo htmlspecialchars($row['status']); ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="2" class="px-4 py-2 text-center text-gray-500">No payment history found.</td>
        </tr>
    <?php endif; ?>
</tbody>


     

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Modal -->
        <div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold" id="modalTitle">Record Payment</h3>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="paymentForm">
                    <input type="hidden" id="paymentStudentId">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Amount</label>
                        <input type="number" id="modalPaymentAmount" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Payment Method</label>
                        <select id="paymentMethod" class="w-full px-3 py-2 border rounded" required>
                            <option value="Cash">Cash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Mobile Payment">Mobile Payment</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Payment Date</label>
                        <input type="date" id="paymentDate" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" id="cancelPayment" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
    // View Payments Button Handler
    $('#viewPaymentsBtn').click(function(event) {
        event.preventDefault(); // Prevent page refresh

        const studentId = $('#studentIdInput').val();
        if (studentId) {
            fetchPaymentDetails(studentId);
        } else {
            alert('Please enter a valid Student ID');
        }
    });
});


                // Send Reminder Button Handler
                $('#sendReminderBtn').click(function() {
                    const studentId = $('#studentIdInput').val();
                    const message = $('#reminderMessage').val();
                    
                    if(studentId && message) {
                        alert(`Reminder sent to ${studentId}:\n${message}`);
                        $('#reminderMessage').val('');
                    } else {
                        alert('Please enter both Student ID and reminder message');
                    }
                });

                // Simulated payment details fetch
                function fetchPaymentDetails(studentId) {
                  
                }

                // Modal handlers
                $('#closeModal, #cancelPayment').click(function() {
                    $('#paymentModal').addClass('hidden');
                });
            });
        </script>
    </div>
</body>
</html>