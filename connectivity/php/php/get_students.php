<?php
include 'db_connection.php';

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td class='px-6 py-4 whitespace-nowrap'>".$row['id']."</td>
                <td class='px-6 py-4 whitespace-nowrap'>".$row['fullname']."</td>
                <td class='px-6 py-4 whitespace-nowrap'>".$row['email']."</td>
                <td class='px-6 py-4 whitespace-nowrap'>".$row['phone']."</td>
                <td class='px-6 py-4 whitespace-nowrap'>".$row['block']."</td>
                <td class='px-6 py-4 whitespace-nowrap'>".$row['room']."</td>
                <td class='px-6 py-4 whitespace-nowrap'>".$row['room_type']."</td>
                <td class='px-6 py-4 whitespace-nowrap'>
                    <span class='px-2 py-1 text-xs rounded-full bg-green-100 text-green-800'>Active</span>
                </td>
                <td class='px-6 py-4 whitespace-nowrap'>
                    <button class='text-blue-600 hover:text-blue-900 mr-3 edit-btn' data-id='".$row['id']."'>
                        <i class='fas fa-edit'></i>
                    </button>
                    <button class='text-red-600 hover:text-red-900 delete-btn' data-id='".$row['id']."'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='9' class='text-center py-4'>No students found</td></tr>";
}
$conn->close();
?>