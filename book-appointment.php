<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        body {
            
            background-image: url('https://dmf.med.sa/wp-content/uploads/2021/03/Reserch-Centers.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 70px;
        }

        .modal-content {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .modal-footer button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .modal-footer button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .form-section {
            display: none;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin: 20px;
        }

        .container {
            max-width: 500px;
        }

        .alert {
            display: none; /* Initially hidden */
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <!-- Date Selection Modal -->
    <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateModalLabel">Select Appointment Date</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="date" id="appointmentDate" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="selectDateButton">Select Date</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Patient Information Form Section -->
    <div class="form-section" id="formSection">
        <div class="container">
            <h2>Patient Information</h2>
            <form id="patientForm" action="submit_appointment.php" method="POST">
                <div class="mb-3">
                    <label for="patientName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="patientName" name="patientName" required>
                </div>
                <div class="mb-3">
                    <label for="patientMobile" class="form-label">Mobile No</label>
                    <input type="tel" class="form-control" id="patientMobile" name="patientMobile" required pattern="[0-9]{10}">
                </div>
                <div class="mb-3">
                    <label for="patientEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="patientEmail" name="patientEmail">
                </div>
                <div class="mb-3">
                    <label for="patientAge" class="form-label">Age</label>
                    <input type="number" class="form-control" id="patientAge" name="patientAge" required>
                </div>
                <input type="hidden" id="hiddenAppointmentDate" name="appointmentDate">
                <button type="button" class="btn btn-primary" id="submitInfoButton">Submit</button>
            </form>
        </div>
    </div>

    <!-- Display Patient Information Section -->
    <div class="form-section" id="displayInfoSection">
        <div class="container">
            <h2>Appointment Details</h2>
            <p id="displayDate"></p>
            <p id="displayName"></p>
            <p id="displayMobile"></p>
            <p id="displayEmail"></p>
            <p id="displayAge"></p>
            <button type="button" class="btn btn-secondary" id="editInfoButton">Edit Info</button>
            <button type="button" class="btn btn-success" id="confirmSubmitButton">Submit to Database</button>
            <div class="alert alert-success" id="successAlert" role="alert">
                Appointment successfully booked!
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var dateModal = new bootstrap.Modal(document.getElementById('dateModal'));
            dateModal.show();
        });

        document.getElementById('selectDateButton').addEventListener('click', function () {
            const date = document.getElementById('appointmentDate').value;
            if (date) {
                document.getElementById('hiddenAppointmentDate').value = date;
                document.getElementById('formSection').style.display = 'block';
                document.getElementById('dateModal').querySelector('.btn-close').click();
            } else {
                alert('Please select a date.');
            }
        });

        document.getElementById('submitInfoButton').addEventListener('click', function () {
            const name = document.getElementById('patientName').value;
            const mobile = document.getElementById('patientMobile').value;
            const email = document.getElementById('patientEmail').value;
            const age = document.getElementById('patientAge').value;

            if (name && mobile && age) {
                document.getElementById('displayDate').textContent = 'Appointment Date: ' + document.getElementById('hiddenAppointmentDate').value;
                document.getElementById('displayName').textContent = 'Name: ' + name;
                document.getElementById('displayMobile').textContent = 'Mobile No: ' + mobile;
                document.getElementById('displayEmail').textContent = 'Email: ' + (email ? email : 'N/A');
                document.getElementById('displayAge').textContent = 'Age: ' + age;

                document.getElementById('formSection').style.display = 'none';
                document.getElementById('displayInfoSection').style.display = 'block';
            } else {
                alert('Please fill in the required fields.');
            }
        });

        document.getElementById('confirmSubmitButton').addEventListener('click', function () {
            // Submit the form to the server
            document.getElementById('patientForm').submit();
        });

        document.getElementById('editInfoButton').addEventListener('click', function () {
            // Go back to the form section for editing
            document.getElementById('displayInfoSection').style.display = 'none';
            document.getElementById('formSection').style.display = 'block';
        });


        
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            document.getElementById('successAlert').style.display = 'block';
        }
    }


    </script>
</body>

</html>
