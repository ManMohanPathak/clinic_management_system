<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1E1E2F, #2C2C54);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #E3B23C;
        }

        .container {
            width: 90%;
            max-width: 900px;
            padding: 30px;
            background: linear-gradient(135deg, #2C2C54, #474787);
            color: #FFD700;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            border-radius: 12px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .welcome-banner {
            background: rgba(255, 215, 0, 0.2);
            padding: 15px;
            border-radius: 12px;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: slideDown 1s ease-in-out;
        }

        @keyframes slideDown {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        h1 {
            font-size: 28px;
            margin-bottom: 15px;
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        button {
            padding: 12px 24px;
            font-size: 16px;
            cursor: pointer;
            background: rgba(255, 215, 0, 0.3);
            color: #FFD700;
            border: 2px solid #FFD700;
            border-radius: 8px;
            transition: background 0.3s, transform 0.2s;
            font-weight: bold;
            animation: bounceIn 1s ease-in-out;
        }

        @keyframes bounceIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        button:hover {
            background: rgba(255, 215, 0, 0.5);
            transform: translateY(-5px);
        }

        .logout {
            margin-top: 30px;
        }

        .logout a {
            font-size: 18px;
            color: #FFD700;
            background: #8B0000;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s;
        }

        .logout a:hover {
            background: #640000;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-banner">
            👋 Welcome, <?php echo htmlspecialchars($user); ?>!
        </div>
        <h1>Dashboard</h1>
        <p>You are successfully logged in!</p>
        
        <div class="button-container">
            <button onclick="window.location.href='facility.php'">🏥 Add Facility</button>
            <button onclick="window.location.href='prescription.php'">📝 Print Prescription</button>
            <button onclick="window.location.href='appointmentinfo.php'">📅 Appointment Info</button>
            <button onclick="window.location.href='prescriptioninfo.php'">💊 Prescription Info</button>
            <button onclick="window.location.href='manage_patient.php'">👨‍⚕️ Patient Info</button>
            <button onclick="window.location.href='Medical.php'">💉 Medicines</button>
            <button onclick="window.location.href='settings.php'">⚙️</button>
        </div>
        
        <div class="logout">
            <p><a href="logout.php">🚪 Logout</a></p>
        </div>
    </div>
</body>
</html>