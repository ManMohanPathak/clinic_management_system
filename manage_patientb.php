<?php
include 'dbconnect.php';

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sql = "SELECT * FROM prescription 
        WHERE patientname LIKE '%$search%' OR mobileno LIKE '%$search%' OR custom_id LIKE '%$search%'
        ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gender = $row['Gender'] ? 'Male' : 'Female';
        $visited = $row['visited_by_doctor'] == 'yes'
            ? "<i class='fas fa-check-circle' style='color: green;'></i>"
            : "<i class='fa fa-times-circle' style='color: red;'></i>";

        $lastVisited = $row['last_visited'] ? date('d M Y, h:i A', strtotime($row['last_visited'])) : 'Not visited';

        echo "<tr>
                <td>{$row['custom_id']}</td>
                <td>{$row['patientname']}</td>
                <td>{$row['age']}</td>
                <td>{$gender}</td>
                <td>{$row['mobileno']}</td>
                <td>{$visited}</td>
                <td>{$lastVisited}</td>
                <td>
                    <button class='btn btn-sm btn-primary write-prescription' data-id='{$row['id']}'>Write</button>
                    <button class='btn btn-sm btn-warning upload-report' data-id='{$row['id']}'>Report</button>
                    <button class='btn btn-sm btn-success manage-fee' data-id='{$row['id']}'>Fee</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
}

$conn->close();
?>
