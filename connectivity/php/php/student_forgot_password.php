<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db_connection.php");

// Debug received data
file_put_contents('debug_attendance.txt', print_r($_POST, true));

$reg_no = $_POST['registrationNumber'];
$password = $_POST['password'];
$confirm_password = $_POST['confirmPassword'];
$answer = $_POST['securityQ']; // New field

// Validate inputs
if (empty($reg_no) || empty($password) || empty($confirm_password) || empty($answer)) {
    echo "All fields are required!";
    exit;
}

if ($password != $confirm_password) {
    echo "Password and Confirm Password do not match!";
    exit;
}

// Check if student login exists and fetch the answer
$check_login_query = "SELECT answer FROM student_login WHERE student_id = '$reg_no'";
$result = $conn->query($check_login_query);

if ($result->num_rows == 0) {
    echo "No login found for the provided student ID!";
    exit;
}

$row = $result->fetch_assoc();

// Compare the provided answer (case-insensitive)
if (strcasecmp($row['answer'], $answer) !== 0) {
    echo "Security answer does not match!";
    exit;
}



// Update password
$update_query = "UPDATE student_login SET password_hash = '$password' WHERE student_id = '$reg_no'";

if ($conn->query($update_query) === TRUE) {
    echo "Password reset successful!";
} else {
    echo "Error: " . $update_query . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
