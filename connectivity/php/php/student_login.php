<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session to maintain login state
session_start();

include("db_connection.php");

// Get form data
$reg_no = $_POST['student_id'] ?? '';
$password = $_POST['password'] ?? '';

// Validate inputs
if (empty($reg_no) || empty($password)) {
    header("Location: login_page.php?error=All fields are required");
    exit();
}

// Check if credentials exist and match
$login_query = "SELECT student_id FROM student_login 
                WHERE student_id = ? AND password_hash = ?";
$stmt = $conn->prepare($login_query);

if ($stmt === false) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("ss", $reg_no, $password);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Login successful
    $_SESSION['student_id'] = $reg_no;
    $_SESSION['loggedin'] = true;
    header("Location: ../../student-dashboard.php");
    exit();
} else {
    // Login failed

    header("Location: ../../student-login.php");
    exit();
}

$stmt->close();
$conn->close();
?>
