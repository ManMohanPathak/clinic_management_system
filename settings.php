<?php
session_start();

$message = "";
$isSaved = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['prescription_mode'])) {
        $_SESSION['prescription_mode'] = $_POST['prescription_mode'];
        $message = "Settings updated successfully.";
        $isSaved = true;
    }
}

// Get current mode
$selected_mode = $_SESSION['prescription_mode'] ?? 'print_prescription.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2C3E50;
            color: #ECF0F1;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            max-width: 500px;
            margin: auto;
            margin-top: 50px;
            background: #34495E;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.4);
        }
        .form-control, .form-select {
            background-color: #2C3E50;
            color: #ECF0F1;
            border: 1px solid #7F8C8D;
        }
        .form-control:focus, .form-select:focus {
            background-color: #1C2833;
            color: #fff;
        }
        .btn-custom {
            background: #1ABC9C;
            border: none;
        }
        .btn-custom:hover {
            background: #16A085;
        }
        .preview-box {
            background: #1C2833;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
            font-size: 14px;
        }
        .toggle-switch {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center mb-4">🛠️ Prescription Settings</h3>

        <?php if (!empty($message)): ?>
            <div class="alert <?= $isSaved ? 'alert-success' : 'alert-danger' ?>"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="prescription_mode" class="form-label">Select Prescription Generator</label>
                <select name="prescription_mode" id="prescription_mode" class="form-select" onchange="showPreview(this.value)">
                    <option value="print_prescription.php" <?= $selected_mode === 'print_prescription.php' ? 'selected' : '' ?>>Print Format (print_prescription.php)</option>
                    <option value="generate_pdf.php" <?= $selected_mode === 'generate_pdf.php' ? 'selected' : '' ?>>PDF Format (generate_pdf.php)</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Optional Notes</label>
                <textarea name="notes" id="notes" rows="2" class="form-control" placeholder="Any special settings, themes, or format notes..."></textarea>
            </div>

            <div class="toggle-switch">
                <label for="darkmode">Dark Mode</label>
                <input type="checkbox" id="darkmode" onclick="toggleTheme()" checked>
            </div>

            <div class="preview-box" id="previewBox">
                Current mode: <strong><?= htmlspecialchars($selected_mode) ?></strong>
            </div>

            <button type="submit" class="btn btn-custom w-100 mt-3">💾 Save Settings</button>
        </form>
    </div>

    <script>
        function showPreview(value) {
            const box = document.getElementById('previewBox');
            box.innerHTML = `Current mode: <strong>${value}</strong>`;
        }

        function toggleTheme() {
            document.body.classList.toggle('bg-light');
            document.body.classList.toggle('text-dark');
        }
    </script>
</body>
</html>
