<?php
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

$searchId = '';
$sortBy = 'Id';
$query = "SELECT * FROM onlineappointment";

// Handle search and sorting
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $conditions = [];
    
    if (!empty($_GET['searchId'])) {
        $searchId = $_GET['searchId'];
        $conditions[] = "id='$searchId'";
    }
    
    if (!empty($_GET['sortBy'])) {
        $sortBy = $_GET['sortBy'];
    }

    // Build query with conditions
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(' AND ', $conditions);
    }

    // Add order by clause
    $query .= " ORDER BY $sortBy";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Info</title>
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

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        input[type="text"] {
            flex: 1 1 60%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            min-width: 150px;
        }

        select, button {
            flex: 1 1 20%;
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            min-width: 100px;
        }

        button:hover {
            background-color: #0056b3;
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

        @media (max-width: 768px) {
            form {
                flex-direction: column;
                align-items: stretch;
            }

            input[type="text"], select, button {
                flex: 1 1 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Appointment Info</h1>

        <form method="GET">
            <input type="text" name="searchId" placeholder="Enter ID to search" value="<?php echo htmlspecialchars($searchId); ?>">
            <select name="sortBy">
                <option value="id" <?php echo $sortBy == 'Id' ? 'selected' : ''; ?>>Sort by ID</option>
                <option value="date" <?php echo $sortBy == 'Date' ? 'selected' : ''; ?>>Sort by Date</option>
                <option value="name" <?php echo $sortBy == 'Name' ? 'selected' : ''; ?>>Sort by Name (A-Z)</option>
            </select>
            <button type="submit">Search</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Mobile No</th>
                    <th>Email</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Age']; ?></td>
                            <td><?php echo $row['MobileNo']; ?></td>
                            <td><?php echo $row['Email']; ?></td>
                            <td><?php echo $row['Date']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No results found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
