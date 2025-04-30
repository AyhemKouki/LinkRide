<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LinkRide - Carpooling made easy. Plan your rides with our community of commuters.">
    <title>@yield('title', 'LinkRide')</title>

    <!-- Fonts and Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic+Expanded+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('bootstrap-5.3.5/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        :root {
            --hover-blue: #0077b6;
        }

        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        body {
            font-family: 'Special Gothic Expanded One', sans-serif;
            line-height: 1.6;
        }

        /* Navbar Styles */
        .navbar {
            background-color:  #0096c7 !important;
        }

        .navbar a, .navbar .nav-link, .navbar-brand {
            color: white !important;
            transition: all 0.3s ease;
        }

        .navbar .dropdown-menu .dropdown-item {
            color: #212529 !important; /* Bootstrap's default dark color */
        }
        .navbar .dropdown-menu .dropdown-item:hover {
            color: #fff !important; /* White text on hover */
            background-color: #0096c7;
        }

        .navbar .nav-link:hover {
            color: #dff9fb !important;
            transform: translateY(-2px);
        }

        /* Footer Styles */
        footer {
            background-color: #f8f9fa !important;
        }

        .footer-social i {
            font-size: 1.8rem;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .footer-social a:hover i {
            transform: scale(1.2);
            color:  #0096c7 !important;
        }
    </style>

</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/carpool_logo.png') }}" width="50" height="50" alt="LinkRide Logo">
            LinkRide
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Main Navigation Links -->
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-car-side me-1"></i> Find Rides</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('ride.index')}}"><i class="fas fa-road me-1"></i> Offer Ride</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-info-circle me-1"></i> About</a>
                </li>

                <!-- Authentication Links -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-cog me-1"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-car me-1"></i> My Rides</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-1"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<main class="flex-grow-1">
    @yield('styles')
    @yield('ride_content')
    @yield('ride_create')
</main>

<!-- Footer -->
<footer class="bg-light text-lg-start shadow-sm mt-auto">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">LinkRide</h5>
                <p>
                    Making your rides safer, easier, and more eco-friendly.
                </p>
            </div>
            <div class="col-lg-5 col-md-12 mb-4 mb-md-0 footer-social">
                <h5 class="text-uppercase">Follow Us</h5>
                <a href="#" class="text-dark"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="text-dark"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="text-dark"><i class="fa-brands fa-linkedin"></i></a>
            </div>
        </div>
    </div>
    <div class="text-center p-3 text-white" style="background-color:  #0096c7;">
        © {{ date('Y') }} LinkRide. All rights reserved.
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="{{ asset('bootstrap-5.3.5/dist/js/bootstrap.bundle.min.js') }}"></script>
@stack('scripts') <!-- For page-specific JS -->
</body>
</html>
