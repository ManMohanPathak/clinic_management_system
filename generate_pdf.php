<?php
require_once('tcpdf/tcpdf.php');
include 'dbconnect.php';

// Validate patient ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid or missing Patient ID.");
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM prescription WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$patient = $stmt->get_result()->fetch_assoc();

if (!$patient) {
    die("Patient not found.");
}

// Fallback and formatting
$customId = $patient['custom_id'] ?? strtoupper(uniqid('PID'));
$date = date("d-m-Y");

$patientName = htmlspecialchars($patient['patientname'] ?? 'N/A');
$mobile = htmlspecialchars($patient['mobileno'] ?? 'N/A');
$age = htmlspecialchars($patient['age'] ?? 'N/A');

$gender = "N/A";
if (isset($patient['Gender'])) {
    $gender = is_numeric($patient['Gender']) ? ($patient['Gender'] == 1 ? "Male" : "Female") : htmlspecialchars($patient['Gender']);
}

$prescription = nl2br(htmlspecialchars($patient['prescription'] ?? 'No prescription.'));
$address = htmlspecialchars($patient['address'] ?? "N/A");

// Clean up old files (optional housekeeping)
$files = glob(__DIR__ . '/pdfs/prescription_*.pdf');
$now = time();
foreach ($files as $file) {
    if (is_file($file) && $now - filemtime($file) > 604800) { // 7 days
        unlink($file);
    }
}

// Create PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('Pandey Clinic');
$pdf->SetAuthor('Dr. Pandey');
$pdf->SetTitle('Prescription');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(15, 15, 15);
$pdf->AddPage();

// Watermark
$pdf->SetAlpha(0.08);
$pdf->SetFont('helvetica', 'B', 55);
$pdf->StartTransform();
$pdf->Rotate(45, 105, 130);
$pdf->Text(30, 120, 'Pandey Clinic');
$pdf->StopTransform();
$pdf->SetAlpha(1);

// Barcode
$pdf->SetFont('helvetica', '', 10);
$pdf->write1DBarcode($customId, 'C128', 150, 10, '', 18, 0.4, [
    'position' => 'R',
    'border' => false,
    'padding' => 0,
    'fgcolor' => [0, 0, 0],
    'bgcolor' => false
], 'N');

// QR Code
$followUpURL = 'https://pandeyclinic.com/followup?id=' . urlencode($customId);
$style = [
    'border' => 0,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => [0, 0, 0],
    'bgcolor' => false
];
$pdf->write2DBarcode($followUpURL, 'QRCODE,H', 165, 260, 30, 30, $style, 'N');

// HTML & Styling
$html = <<<EOD
<style>
    .prescription-container {
        border: 2px solid #0d47a1;
        padding: 20px;
        border-radius: 12px;
        font-family: Helvetica, sans-serif;
        font-size: 12px;
        color: #212121;
    }
    .header {
        display: flex;
        align-items: center;
        border-bottom: 2px solid #0d47a1;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }
    .header img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-right: 15px;
    }
    .clinic-info h1 {
        margin: 0;
        font-size: 24px;
        color: #0d47a1;
    }
    .clinic-info p {
        margin: 2px 0;
        font-size: 11px;
        color: #555;
    }
    .box table {
        width: 100%;
        margin-top: 10px;
    }
    .box td {
        padding: 4px;
        font-size: 11px;
        vertical-align: top;
    }
    .rx-box {
        margin-top: 25px;
        padding: 18px;
        border: 2px dashed #0d47a1;
        min-height: 250px;
        position: relative;
        border-radius: 8px;
        background-color: #f9f9f9;
    }
    .rx-box::before {
        content: "℞";
        position: absolute;
        top: -25px;
        left: 12px;
        font-size: 32px;
        font-weight: bold;
        color: #0d47a1;
    }
    .rx-content {
        font-size: 12px;
        line-height: 1.4;
    }
    .signature {
        margin-top: 40px;
        text-align: right;
    }
    .signature .line {
        width: 200px;
        border-top: 1px solid #000;
        margin-left: auto;
        margin-bottom: 5px;
    }
    .footer {
        margin-top: 25px;
        text-align: center;
        font-size: 10px;
        color: #616161;
    }
</style>

<div class="prescription-container">
    <div class="header">
        <img src="logo2.jpg" onerror="this.style.display='none';" alt="Clinic Logo">
        <div class="clinic-info">
            <h1>Pandey Clinic</h1>
            <p>Street No.2, Sarpanch Colony Rd, near Sunrise School</p>
            <p>Jamalpur, Ludhiana, Punjab - 141010</p>
            <p><strong>Contact:</strong> 8052281445</p>
        </div>
    </div>

    <div class="box">
        <table>
            <tr>
                <td><strong>👤 Patient:</strong> $patientName</td>
                <td><strong>🆔 ID:</strong> $customId</td>
            </tr>
            <tr>
                <td><strong>🎂 Age:</strong> $age</td>
                <td><strong>⚥ Gender:</strong> $gender</td>
                <td><strong>📞 Mobile:</strong> $mobile</td>
            </tr>
            <tr>
                <td><strong>📅 Date:</strong> $date</td>
                <td><strong>👨‍⚕️ Doctor:</strong> Dr. Pandey</td>
                <td><strong>Specialist:</strong> General Physician</td>
            </tr>
            <tr>
                <td colspan="3"><strong>🏠 Address:</strong> $address</td>
            </tr>
        </table>
    </div>

    <div class="rx-box">
        <div class="rx-content">
            $prescription
        </div>
    </div>

    <div class="signature">
        <div class="line"></div>
        <p><strong>Dr. Pandey</strong></p>
    </div>

    <div class="footer">
        <p><strong>Clinic Timings:</strong> 9 AM – 1 PM | 5 PM – 9 PM</p>
        <p>This is a computer-generated prescription. For follow-up or emergency, visit the clinic directly.</p>
    </div>
</div>
EOD;

$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF
$pdfFile = 'prescription_' . $customId . '.pdf';
$pdfPath = __DIR__ . '/pdfs/' . $pdfFile;
$pdf->Output($pdfPath, 'F');

// Redirect to PDF
header("Location: pdfs/$pdfFile");
exit;
?>
