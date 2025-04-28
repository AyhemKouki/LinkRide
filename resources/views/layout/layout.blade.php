<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'LinkRide')</title>
    <link href="{{ asset('bootstrap-5.3.5/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic+Expanded+One&display=swap" rel="stylesheet">
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
        .navbar a, .navbar , .navbar-brand {
            color: white !important;
        }
        .navbar  {
            color: #dff9fb !important;
        }
        .nav-link:hover{
            text-decoration: underline;
        }
        .footer-social i {
            font-size: 1.8rem;
            margin-right: 1rem;
        }
        .logout-link {
            text-decoration: none;
        }
        .logout-link:hover {
            text-decoration: underline;
            color: #ffffff;
        }

    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #0096c7;">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/carpool_logo.png') }}" width="50" height="50" alt="logo"> LinkRide
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav me-3">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Find a Ride</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Offer a Ride</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">My Rides</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route("profile.edit")}}">Profile</a>
                </li>
            </ul>
            <form action="{{ route('logout') }}" method="post" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link text-white p-0 logout-link">Logout</button>
            </form>
        </div>
    </div>
</nav>



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


<script src="{{ asset('bootstrap-5.3.5/dist/js/bootstrap.bundle.js') }}"></script>
</body>
</html>
