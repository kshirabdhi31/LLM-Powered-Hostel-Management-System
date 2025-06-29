<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("db_connection.php");

// Get admin credentials from form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Validate inputs
if (empty($username) || empty($password)) {
    header("Location: ../../admin-login.php?error=All fields are required");
    exit();
}

// Check admin credentials
$stmt = $conn->prepare("SELECT username FROM admin WHERE username = ? AND password = ?");
if ($stmt === false) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // ✅ Login successful — now set session
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;

    header("Location: ../../admin-dashboard.php");
    exit();
} else {
    // ❌ Login failed
    header("Location: ../../admin-login.php?error=Invalid credentials");
    exit();
}


$stmt->close();
$conn->close();
?>
