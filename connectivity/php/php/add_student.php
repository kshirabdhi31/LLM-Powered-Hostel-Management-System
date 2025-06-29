<?php
include("db_connection.php");
$conn->begin_transaction();

try {
    // Required fields validation
    $required_fields = ['studentID', 'fullname', 'email', 'phone', 'block', 'room', 'room_type', 'status'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("All fields are required");
        }
    }

    $id = $_POST['studentID'];
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $block = $_POST['block'];
    $room = $_POST['room'];
    $room_type = $_POST['room_type'];
    $status = $_POST['status'];

    // Step 1: Check if room is already allocated
    $checkQuery = "SELECT * FROM hostel_allocated WHERE hostel_no = ? AND room_no = ?";
    $checkStmt = $conn->prepare($checkQuery);
    if (!$checkStmt) {
        throw new Exception("Prepare failed (checkStmt): " . $conn->error);
    }
    $checkStmt->bind_param("ii", $block, $room);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        throw new Exception("Room $block-$room is already allocated.");
    }

    // Step 2: Insert into hostel_allocated
    $allocStmt = $conn->prepare("INSERT INTO hostel_allocated (hostel_no, room_no) VALUES (?, ?)");
    if (!$allocStmt) {
        throw new Exception("Prepare failed (allocStmt): " . $conn->error);
    }
    $allocStmt->bind_param("ii", $block, $room);
    $allocStmt->execute();

    // Step 3: Insert into student table
    $studentStmt = $conn->prepare("INSERT INTO student 
        (student_id, name, email, phone_no, block_no, room_no, room_type, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$studentStmt) {
        throw new Exception("Prepare failed (studentStmt): " . $conn->error);
    }
    $studentStmt->bind_param("isssiiss", 
        $id, $name, $email, $phone, $block, $room, $room_type, $status);
    $studentStmt->execute();

    // Optional: Update status in hostels table
    $updateStmt = $conn->prepare("UPDATE hostels SET status = 'occupied' WHERE hostel_no = ? AND room_no = ?");
    $updateStmt->bind_param("ii", $block, $room);
    $updateStmt->execute();

    $conn->commit();

    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => "Student registered and room allocated successfully!"
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
    if (isset($allocStmt) && $allocStmt instanceof mysqli_stmt) $allocStmt->close();
    if (isset($studentStmt) && $studentStmt instanceof mysqli_stmt) $studentStmt->close();
    if (isset($updateStmt) && $updateStmt instanceof mysqli_stmt) $updateStmt->close();
    $conn->close();
}
?>
