<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db_connection.php");

// Debug received data
file_put_contents('debug_attendance.txt', print_r($_POST, true));

// Validate required fields
if (empty($_POST['studentId']) || empty($_POST['date'])) {
    die(json_encode(['success' => false, 'error' => 'Student ID and Date are required']));
}

$student_id = $_POST['studentId'];
$date = date('Y-m-d', strtotime($_POST['date']));
$status = $_POST['status'] ?? 'Absent'; // Default to Absent if not provided

// Validate status
if (!in_array($status, ['Present', 'Absent'])) {
    die(json_encode(['success' => false, 'error' => 'Invalid status value']));
}

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection Failed: ' . $conn->connect_error]));
} else {
    // Check if student exists
    $check_stmt = $conn->prepare("SELECT student_id FROM Student WHERE student_id = ?");
    $check_stmt->bind_param("s", $student_id);
    $check_stmt->execute();
    $check_stmt->store_result();
    
    if ($check_stmt->num_rows == 0) {
        die(json_encode(['success' => false, 'error' => 'Student not found']));
    }
    $check_stmt->close();

    // Check if attendance already exists for this student on this date
    $existing_stmt = $conn->prepare("SELECT attendance_id FROM attendance WHERE student_id = ? AND date = ?");
    $existing_stmt->bind_param("ss", $student_id, $date);
    $existing_stmt->execute();
    $existing_stmt->store_result();
    
    if ($existing_stmt->num_rows > 0) {
        die(json_encode(['success' => false, 'error' => 'Attendance already recorded for this student on this date']));
    }
    $existing_stmt->close();

    // Insert new attendance record
    $stmt = $conn->prepare("INSERT INTO attendance (student_id, date, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $student_id, $date, $status);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'Attendance recorded successfully',
            'data' => [
                'student_id' => $student_id,
                'date' => $date,
                'status' => $status
            ]
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'error' => 'Database error: ' . $stmt->error,
            'mysql_error' => $conn->error
        ]);
    }

    $stmt->close();
    $conn->close();
}
?>