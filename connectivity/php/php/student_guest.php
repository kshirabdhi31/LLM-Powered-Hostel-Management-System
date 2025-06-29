<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db_connection.php");

// Check if user is logged in
if (!isset($_SESSION['student_id'])) {
    die("Error: User not logged in");
}

// Validate required fields
$required_fields = ['guest_name', 'relationship', 'visit_date', 'id_proof_type', 'id_proof_no', 'contact_no', 'purpose'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        die("All fields are required.");
    }
}

// Assign variables
$student_id = $_SESSION['student_id'];
$guest_name = $_POST['guest_name'];
$relationship = $_POST['relationship'];
$visit_date = date('Y-m-d', strtotime($_POST['visit_date']));
$id_proof_type = $_POST['id_proof_type'];
$id_proof_no = $_POST['id_proof_no'];
$contact_no = $_POST['contact_no'];
$purpose = $_POST['purpose'];

// Check DB connection
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Prepare insert query
$stmt = $conn->prepare("INSERT INTO guest_visits 
(student_id, guest_name, relationship, visit_date, id_proof_type, id_proof_no, contact_no, purpose) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("isssssss", $student_id, $guest_name, $relationship, $visit_date, $id_proof_type, $id_proof_no, $contact_no, $purpose);

if ($stmt->execute()) {
    echo "Guest visit logged successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
