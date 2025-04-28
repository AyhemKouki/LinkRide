@extends('layout')

@section('title', 'Welcome | LinkRide')

@section('content')
    <!-- Hero Section -->
    <div class="main-section text-center text-white d-flex align-items-center justify-content-center">
        <div class="overlay-text px-3">
            <h1 class="display-4 mb-3">You plan the day, we plan the way.</h1>
        </div>
    </div>

    <!-- First Feature (Image Left) -->
    <div class="container my-5 py-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/family_car.png') }}"
                     alt="Family carpooling together"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Smooth Ride Matching</h2>
                <p class="lead">
                    Connect with commuters going your way. Whether you need a ride or have extra seats,
                    LinkRide makes carpooling simple and efficient for everyone.
                </p>
            </div>
        </div>
    </div>

    <!-- Second Feature (Image Right - Flipped) -->
    <div class="container my-5 py-4  rounded">
        <div class="row align-items-center">
            <div class="col-md-6 order-md-2">
                <img src="{{ asset('images/confortAndSecurity.png') }}"
                     alt="Comfortable and secure ride"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6 order-md-1">
                <h2 class="fw-bold mb-3">Protection and Ease</h2>
                <p class="lead">
                    Travel with peace of mind. All our drivers are verified and rides are monitored
                    to ensure your safety and comfort throughout the journey.
                </p>
            </div>
        </div>
    </div>

    <!-- Third Feature (Image Left) -->
    <div class="container my-5 py-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/affordable_prices.png') }}"
                     alt="Affordable carpooling prices"
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Priced for Your Budget</h2>
                <p class="lead">
                    Save money on every trip. Split costs with fellow travelers and enjoy
                    transportation that's kinder to your wallet and the environment.
                </p>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .main-section {
            position: relative;
            height: 300px;
            background: url('{{ asset("images/car_trip_background.png") }}') no-repeat center center/cover;
        }

        .main-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .overlay-text {
            position: relative;
            z-index: 2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
    </style>
@endsection
