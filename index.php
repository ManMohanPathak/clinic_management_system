<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dr. Pandey Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        body {
            padding-top: 70px; /* Space for fixed navbar */
            background-color: #f8f9fa;
        }

        .bg-image {
            background-image: url('back2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .bg-image h1 {
            font-size: 4rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            color: #ffffff;
        }

        .bg-image h3 {
            font-size: 2rem;
            margin-top: 20px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
            color: #ffcccb;
        }

        .bg-image p {
            font-size: 1.2rem;
            margin-top: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
            color: #f1f1f1;
        }

        .bg-image .btn {
            margin-top: 30px;
            font-size: 1.2rem;
            padding: 10px 20px;
            color: white;
            background-color: #ff6347;
            border: none;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .bg-image .btn:hover {
            background-color: #ff4500;
            transform: scale(1.05);
        }

        .about-section,
        .services-section {
            padding: 60px 20px;
            background: linear-gradient(135deg, #ff6347, #ffcccb);
            text-align: center;
            border-radius: 15px;
            margin: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }

        .about-section h2,
        .services-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .about-section p,
        .services-section p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto;
            margin-bottom: 40px;
            color: #f8f9fa;
        }

        .services-section .service-item {
            margin-bottom: 20px;
        }

        .about-section .carousel-item img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .footer .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .footer img {
            max-height: 50px;
        }

        .footer .footer-info {
            flex: 1;
            padding: 10px;
        }

        .footer .footer-info p {
            margin: 5px 0;
        }

        .footer .footer-map {
            flex: 1;
            padding: 10px;
        }

        .footer .footer-map iframe {
            width: 100%;
            height: 200px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo2.jpg" alt="Logo" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="loginform.php">login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="bg-image" id="Home">
        <div class="container">
            <h1>Welcome to Dr. Pandey Clinic</h1>
            <h3>Your health is our priority</h3>
            <p>At Dr. Pandey's Clinic, we are dedicated to providing the highest quality medical care. Our team of
                experienced professionals is here to ensure your health and well-being.</p>
            <a href="book-appointment.php" class="btn btn-primary">Book Appointment</a>
        </div>
    </div>

    <!-- About Section -->
    <div class="about-section" id="about">
        <div class="container">
            <h2>About Dr. Pandey Clinic</h2>
            <p>Dr. Pandey Clinic has been serving the community with exceptional medical services for over 20 years. Our clinic is equipped with state-of-the-art facilities and a team of experienced healthcare professionals dedicated to your well-being.</p>

            <!-- Bootstrap Carousel -->
            <div id="aboutCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="IMG-20240714-WA0023.jpg" class="d-block w-100" alt="Clinic Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="IMG-20240714-WA0028.jpg" class="d-block w-100" alt="Clinic Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="IMG-20240714-WA0020.jpg" class="d-block w-100" alt="Clinic Image 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="services-section" id="services">
        <div class="container">
            <h2>Our Services</h2>
            <p>We provide a wide range of medical services to cater to your health needs. Our services include:</p>
            <div class="row">
                <div class="col-md-4 service-item">
                    <h3>OPD</h3>
                    <p>Our outpatient department is equipped to handle all types of medical consultations and treatments.</p>
                </div>
                <div class="col-md-4 service-item">
                    <h3>IPD</h3>
                    <p>We offer comprehensive inpatient services to ensure you receive the best care during your stay.</p>
                </div>
                <div class="col-md-4 service-item">
                    <h3>Blood Test</h3>
                    <p>Our clinic provides a variety of blood tests with quick and accurate results.</p>
                </div>
                <div class="col-md-4 service-item">
                    <h3>Medical</h3>
                    <p>We have a well-stocked medical store to provide you with necessary medications and supplies.</p>
                </div>
                <div class="col-md-4 service-item">
                    <h3>Fitness Certificate</h3>
                    <p>We issue fitness certificates for various needs, including employment and sports.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-info">
                <img src="logo1.PNG" alt="Logo">
                <p><i class="fas fa-map-marker-alt"></i> Street No.2, Sarpanch Colony Rd, near Sanrise School 🏫, Jamalpur, Ludhiana, Punjab 141010</p>
                <p><i class="fas fa-envelope"></i> contact@drpandeyclinic.com</p>
                <p><i class="fas fa-phone"></i> +91 8052281445</p>
            </div>
            <div class="footer-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3423.3377130233494!2d75.91606197584673!3d30.90518317450153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a9da897e4c81d%3A0xb70262072d4ad04e!2z4KSh4KWJIOCkquCkvuCkguCkoeClhyDgpJXgpY3gpLLgpYDgpKjgpL_gpJU!5e0!3m2!1shi!2sin!4v1721357005096!5m2!1shi!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </footer>

    <!-- Font Awesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
