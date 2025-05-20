<?php
include 'dbconnect.php';
session_start();

if (!isset($_GET['id'])) {
    die("Patient ID not provided.");
}

$id = intval($_GET['id']);

// Fetch patient data
$stmt = $conn->prepare("SELECT * FROM prescription WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$patient = $stmt->get_result()->fetch_assoc();

if (!$patient) {
    die("Patient not found.");
}

$prescription_file = isset($_SESSION['prescription_mode']) ? $_SESSION['prescription_mode'] : 'print_prescription.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Write Prescription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <script>
        let medicineIndex = 1;

        function addMedicineRow() {
            const container = document.getElementById('medicine-list');

            const row = document.createElement('div');
            row.classList.add('medicine-entry', 'border', 'p-2', 'mb-2');

            row.innerHTML = `
                <div class="mb-2">
                    <label>Medicine Name</label>
                    <input type="text" name="medicine_name[]" class="form-control" required placeholder="e.g. Paracetamol 500mg">
                </div>
                <div class="mb-2">
                    <label>Dosage</label><br>

                    <input type="hidden" name="morning[${medicineIndex}]" value="0">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="morning[${medicineIndex}]" value="1">
                        <label class="form-check-label">Morning</label>
                    </div>

                    <input type="hidden" name="afternoon[${medicineIndex}]" value="0">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="afternoon[${medicineIndex}]" value="1">
                        <label class="form-check-label">Afternoon</label>
                    </div>

                    <input type="hidden" name="night[${medicineIndex}]" value="0">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="night[${medicineIndex}]" value="1">
                        <label class="form-check-label">Night</label>
                    </div>
                </div>
                <div class="mb-2">
                    <label>Instructions</label>
                    <textarea name="instructions[]" class="form-control" required placeholder="e.g. After food, for 5 days"></textarea>
                </div>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeMedicineRow(this)">Remove</button>
            `;

            container.appendChild(row);
            medicineIndex++;
        }

        function removeMedicineRow(button) {
            button.closest('.medicine-entry').remove();
        }
    </script>
</head>
<body class="container mt-4">
    <h2 class="mb-4">Write Prescription for <?= htmlspecialchars($patient['patientname']) ?></h2>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-info"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

    <div class="card p-3 mb-3">
        <h5>Patient Details</h5>
        <p><strong>Name:</strong> <?= htmlspecialchars($patient['patientname']) ?></p>
        <p><strong>Age:</strong> <?= htmlspecialchars($patient['age']) ?></p>
        <p><strong>Gender:</strong> 
            <?= ($patient['Gender'] === 'Male') ? 'Male' : (($patient['Gender'] === 'Female') ? 'Female' : 'Other') ?>
        </p>
        <p><strong>Mobile:</strong> <?= htmlspecialchars($patient['mobileno']) ?></p>
    </div>

    <div class="card p-3">
        <form method="POST" action="write_prescriptionb.php">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div id="medicine-list">
                <!-- First medicine row -->
                <div class="medicine-entry border p-2 mb-2">
                    <div class="mb-2">
                        <label>Medicine Name</label>
                        <input type="text" name="medicine_name[]" class="form-control" required placeholder="e.g. Amoxicillin 250mg">
                    </div>
                    <div class="mb-2">
                        <label>Dosage</label><br>

                        <input type="hidden" name="morning[0]" value="0">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="morning[0]" value="1">
                            <label class="form-check-label">Morning</label>
                        </div>

                        <input type="hidden" name="afternoon[0]" value="0">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="afternoon[0]" value="1">
                            <label class="form-check-label">Afternoon</label>
                        </div>

                        <input type="hidden" name="night[0]" value="0">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="night[0]" value="1">
                            <label class="form-check-label">Night</label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label>Instructions</label>
                        <textarea name="instructions[]" class="form-control" required placeholder="e.g. Before bed for 3 days"></textarea>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-outline-primary mb-3" onclick="addMedicineRow()">+ Add More</button><br>
            <button type="submit" class="btn btn-success">Save Prescription</button>
            <a href="<?= $prescription_file ?>?id=<?= $id ?>" class="btn btn-primary">Generate PDF</a>
            <a href="manage_patient.php" class="btn btn-secondary">Back</a>
        </form>
    </div>

    <?php if (!empty($patient['prescription'])): ?>
        <div class="card p-3 mt-4">
            <h5>Previous Prescription</h5>
            <pre><?= htmlspecialchars($patient['prescription']) ?></pre>
        </div>
    <?php endif; ?>
</body>
</html>
