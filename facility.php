<?php
session_start();
$servername = "localhost"; // Change if different
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "drpandey";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add facility
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $mobileno = $_POST['mobileno'];
    $emailid = $_POST['emailid'];
    $password = $_POST['password'];

    $sql = "INSERT INTO logininfo (name, mobileno, emailid, password) VALUES ('$name', '$mobileno', '$emailid', '$password')";
    $conn->query($sql);
}

// Edit facility
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $mobileno = $_POST['mobileno'];
    $emailid = $_POST['emailid'];
    $password = $_POST['password'];

    $sql = "UPDATE logininfo SET name='$name', mobileno='$mobileno', emailid='$emailid', password='$password' WHERE id=$id";
    $conn->query($sql);
}

// Delete facility
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM logininfo WHERE id=$id";
    $conn->query($sql);
}

// Fetch facilities
$sql = "SELECT * FROM logininfo";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Facilities</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 90%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            overflow-x: auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            flex: 1 1 calc(25% - 10px);
            min-width: 150px;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .edit-btn, .delete-btn {
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
            margin: 2px;
        }

        .edit-btn {
            background-color: #28a745;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        @media (max-width: 768px) {
            form {
                flex-direction: column;
                align-items: stretch;
            }

            input[type="text"], input[type="email"], input[type="password"] {
                flex: 1 1 100%;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Facilities</h1>

        <form method="POST">
            <input type="hidden" name="id" id="editId">
            <input type="text" name="name" id="name" placeholder="Name" required>
            <input type="text" name="mobileno" id="mobileno" placeholder="Mobile No" required>
            <input type="email" name="emailid" id="emailid" placeholder="Email ID" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <button type="submit" name="add" id="addBtn">Add Facility</button>
            <button type="submit" name="edit" id="editBtn" style="display:none;">Update Facility</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile No</th>
                    <th>Email ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['mobileno']; ?></td>
                        <td><?php echo $row['emailid']; ?></td>
                        <td>
                            <a href="javascript:void(0);" class="edit-btn" onclick="editFacility(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>', '<?php echo $row['mobileno']; ?>', '<?php echo $row['emailid']; ?>', '<?php echo $row['password']; ?>')">Edit</a>
                            <a href="?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this facility?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editFacility(id, name, mobileno, emailid, password) {
            document.getElementById('editId').value = id;
            document.getElementById('name').value = name;
            document.getElementById('mobileno').value = mobileno;
            document.getElementById('emailid').value = emailid;
            document.getElementById('password').value = password;
            document.getElementById('addBtn').style.display = 'none';
            document.getElementById('editBtn').style.display = 'inline-block';
        }
    </script>
</body>
</html>
