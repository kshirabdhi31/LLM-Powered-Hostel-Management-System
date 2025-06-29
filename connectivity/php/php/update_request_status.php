<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db_connection.php");

// Check if user is logged in


// Debugging block
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

// Validate required fields
if (empty($_POST['request_id']) || empty($_POST['status'])) {
    die("Error: All fields are required");
}

$request_id = $_POST['request_id'];
$status = $_POST['status'];

// Update query
$query = "UPDATE maintenancerequest SET status = ? WHERE request_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $status, $request_id);

if ($stmt->execute()) {
    echo "Status updated successfully.";
} else {
    echo "Error updating status: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
