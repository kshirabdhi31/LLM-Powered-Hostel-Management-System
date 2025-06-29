<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db_connection.php");

// Debug received data
print_r($_POST);

// Validate required fields
if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['start_date']) || empty($_POST['end_date'])) {
    die("All fields are required");
}

$titlee = $_POST['title'];
$contentt = $_POST['content'];
$start_datee = date('Y-m-d', strtotime($_POST['start_date']));
$end_datee = date('Y-m-d', strtotime($_POST['end_date']));



if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO Notices (title, description, start_date, end_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $titlee, $contentt, $start_datee, $end_datee);
    
    if ($stmt->execute()) {
        echo "Notice added successfully! Rows affected: " . $stmt->affected_rows;
    } else {
        echo "Error: " . $stmt->error . " | MySQL Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>