<?php
include 'dbconnect.php';

// Initialize
$search = "";
$searchQuery = "";
$editMode = false;
$medicine = [
    'id' => '',
    'name' => '',
    'shortcut' => '',
    'price' => '',
    'quantity' => '',
    'description' => ''
];

// Handle search
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $searchQuery = " WHERE name LIKE '%$search%' OR shortcut LIKE '%$search%'";
}

// Handle edit
if (isset($_GET['edit'])) {
    $editId = intval($_GET['edit']);
    $result = $conn->query("SELECT * FROM Medicines WHERE id = $editId");
    if ($result && $result->num_rows > 0) {
        $medicine = $result->fetch_assoc();
        $editMode = true;
    } else {
        echo "<div class='alert alert-danger mt-3'>Medicine not found!</div>";
    }
}

// Get all medicines
$result = $conn->query("SELECT * FROM Medicines $searchQuery ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medicine Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #searchResults {
            position: absolute;
            width: 100%;
            background: white;
            border: 1px solid #ccc;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
        }
        #searchResults .list-group-item {
            cursor: pointer;
        }
        #searchResults .list-group-item:hover {
            background: #f8f9fa;
        }
    </style>
</head>
<body class="container mt-4">

    <h2 class="text-center">Medicine Shop</h2>

    <!-- 🔎 Search -->
    <div class="position-relative">
        <input type="text" id="searchBox" class="form-control" placeholder="Search Medicine by Name or Shortcut">
        <div id="searchResults" class="list-group"></div>
    </div>

    <!-- 📝 Form -->
    <form method="POST" action="medicineoperation.php" class="mb-3 mt-3">
        <input type="hidden" name="id" value="<?= htmlspecialchars($medicine['id']) ?>">

        <div class="mb-2">
            <label>Medicine Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($medicine['name']) ?>" required class="form-control">
        </div>

        <div class="mb-2">
            <label>Shortcut</label>
            <input type="text" name="shortcut" value="<?= htmlspecialchars($medicine['shortcut']) ?>" required class="form-control">
        </div>

        <div class="mb-2">
            <label>Price</label>
            <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($medicine['price']) ?>" required class="form-control">
        </div>

        <div class="mb-2">
            <label>Quantity</label>
            <input type="number" name="quantity" value="<?= htmlspecialchars($medicine['quantity']) ?>" required class="form-control">
        </div>

        <div class="mb-2">
            <label>Description</label>
            <textarea name="description" class="form-control"><?= htmlspecialchars($medicine['description']) ?></textarea>
        </div>

        <button type="submit" name="<?= $editMode ? 'edit' : 'add' ?>" class="btn btn-primary">
            <?= $editMode ? 'Update Medicine' : 'Add Medicine' ?>
        </button>

        <?php if ($editMode): ?>
            <a href="Medical.php" class="btn btn-secondary">Cancel</a>
        <?php endif; ?>
    </form>

    <!-- 📋 Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Shortcut</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="medicineTable">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['shortcut']) ?></td>
                        <td>₹<?= htmlspecialchars($row['price']) ?></td>
                        <td><?= htmlspecialchars($row['quantity']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td>
                            <a href="Medical.php?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="medicineoperation.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this medicine?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center text-danger">No medicines found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- 🔍 Auto Suggest JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchBox = document.getElementById('searchBox');
            const resultsDiv = document.getElementById('searchResults');
            let debounceTimer;

            searchBox.addEventListener('keyup', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    const query = searchBox.value.trim();
                    if (query === "") {
                        resultsDiv.innerHTML = "";
                        return;
                    }

                    fetch('search_medicine.php?query=' + encodeURIComponent(query))
                        .then(response => response.json())
                        .then(data => {
                            let output = '';
                            if (data.length > 0) {
                                data.forEach(med => {
                                    output += `<a href="#" class="list-group-item list-group-item-action" onclick="selectMedicine('${med.name}')">
                                        <strong>${med.name} (${med.shortcut})</strong> - ₹${med.price}, ${med.quantity} pcs
                                    </a>`;
                                });
                            } else {
                                output = '<div class="list-group-item text-danger">No results found</div>';
                            }
                            resultsDiv.innerHTML = output;
                        });
                }, 300);
            });
        });

        function selectMedicine(name) {
            document.getElementById('searchBox').value = name;
            document.getElementById('searchResults').innerHTML = '';
        }
    </script>

</body>
</html>
