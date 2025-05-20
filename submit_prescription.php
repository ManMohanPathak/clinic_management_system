<?php
// submit_prescription.php

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drpandey";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => $conn->connect_error]));
}

$data = json_decode(file_get_contents('php://input'), true);

$patientName = $conn->real_escape_string($data['patientName']);
$mobileNumber = $conn->real_escape_string($data['mobileNumber']);
$age = (int)$data['age'];
$address = $conn->real_escape_string($data['address']);
$gender = (int)$data['gender'];
$date = date('Y-m-d H:i:s');

// Get year and month for custom ID
$year = date('y'); // Last two digits of the year
$month = date('m');

// Find the last custom ID inserted for the current month
$sql = "SELECT custom_id FROM prescription WHERE custom_id LIKE '$year$month%' ORDER BY custom_id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastCustomId = $row['custom_id'];
    // Extract the last sequential number and increment it
    $lastNumber = (int)substr($lastCustomId, 4);
    $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
} else {
    // No entries for this month, start with 001
    $newNumber = '001';
}

// Construct the new custom ID
$customId = $year . $month . $newNumber;

// Insert data into the database
$sql = "INSERT INTO prescription (custom_id, patientname, mobileno, age, address, Gender, date) VALUES ('$customId', '$patientName', '$mobileNumber', $age, '$address', $gender, '$date')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'customId' => $customId]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();
?>
