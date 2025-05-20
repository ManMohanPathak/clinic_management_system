<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <style>
        body {
            background-image: url('https://pismoref.ru/wp-content/uploads/4/9/1/491ef8bf3ac83d03b09ddf887b96c132.jpg');
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 150px;
        }

        h1 {
            color: #343a40;
            margin-bottom: 20px;
        }

        .contact-info, .query-form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .query-form label {
            font-weight: bold;
            color: #0056b3;
        }

        .query-form input, .query-form textarea {
            margin-bottom: 15px;
        }

        .query-form button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .query-form button:hover {
            background-color: #0056b3;
        }

        .contact-info p {
            display: flex;
            align-items: center;
            color: #0056b3;
        }

        .contact-info p i {
            margin-right: 10px;
            color: #007bff;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #007bff;
        }

        .navbar-light .navbar-nav .nav-link.active {
            color: #0056b3;
        }

        .navbar-light .navbar-brand {
            color: #007bff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo1.PNG" alt="Logo" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="contactus.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="contact-info">
                    <h1>Say Hello</h1>
                    <p><i class="fas fa-map-marker-alt"></i> Address: Street No.2, Sarpanch Colony Rd, near Sanrise School 🏫, Jamalpur, Ludhiana, Punjab 141010</p>
                    <p><i class="fas fa-envelope"></i> Email: contact@drpandeyclinic.com</p>
                    <p><i class="fas fa-phone-alt"></i> Phone: +91 8052281445</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="query-form">
                    <h1>Ask your queries</h1>
                    <form novalidate>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" required aria-label="Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" aria-label="Email">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" rows="4" required aria-label="Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
