<?php
session_start();
include("db_connection.php");

header('Content-Type: application/json');

try {
    // Check if user is logged in
    if (!isset($_SESSION['student_id'])) {
        throw new Exception("Student not logged in");
    }

    // Validate required fields
    if (empty($_POST['amount']) || empty($_POST['payment_method'])) {
        throw new Exception("Amount and payment method are required");
    }

    $student_id = $_SESSION['student_id'];
    $amount = floatval($_POST['amount']);
    $payment_method = $_POST['payment_method'];

    // Begin transaction
    $conn->begin_transaction();

    // 1. Get current payment details
    $getQuery = "SELECT pay_due, pay_amt, balance FROM payment WHERE student_id = ?";
    $getStmt = $conn->prepare($getQuery);
    if (!$getStmt) {
        throw new Exception("Prepare failed (getStmt): " . $conn->error);
    }
    $getStmt->bind_param("i", $student_id);
    $getStmt->execute();
    $result = $getStmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception("No payment record found for this student");
    }

    $payment = $result->fetch_assoc();
    $current_paid = floatval($payment['pay_amt']);
    $current_balance = floatval($payment['balance']);
    $total_due = floatval($payment['pay_due']);

    // 2. Calculate new values
    $new_paid = $current_paid + $amount;
    $new_balance = $total_due - $new_paid;

    if ($new_balance < 0) {
        throw new Exception("Payment amount exceeds total due");
    }

    // 3. Determine status based on whether payment is complete
    $status = ($total_due == $new_paid) ? 'Completed' : 'Pending';

    // 4. Update payment record
    $updateQuery = "UPDATE payment SET 
                    pay_amt = ?, 
                    balance = ?, 
                    payment_method = ?, 
                    status = ? 
                    WHERE student_id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    if (!$updateStmt) {
        throw new Exception("Prepare failed (updateStmt): " . $conn->error);
    }
    $updateStmt->bind_param("dsssi", $new_paid, $new_balance, $payment_method, $status, $student_id);
    $updateStmt->execute();

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => "Payment processed successfully!",
        'new_paid' => $new_paid,
        'new_balance' => $new_balance,
        'status' => $status
    ]);

} catch (Exception $e) {
    $conn->rollback();
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
} finally {
    if (isset($getStmt) && $getStmt instanceof mysqli_stmt) $getStmt->close();
    if (isset($updateStmt) && $updateStmt instanceof mysqli_stmt) $updateStmt->close();
    $conn->close();
}
?>