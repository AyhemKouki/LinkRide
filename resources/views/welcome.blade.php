<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkRide</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic+Expanded+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href={{asset("bootstrap-5.3.5/dist/css/bootstrap.min.css")}} rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        body{
            font-family: 'Special Gothic Expanded One', sans-serif;
        }
        body > .main-section {
            flex: 0 0 auto;
        }
        .main-section {
            position: relative;
            height: 300px;
            background: url('{{ asset("images/car_trip_background.jpg") }}') no-repeat center center;
            background-size: cover;
        }
        .main-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4); /* dark overlay with 40% opacity */
            z-index: 1;
        }
        .overlay-text {
            position: relative;
            z-index: 2;
        }

        .navbar a, .navbar .nav-link, .navbar-brand {
            color: white !important;
        }
        .navbar .nav-link:hover {
            text-decoration: underline;
            color: #dff9fb !important;
        }

        .footer-social i {
            font-size: 1.8rem;
            margin-right: 1rem;
        }

    </style>

</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #0096c7;">
    <div class="container" >
        <a class="navbar-brand" href="#"><img src="{{asset("images/carpool_logo.png")}}" width="50" height="50" alt="logo"> LinkRide</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
                    </li>
                @endif
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="main-section text-center text-white d-flex align-items-center justify-content-center">
    <div class="overlay-text">
        <h1 class="display-4">You plan the day, we plan the way.</h1>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light text-lg-start mt-auto shadow-sm">
    <div class="container p-4">
        <div class="row">
            <!-- About -->
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">LinkRide</h5>
                <p>
                    Making your rides safer, easier, and more eco-friendly. Join our community of smart commuters today.
                </p>
            </div>

            <!-- Social -->
            <div class="col-lg-5 col-md-12 mb-4 mb-md-0 footer-social ">
                <h5 class="text-uppercase">Follow Us</h5>
                <a href="#" class="text-dark"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="text-dark"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="text-dark"><i class="fa-brands fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3 text-white" style="background-color: #0096c7;">
        © {{ date('Y') }} LinkRide. All rights reserved.
    </div>
</footer>

<script src="{{ asset("bootstrap-5.3.5/dist/js/bootstrap.bundle.js") }}"></script>
</body>
</html>
