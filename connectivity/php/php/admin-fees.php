<?php
include("db_connection.php");
header('Content-Type: application/json');

try {
    // Validate input
    if (empty($_POST['student_id']) || empty($_POST['reminder'])) {
        throw new Exception("Student ID and reminder are required");
    }

    $student_id = intval($_POST['student_id']);
    $reminder = trim($_POST['reminder']);

    // Start transaction
    $conn->begin_transaction();

    // Check current status
    $checkQuery = "SELECT status FROM payment WHERE student_id = ?";
    $checkStmt = $conn->prepare($checkQuery);
    if (!$checkStmt) {
        throw new Exception("Prepare failed (checkStmt): " . $conn->error);
    }
    $checkStmt->bind_param("i", $student_id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception("No payment record found for the given student ID");
    }

    $row = $result->fetch_assoc();
    if ($row['status'] !== 'Pending') {
        throw new Exception("Cannot update reminder because payment status is not Pending.");
    }

    // Update reminder
    $updateQuery = "UPDATE payment SET reminder = ? WHERE student_id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    if (!$updateStmt) {
        throw new Exception("Prepare failed (updateStmt): " . $conn->error);
    }
    $updateStmt->bind_param("si", $reminder, $student_id);
    $updateStmt->execute();

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => "Reminder updated successfully"
    ]);

} catch (Exception $e) {
    $conn->rollback();
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
} finally {
    if (isset($checkStmt) && $checkStmt instanceof mysqli_stmt) $checkStmt->close();
    if (isset($updateStmt) && $updateStmt instanceof mysqli_stmt) $updateStmt->close();
    $conn->close();
}
?>
