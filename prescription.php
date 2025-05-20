<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f0f2f5;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        .radio-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        #reviewContainer {
            display: none;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        #reviewContent {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Prescription Form</h2>
        <form id="prescriptionForm">
            <div class="form-group">
                <label for="patientName">Patient Name:</label>
                <input type="text" id="patientName" required>
            </div>
            <div class="form-group">
                <label for="mobileNumber">Mobile Number:</label>
                <input type="text" id="mobileNumber" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" value="Ludhiana, Punjab, India" required>
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <div class="radio-group">
                    <input type="radio" id="male" name="gender" value="1" required>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="0">
                    <label for="female">Female</label>
                </div>
            </div>
            <button type="button" onclick="showReview()">Generate Prescription</button>
        </form>
    </div>

    <div id="reviewContainer">
        <div id="reviewContent"></div>
        <button type="button" onclick="submitPrescription()">Save and Print</button>
    </div>

    <script>
        function showReview() {
            const patientName = document.getElementById('patientName').value;
            const mobileNumber = document.getElementById('mobileNumber').value;
            const age = document.getElementById('age').value;
            const address = document.getElementById('address').value;
            const gender = document.querySelector('input[name="gender"]:checked').value;
            const genderText = gender === '1' ? 'Male' : 'Female';

            const reviewContent = `
                <h3>Review Prescription</h3>
                <p><strong>Patient Name:</strong> ${patientName}</p>
                <p><strong>Mobile Number:</strong> ${mobileNumber}</p>
                <p><strong>Age:</strong> ${age}</p>
                <p><strong>Address:</strong> ${address}</p>
                <p><strong>Gender:</strong> ${genderText}</p>
            `;

            document.getElementById('reviewContent').innerHTML = reviewContent;
            document.getElementById('reviewContainer').style.display = 'block';
        }

        function submitPrescription() {
            const patientName = document.getElementById('patientName').value;
            const mobileNumber = document.getElementById('mobileNumber').value;
            const age = document.getElementById('age').value;
            const address = document.getElementById('address').value;
            const gender = document.querySelector('input[name="gender"]:checked').value;

            // Send data to the server
            fetch('submit_prescription.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    patientName,
                    mobileNumber,
                    age,
                    address,
                    gender
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Prescription saved successfully!');
                    printPrescription(patientName, mobileNumber, age, address, gender);
                } else {
                    alert('Failed to save prescription.');
                }
            });
        }

        function submitPrescription() {
    const patientName = document.getElementById('patientName').value;
    const mobileNumber = document.getElementById('mobileNumber').value;
    const age = document.getElementById('age').value;
    const address = document.getElementById('address').value;
    const gender = document.querySelector('input[name="gender"]:checked').value;

    // Send data to the server
    fetch('submit_prescription.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            patientName,
            mobileNumber,
            age,
            address,
            gender
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Prescription saved successfully!');
            printPrescription(data.customId, patientName, mobileNumber, age, address, gender);
        } else {
            alert('Failed to save prescription.');
        }
    });
}

function printPrescription(customId, patientName, mobileNumber, age, address, gender) {
    const genderText = gender === '1' ? 'Male' : 'Female';
    const date = new Date().toLocaleDateString();

    let printContent = `
        <div style="border: 2px solid #007bff; border-radius: 8px; padding: 20px; margin: 10px;">
            <div style="text-align: center;">
                <img src="logo2.jpg" alt="Clinic Logo" style="max-width: 100px; height: auto;   border-radius: 50%; margin-left:-550px;">
                <h1 style="margin-top:-25px;">Pandey Clinic</h1>
                <p>Mobile: 8052281445
                <br>
                Street No.2, Sarpanch Colony Rd, near Sanrise School, Jamalpur, Ludhiana, Punjab 141010</p>
            </div>
            <hr>
            <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                <div style="width: 45%;">
                    <p><strong>ID:</strong> ${customId}</p>
                    <p><strong>Patient Name:</strong> ${patientName}</p>
                    <p><strong>Mobile Number:</strong> ${mobileNumber}</p>
                    <p><strong>Age:</strong> ${age}</p>
                    <p><strong>Gender:</strong> ${genderText}</p>
                </div>
                <div style="width: 45%; text-align: right;">
                    <p><strong>Address:</strong> ${address}</p>
                    <p><strong>Doctor:</strong> Dr. Pandey</p>
                    <p><strong>Date:</strong> ${date}</p>
                </div>
            </div>
            <div style="margin-top: -12px; height: 640px; border: 2px solid #007bff; border-radius: 8px;">
                <h5 style="margin: 10px;">Prescription Details</h5>
            </div>
        </div>
    `;

    let newWindow = window.open("", "", "width=800,height=600");
    newWindow.document.write(printContent);
    newWindow.document.close();
    newWindow.print();
}

    </script>
</body>

</html>
