<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password is empty for XAMPP
$dbname = "Drpandey";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['patientName'];
    $age = $_POST['patientAge'];
    $email = $_POST['patientEmail'];
    $mobile = $_POST['patientMobile'];
    $date = $_POST['appointmentDate'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO onlineappointment (Name, Age, Email, MobileNo, Date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $name, $age, $email, $mobile, $date);

    // Execute statement
    if ($stmt->execute()) {
        echo "Appointment successfully booked!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
