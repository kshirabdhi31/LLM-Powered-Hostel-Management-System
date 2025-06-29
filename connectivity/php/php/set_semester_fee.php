<?php
include 'db_connection.php';

$room_type = $_POST['room_type'];
$amount = $_POST['amount'];

// Update or insert the fee structure
$sql = "INSERT INTO fee_structure (room_type, amount) 
        VALUES ('$room_type', '$amount')
        ON DUPLICATE KEY UPDATE amount = '$amount'";

if ($conn->query($sql)) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>