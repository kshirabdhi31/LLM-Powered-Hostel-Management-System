<?php
include 'db_connection.php';

// Get all pending payments
$result = $conn->query("SELECT p.*, s.email, s.fullname 
                       FROM payments p
                       JOIN students s ON p.student_id = s.id
                       WHERE p.status = 'Pending'");

// In a real application, you would send emails here
// This is just a simulation
$count = 0;
while ($row = $result->fetch_assoc()) {
    $count++;
    // Actual email sending code would go here
    // mail($row['email'], "Payment Reminder", "Dear {$row['fullname']}, ...");
}

echo "$count reminders sent";
$conn->close();
?>