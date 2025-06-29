<?php
include 'db_connection.php';

// Get all students
$students = $conn->query("SELECT * FROM students");

// Get fee structure
$feeStructure = [];
$result = $conn->query("SELECT * FROM fee_structure");
while ($row = $result->fetch_assoc()) {
    $feeStructure[$row['room_type']] = $row['amount'];
}

// Generate invoices for each student
while ($student = $students->fetch_assoc()) {
    $amount = $feeStructure[$student['room_type']] ?? 0;
    $due_date = date('Y-m-d', strtotime('+30 days'));
    
    $conn->query("INSERT INTO payments (student_id, amount, due_date, status)
                 VALUES ('".$student['id']."', '$amount', '$due_date', 'Pending')");
}

echo "Invoices generated successfully";
$conn->close();
?>