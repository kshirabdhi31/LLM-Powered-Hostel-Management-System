<?php
include 'db_connection.php';

$sql = "SELECT p.*, s.fullname, s.room_type 
        FROM payments p
        JOIN students s ON p.student_id = s.id
        ORDER BY p.due_date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $statusClass = $row['status'] == 'Paid' ? 'bg-green-100 text-green-800' : 
                      ($row['status'] == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');
        
        echo "<tr>
                <td class='px-6 py-4 whitespace-nowrap'>".$row['student_id']."</td>
                <td class='px-6 py-4 whitespace-nowrap'>".$row['fullname']."</td>
                <td class='px-6 py-4 whitespace-nowrap'>".$row['room_type']."</td>
                <td class='px-6 py-4 whitespace-nowrap'>$".number_format($row['amount'], 2)."</td>
                <td class='px-6 py-4 whitespace-nowrap'>".$row['due_date']."</td>
                <td class='px-6 py-4 whitespace-nowrap'>
                    <span class='px-2 py-1 text-xs rounded-full $statusClass'>".$row['status']."</span>
                </td>
                <td class='px-6 py-4 whitespace-nowrap'>
                    <button class='text-blue-600 hover:text-blue-900 mr-2 view-payment' data-id='".$row['id']."'>
                        <i class='fas fa-eye'></i>
                    </button>
                    <button class='text-yellow-600 hover:text-yellow-900 mr-2 edit-payment' data-id='".$row['id']."'>
                        <i class='fas fa-edit'></i>
                    </button>
                    <button class='text-red-600 hover:text-red-900 delete-payment' data-id='".$row['id']."'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center py-4'>No fee payments found</td></tr>";
}
$conn->close();
?>