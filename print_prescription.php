<?php
include 'dbconnect.php';

if (!isset($_GET['id'])) {
    die("Patient ID missing");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM prescription WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$patient = $stmt->get_result()->fetch_assoc();

if (!$patient) {
    die("Patient not found.");
}

$customId = $patient['custom_id'] ?? strtoupper(uniqid('PID'));
$date = date("d-m-Y");
$patientName = htmlspecialchars($patient['patientname']);
$mobile = htmlspecialchars($patient['mobileno']);
$age = htmlspecialchars($patient['age']);
$gender = $patient['Gender'] ? "Male" : "Female";
$prescription = nl2br(htmlspecialchars($patient['prescription']));
$address = htmlspecialchars($patient['address'] ?? "N/A");
$checkup = nl2br(htmlspecialchars($patient['checkup_summary'] ?? 'N/A'));
$followUpURL = 'https://pandeyclinic.com/followup?id=' . $customId;

$med_stmt = $conn->prepare("SELECT medicine_name, morning, afternoon, night, instructions FROM prescription_details WHERE prescription_id = ?");
$med_stmt->bind_param("i", $id);
$med_stmt->execute();
$medicines = $med_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prescription - Pandey Clinic</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
        }

        body {
            font-family: "Helvetica Neue", Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
            font-size: 12pt;
            color: #000;
        }

        .container {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            border: 1px solid #000;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .header img {
            width: 70px;
            height: 70px;
            margin-right: 15px;
            border-radius: 50%;
        }

        .clinic-info h1 {
            margin: 0;
            font-size: 20pt;
            color: #0d47a1;
        }

        .clinic-info p {
            margin: 2px 0;
            font-size: 10pt;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 11pt;
        }

        .details td {
            padding: 5px 8px;
            vertical-align: top;
        }

        .section {
            margin-top: 15px;
        }

        .section h3 {
            margin: 10px 0 5px;
            font-size: 12pt;
        }

        .box {
            border: 1px solid #ccc;
            padding: 10px;
            min-height: 50px;
            font-size: 11pt;
            line-height: 1.4;
        }

        .med-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .med-table th, .med-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            font-size: 10.5pt;
        }

        .med-table th {
            background-color: #f2f2f2;
        }

        .rx-box {
            border: 2px dashed #000;
            padding: 15px;
            position: relative;
            margin-top: 15px;
            min-height: 200px;
            border-radius: 8px;
        }

        .rx-box::before {
            content: "℞";
            font-size: 26pt;
            font-weight: bold;
            position: absolute;
            top: -20px;
            left: 10px;
            color: #000;
        }

        .barcode {
            margin-top: 20px;
            text-align: right;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .signature .line {
            width: 180px;
            border-top: 1px solid #000;
            margin-left: auto;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10pt;
            color: #444;
        }

        .footer img {
            margin-top: 10px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="header">
            <img src="logo2.jpg" alt="Clinic Logo">
            <div class="clinic-info">
                <h1>Pandey Clinic</h1>
                <p>Street No.2, Sarpanch Colony Rd, near Sunrise School</p>
                <p>Jamalpur, Ludhiana, Punjab - 141010</p>
                <p><strong>Contact:</strong> 8052281445</p>
            </div>
        </div>

        <div class="details">
            <table>
                <tr>
                    <td><strong>Patient:</strong> <?= $patientName ?></td>
                    <td><strong>ID:</strong> <?= $customId ?></td>
                </tr>
                <tr>
                    <td><strong>Age:</strong> <?= $age ?></td>
                    <td><strong>Gender:</strong> <?= $gender ?></td>
                    <td><strong>Mobile:</strong> <?= $mobile ?></td>
                </tr>
                <tr>
                    <td><strong>Date:</strong> <?= $date ?></td>
                    <td><strong>Doctor:</strong> Dr. Pandey</td>
                    <td><strong>Specialist:</strong> General Physician</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Address:</strong> <?= $address ?></td>
                </tr>
            </table>
        </div>

        <div class="rx-box">
            <div class="section">
                <h3>🩺 Check-up Summary</h3>
                <div class="box"><?= $checkup ?></div>
            </div>

            <div class="section">
                <h3>💊 Prescription Details</h3>
                <table class="med-table">
                    <thead>
                        <tr>
                            <th>Medicine</th>
                            <th>Instructions</th>
                            <th>Morning</th>
                            <th>Afternoon</th>
                            <th>Night</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $medicines->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['medicine_name']) ?></td>
                                <td><?= htmlspecialchars($row['instructions']) ?></td>
                                <td><?= $row['morning'] ? '✔️' : '' ?></td>
                                <td><?= $row['afternoon'] ? '✔️' : '' ?></td>
                                <td><?= $row['night'] ? '✔️' : '' ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="barcode">
            <img src="https://barcode.tec-it.com/barcode.ashx?data=<?= $customId ?>&code=Code128&dpi=96" alt="Barcode" height="50">
        </div>

        <div class="signature">
            <div class="line"></div>
            <p><strong>Dr. Pandey</strong></p>
        </div>

        <div class="footer">
            <p><strong>Clinic Timings:</strong> 9 AM – 1 PM | 5 PM – 9 PM</p>
            <p>This is a computer-generated prescription. For follow-up or emergency, visit the clinic directly.</p>
            <img src="https://chart.googleapis.com/chart?cht=qr&chs=100x100&chl=<?= urlencode($followUpURL) ?>" alt="QR Code">
        </div>
    </div>
</body>
</html>
