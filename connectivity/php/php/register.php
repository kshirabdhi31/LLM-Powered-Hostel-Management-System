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

// Check if student exists
$check_student_query = "SELECT student_id FROM student WHERE student_id = '$reg_no'";
$student_result = $conn->query($check_student_query);

if ($student_result->num_rows == 0) {
    die("Student not found...please enter the correct student id!");
}

// Check if login already exists
$check_login_query = "SELECT student_id FROM student_login WHERE student_id = '$reg_no'";
$login_result = $conn->query($check_login_query);

if ($login_result->num_rows > 0) {
    die("This student already has login credentials. Please proceed to the login page!");
}



// Insert new record with answer
$insert_query = "INSERT INTO student_login (student_id, password_hash, answer) VALUES ('$reg_no', '$password', '$answer')";

if ($conn->query($insert_query) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $insert_query . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
