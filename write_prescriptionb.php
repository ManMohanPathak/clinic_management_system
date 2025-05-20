<?php
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $medicine_names = $_POST['medicine_name'];
    $instructions = $_POST['instructions'];
    $morning = $_POST['morning'] ?? [];
    $afternoon = $_POST['afternoon'] ?? [];
    $night = $_POST['night'] ?? [];
    $date = date("Y-m-d");

    $prescriptionText = "";

    // Step 1: Generate summary text
    foreach ($medicine_names as $i => $med) {
        $med = trim($medicine_names[$i]);
        $ins = trim($instructions[$i]);

        $prescriptionText .= "Medicine: $med\n";
        $prescriptionText .= "Instructions: $ins\n\n";
    }

    // Step 2: Update summary table
    $stmt = $conn->prepare("UPDATE prescription SET prescription = ?, date = ?, last_visited = NOW(), visited_by_doctor = 'yes' WHERE id = ?");
    $stmt->bind_param("ssi", $prescriptionText, $date, $id);
    $stmt->execute();

    // Step 3: Clear old entries
    $del = $conn->prepare("DELETE FROM prescription_details WHERE prescription_id = ?");
    $del->bind_param("i", $id);
    $del->execute();

    // Step 4: Save detailed entries
    foreach ($medicine_names as $i => $med) {
        $med = $conn->real_escape_string(trim($med));
        $ins = $conn->real_escape_string(trim($instructions[$i]));

        // Directly access 0/1 values from checkbox arrays
        $mor = isset($morning[$i]) && $morning[$i] == 1 ? 1 : 0;
        $aft = isset($afternoon[$i]) && $afternoon[$i] == 1 ? 1 : 0;
        $nig = isset($night[$i]) && $night[$i] == 1 ? 1 : 0;

        $stmt = $conn->prepare("INSERT INTO prescription_details (prescription_id, medicine_name, morning, afternoon, night, instructions, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isiiiss", $id, $med, $mor, $aft, $nig, $ins, $date);
        $stmt->execute();
    }

    header("Location: write_prescription.php?id=$id&msg=Prescription saved successfully.");
    exit;
} else {
    echo "Invalid request.";
}
?>
