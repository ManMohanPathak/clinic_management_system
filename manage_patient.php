<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Patients</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-center flex-grow-1">Manage Patients</h2>
        <a href="dashboard.php" style='color:red;' class="btn btn-outline-danger ms-2">
            <i class="fa-solid fa-rectangle-xmark me-1" ></i> Back
        </a>

    </div>

    <!-- Patients Table -->
    <div class="card p-3">
        <div class="d-flex justify-content-between mb-2">
            <h4>Patient Records</h4>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPatientModal">+ Add Patient</button>
        </div>
        <input type="text" id="searchBox" class="form-control mb-2" placeholder="Search by Name or Mobile">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style='text-align: center;'>
                <thead class="table-primary">
                     <tr>
                        <th>Custom ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Mobile</th>
                        <th>Visited</th>
                        <th>Last Visited</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="patientTable">
                    <!-- Records will be loaded dynamically -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Patient Modal -->
    <div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addPatientForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Patient</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="patientname" class="form-control mb-2" placeholder="Name" required>
                        <input type="number" name="age" class="form-control mb-2" placeholder="Age" required>
                        <select name="Gender" class="form-control mb-2" required>
                            <option value="">Select Gender</option>
                            <option value="1">Male</option>
                            <option value="0">Female</option>
                        </select>
                        <input type="text" name="mobileno" class="form-control mb-2" placeholder="Mobile" required pattern="\d{10}">
                        <textarea name="address" class="form-control mb-2" placeholder="Address (optional)"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Patient</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            function loadPatients(query = '') {
                $.ajax({
                    url: 'manage_patientb.php',
                    method: 'GET',
                    data: { search: query },
                    success: function (data) {
                        $('#patientTable').html(data);
                    }
                });
            }

            // Initial load
            loadPatients();

            // Live reload every 2 seconds
            setInterval(function () {
                if ($('#searchBox').val().trim() === '') {
                    loadPatients();
                }
            }, 2000);

            // Search functionality
            $('#searchBox').on('keyup', function () {
                let query = $(this).val();
                loadPatients(query);
            });

            // Handle Add Patient Form Submit
            $('#addPatientForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'add_patient.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#addPatientForm')[0].reset();
                        $('#addPatientModal').modal('hide');
                        loadPatients();
                        alert('Patient added successfully!');
                    }
                });
            });

            // Button actions
            $(document).on('click', '.write-prescription', function () {
                let id = $(this).data('id');
                window.location.href = `write_prescription.php?id=${id}`;
            });

            $(document).on('click', '.upload-report', function () {
                let id = $(this).data('id');
                window.location.href = `upload_report.php?id=${id}`;
            });

            $(document).on('click', '.manage-fee', function () {
                let id = $(this).data('id');
                window.location.href = `manage_fee.php?id=${id}`;
            });
        });
    </script>
</body>
</html>
