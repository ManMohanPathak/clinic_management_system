<?php
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['patientname'];
    $age = $_POST['age'];
    $gender = $_POST['Gender'];
    $mobile = $_POST['mobileno'];
    $address = $_POST['address'] ?? '';
    $custom_id = strtoupper(uniqid('PID'));
    $date = date('d-m-y H:i:s');
    $visited_by_doctor = 'no';
    $last_visited = NULL;

    // Include visited_by_doctor and last_visited in the INSERT statement
    $stmt = $conn->prepare("INSERT INTO prescription (patientname, age, Gender, mobileno, address, custom_id, date, visited_by_doctor, last_visited) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siissssss", $name, $age, $gender, $mobile, $address, $custom_id, $date, $visited_by_doctor, $last_visited);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
