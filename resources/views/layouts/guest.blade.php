<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/carpool_logo.png') }}" type="image/png">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #0096c7 0%, #00b4d8 50%, #48cae4 100%) fixed;
            min-height: 100vh;
        }

        /* Modern card styling */
        .auth-card {
            width: 100%;
            max-width: 420px;
            border-radius: 16px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: white;
            border-bottom: none;
            padding: 2rem 2rem 0;
        }

        .card-body {
            padding: 2rem;
        }

        /* Logo styling */
        .logo-container {
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-img {
            width: 80px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .logo-img:hover {
            transform: scale(1.1) rotate(-5deg);
        }

        /* Form styling */
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0096c7;
            box-shadow: 0 0 0 0.25rem rgba(0, 150, 199, 0.25);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #495057;
        }

        /* Button styling */
        .btn-primary {
            background-color: #0096c7;
            border-color: #0096c7;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: #0077a8;
            border-color: #0077a8;
            transform: translateY(-2px);
        }

        .btn-outline-light {
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            transform: translateY(-2px);
        }

        /* Profile page styling */
        .profile-card {
            background-color: white;
            border-radius: 16px;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .profile-header {
            background: linear-gradient(135deg, #0096c7 0%, #00b4d8 50%, #48cae4 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .page-header {
            font-size: 1.75rem;
            font-weight: 600;
            color: white;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        /* Centered profile layout */
        .profile-logo-container {
            display: flex;
            justify-content: center;
            width: 100%;
            padding: 2rem 0 1rem;
        }

        /* Gradient text */
        .text-gradient {
            background: linear-gradient(135deg, #0096c7 0%, #00b4d8 50%, #48cae4 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Add these new styles */
        .auth-container {
            display: flex;
            width: 100%;
            max-width: 900px; /* Increased from 420px to accommodate image */
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: white;
        }

        .auth-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .auth-image {
            flex: 1;
            background-image: url('{{ asset("images/auth-image.png") }}');
            background-size: cover;
            background-position: center;
            display: none; /* Hidden on mobile */
        }

        .auth-form {
            flex: 1;
            padding: 2rem;
            min-height: 500px; /* Set a minimum height */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Show image on larger screens */
        @media (min-width: 768px) {
            .auth-image {
                display: block;
            }
        }

        /* Adjust the logo container for the new layout */
        .auth-logo-container {
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Keep your existing styles, but update the auth-card styles */
        .auth-card {
            width: 100%;
            border-radius: 0;
            border: none;
            box-shadow: none;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
@if(isset($slot) && !isset($header))
    <!-- Authentication card layout -->
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
        <div class="logo-container animate-fade-in">
            <a href="{{ url()->previous() }}" class="text-decoration-none">
                <img src="{{ asset('images/carpool_logo.png') }}"
                     alt="LinkRide Logo"
                     class="logo-img">
            </a>
        </div>

        <div class="auth-container animate-fade-in" style="animation-delay: 0.2s">
            <!-- Image Section -->
            <div class="auth-image"></div>

            <!-- Form Section -->
            <div class="auth-form">
                <div class="auth-card">
                    <div class="card-body p-4 p-md-5">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <!-- Profile page layout -->
    <div class="flex-grow-1">
        <div class="container py-4">
            <div class="profile-logo-container animate-fade-in">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <img src="{{ asset('images/carpool_logo.png') }}"
                         alt="LinkRide Logo"
                         class="logo-img">
                </a>
            </div>

            @if(isset($header))
                <header class="text-center mb-4 mb-md-5 animate-fade-in" style="animation-delay: 0.2s">
                    <h1 class="page-header">
                        {{ $header }}
                    </h1>
                </header>
            @endif

            <div class="row justify-content-center animate-fade-in" style="animation-delay: 0.3s">
                <div class="col-lg-10 col-xl-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation to form inputs
        const inputs = document.querySelectorAll('.form-control, .form-select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#0096c7';
                this.style.boxShadow = '0 0 0 0.25rem rgba(0, 150, 199, 0.25)';
            });

            input.addEventListener('blur', function() {
                this.style.borderColor = '#e0e0e0';
                this.style.boxShadow = 'none';
            });
        });

        // Add hover effects to cards
        const cards = document.querySelectorAll('.auth-card, .profile-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 15px 35px rgba(0, 0, 0, 0.2)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.15)';
            });
        });
    });
</script>
</body>
</html>
