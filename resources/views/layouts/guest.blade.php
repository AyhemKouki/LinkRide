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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #0096c7 0%, #00b4d8 50%, #48cae4 100%) fixed;
        }
        /* Square form styling */
        .square-card {
            width: 400px;
            height: 400px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        /* Profile page styling */
        .profile-card {
            background-color: #00b4d8;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .logo-container {
            margin-bottom: 30px;
            text-align: center;
            width: 100%; /* Ensure it takes full width */
            display: flex; /* Use flexbox */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically if needed */
        }
        .logo-img {
            width: 80px;
            height: auto;
            transition: transform 0.3s ease;
        }
        .logo-img:hover {
            transform: scale(1.1);
        }
        .page-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        .form-content {
            padding: 30px;
            width: 100%;
        }
        .btn-primary {
            background-color: #0096c7;
            border-color: #0096c7;
            width: 100%;
            padding: 10px;
            border-radius: 6px;
        }
        .btn-primary:hover {
            background-color: #0077a8;
            border-color: #0077a8;
        }
        .form-control {
            border-radius: 6px;
            padding: 10px 15px;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            border-color: #0096c7;
            box-shadow: 0 0 0 0.2rem rgba(0, 150, 199, 0.25);
        }
        /* Header styling */
        .page-header {
            font-size: 1.5rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 1.5rem;
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .square-card {
                width: 100%;
                height: auto;
                min-height: 400px;
            }
            .profile-card {
                padding: 1rem;
            }
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased m-0 p-0 gradient-bg">
@if(isset($slot) && !isset($header))
    <!-- Square form layout -->
    <div class="page-center">
        <div class="logo-container">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/carpool_logo.png') }}"
                     alt="LinkRide Logo"
                     class="logo-img">
            </a>
        </div>

        <div class="square-card">
            <div class="form-content">
                {{ $slot }}
            </div>
        </div>
    </div>
@else
    <!-- Profile page layout -->
    <div class="min-h-screen">
        <div class="logo-container pt-6">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/carpool_logo.png') }}"
                     alt="LinkRide Logo"
                     class="logo-img">
            </a>
        </div>

        @if(isset($header))
            <header class="flex justify-center"> <!-- Added flex and justify-center -->
                <h2 class="page-header text-center"> <!-- Ensured text-center -->
                    {{ $header }}
                </h2>
            </header>
        @endif

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                {{ $slot }}
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation to form inputs
        const inputs = document.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#0096c7';
                this.style.boxShadow = '0 0 0 0.2rem rgba(0, 150, 199, 0.25)';
            });
            input.addEventListener('blur', function() {
                this.style.borderColor = '#ddd';
                this.style.boxShadow = 'none';
            });
        });
    });
</script>
</body>
</html>
