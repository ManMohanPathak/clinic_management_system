<?php
include 'dbconnect.php';

$search = isset($_GET['query']) ? $_GET['query'] : '';

if ($search !== '') {
    $stmt = $conn->prepare("SELECT * FROM Medicines WHERE name LIKE ? OR shortcut LIKE ? ORDER BY created_at DESC");
    $searchTerm = "%$search%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $medicines = [];
    while ($row = $result->fetch_assoc()) {
        $medicines[] = $row;
    }

    echo json_encode($medicines);
}
?>
