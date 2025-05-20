<?php
include 'dbconnect.php';


// Add Medicine
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $shortcut = $_POST['shortcut'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO Medicines (name, shortcut, price, quantity, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $name, $shortcut, $price, $quantity, $description);
    $stmt->execute();
    header("Location: Medical.php");
}

// Example: medicineoperation.php
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM Medicines WHERE id=$id");
    header("Location: Medical.php");
    exit;
}


// Edit Medicine
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $shortcut = $_POST['shortcut'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE Medicines SET name=?, shortcut=?, price=?, quantity=?, description=? WHERE id=?");
    $stmt->bind_param("ssdssi", $name, $shortcut, $price, $quantity, $description, $id);
    $stmt->execute();
    header("Location: Medical.php");
}
?>
