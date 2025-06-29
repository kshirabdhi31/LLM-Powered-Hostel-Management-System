<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

//------------------debbugging code--------------------
// Start session to access logged-in student ID
// session_start();
// echo "<pre style='background: #fff; padding: 20px; border: 2px solid red;'>";
// echo "SESSION DATA:\n";
// print_r($_SESSION);
// echo "\nPOST DATA:\n";
// print_r($_POST);
// echo "</pre>";
//--------------------------------------------------------------
include("db_connection.php");

// Check if user is logged in
if (!isset($_SESSION['student_id'])) {
    die("Error: User not logged in");
}





// Validate required fields
if ( 
    empty($_POST['request_type']) || 
    empty($_POST['description']) || 
   // empty($_POST['status']) || 
    empty($_POST['date_submitted'])) {
    die("All fields are required");
}

// Assign variables
$student_id = $_SESSION['student_id'];
$request_type = $_POST['request_type'];
$description = $_POST['description'];
//$status = $_POST['status'];
$date_submitted = date('Y-m-d', strtotime($_POST['date_submitted']));

// Check connection
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Prepare and execute statement
$stmt = $conn->prepare("INSERT INTO maintenancerequest 
    (student_id, request_type, description, date_submitted) 
    VALUES (?, ?, ?, ?)");

$stmt->bind_param("ssss", $student_id, $request_type, $description,  $date_submitted);

if ($stmt->execute()) {
    echo "Maintenance request submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>