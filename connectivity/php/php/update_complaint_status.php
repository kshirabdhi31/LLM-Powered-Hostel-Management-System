<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db_connection.php");

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    echo "Session variable 'loggedin' is not set.<br>";
    die("Error: User not logged in");
} else {
    echo "Session variable 'loggedin' is set.<br>";
}

// Validate required fields
if (empty($_POST['complaint_id']) || empty($_POST['status']) || empty($_POST['resolution'])) {
    die("Error: All fields are required");
}

$complaint_id = $_POST['complaint_id'];
$status = $_POST['status'];
$resolution = $_POST['resolution'];

echo "Query would be: UPDATE complaint SET status = '$status', resolution = '$resolution' WHERE complaint_id = $complaint_id<br>";

// Corrected SQL query
$query = "UPDATE complaint SET status = ?, resolution = ? WHERE complaint_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssi", $status, $resolution, $complaint_id);

if ($stmt->execute()) {
    echo "Status and resolution updated successfully.";
} else {
    echo "Error updating status and resolution: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
