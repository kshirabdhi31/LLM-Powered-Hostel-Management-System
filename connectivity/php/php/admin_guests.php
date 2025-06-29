<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db_connection.php");

// Debug posted data
file_put_contents('debug_guest_status.txt', print_r($_POST, true));

// Validate required fields
if (empty($_POST['studentId']) || empty($_POST['visitId']) || empty($_POST['status'])) {
    die(json_encode(['success' => false, 'error' => 'Student ID, Visit ID, and Status are required']));
}

$student_id = $_POST['studentId'];
$visit_id = $_POST['visitId'];
$status = $_POST['status'];

// Validate status
$allowed_statuses = ['Pending', 'Approved', 'Rejected'];
if (!in_array($status, $allowed_statuses)) {
    die(json_encode(['success' => false, 'error' => 'Invalid status value']));
}

// Check database connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
}

// Check if the guest visit exists
$check_stmt = $conn->prepare("SELECT visit_id FROM guest_visits WHERE visit_id = ? AND student_id = ?");
$check_stmt->bind_param("ii", $visit_id, $student_id);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows == 0) {
    die(json_encode(['success' => false, 'error' => 'Guest visit not found for given student']));
}
$check_stmt->close();

// Update the status
$update_stmt = $conn->prepare("UPDATE guest_visits SET status = ? WHERE visit_id = ? AND student_id = ?");
$update_stmt->bind_param("sii", $status, $visit_id, $student_id);

if ($update_stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Guest visit status updated successfully',
        'data' => [
            'student_id' => $student_id,
            'visit_id' => $visit_id,
            'status' => $status
        ]
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $update_stmt->error
    ]);
}

$update_stmt->close();
$conn->close();
?>
