@extends('layout')

@section('title', 'Welcome | LinkRide')

@section('welcome-content')
    <!-- Hero Section -->
    <div class="main-section text-center text-white d-flex align-items-center justify-content-center flex-column">
        <div class="overlay-text px-4 text-shadow">
            <h1 class="display-4 mb-4">You plan the day, we plan the way.</h1>
            <p class="lead mb-4">Join the community of carpoolers and travel smarter, safer, and more affordable.</p>
            <a href="{{route('login')}}" class="btn btn-primary btn-lg">Get Started</a>
        </div>
    </div>

    <!-- About & Benefits -->
    <section class="py-5 bg-light" id="about">
        <div class="container text-center mb-5">
            <h2 class="fw-bold mb-3">Why Choose LinkRide?</h2>
            <p class="lead mx-auto max-w-600">
                Simplify your commuting. Connect with reliable drivers or passengers, save money, and reduce your carbon footprint. Our platform ensures safe, secure, and cost-effective rides for everyone.
            </p>
        </div>
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Seamless Matching</h4>
                        <p class="card-text">Find compatible ride partners quickly and easily. Save time and hassle.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Safety First</h4>
                        <p class="card-text">Verified drivers, monitored rides, and secure payments for peace of mind.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Eco-Friendly & Affordable</h4>
                        <p class="card-text">Share rides, save costs, and help protect the environment.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Sections -->
    <!-- Increased spacing, icons, and animation for a modern look -->
    <div class="container my-5" id="features">
        <!-- Feature 1: Ride Matching -->
        <div class="row align-items-center mb-5">
            <div class="col-md-6 order-md-1">
                <img src="{{ asset('images/family_car.png') }}" alt="Family carpooling" class="img-fluid rounded shadow hover-scale">
            </div>
            <div class="col-md-6 order-md-2">
                <h3 class="mb-3 fw-bold">Smooth Ride Matching</h3>
                <p class="lead">
                    Connect with fellow commuters heading your way. Whether you need a ride or have seats to spare, LinkRide makes it easy to arrange comfortable, reliable rides.
                </p>
            </div>
        </div>

        <!-- Feature 2: Security & Comfort -->
        <div class="row align-items-center mb-5 bg-white p-4 rounded shadow-sm">
            <div class="col-md-6 order-md-2">
                <img src="{{ asset('images/confortAndSecurity.png') }}" alt="Secure ride" class="img-fluid rounded shadow hover-scale">
            </div>
            <div class="col-md-6 order-md-1">
                <h3 class="mb-3 fw-bold">Protection and Ease</h3>
                <p class="lead">
                    Travel with confidence. All drivers are verified, and rides are monitored for your safety and comfort throughout every trip.
                </p>
            </div>
        </div>

        <!-- Feature 3: Cost Savings -->
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="{{ asset('images/affordable_prices.png') }}" alt="Affordable rides" class="img-fluid rounded shadow hover-scale">
            </div>
            <div class="col-md-6">
                <h3 class="mb-3 fw-bold">Affordable Prices</h3>
                <p class="lead">
                    Save money by sharing costs. Split fares with fellow travelers and enjoy budget-friendly, eco-conscious transportation.
                </p>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <section class="py-5 bg-light" id="testimonials">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">What Our Users Say</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded p-4">
                        <p class="fs-5 mb-3">"LinkRide made my daily commute easier and cheaper. Reliable and safe!"</p>
                        <h5 class="mb-0">– Jane D.</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded p-4">
                        <p class="fs-5 mb-3">"Loved the community and feel secure knowing all drivers are verified."</p>
                        <h5 class="mb-0">– Mark T.</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded p-4">
                        <p class="fs-5 mb-3">"Affordable, eco-friendly, and friendly — exactly what I needed."</p>
                        <h5 class="mb-0">– Lisa S.</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5" id="faq">
        <div class="container">
            <h2 class="fw-bold mb-4 text-center">Frequently Asked Questions</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            How do I sign up?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="faqOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Register easily with your email. Our platform guides you through the simple onboarding process.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Is my ride safe?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes. All users are verified, and rides are monitored for safety and security. You can also leave reviews after each trip.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            How much does it cost?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="faqThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Costs are split fairly among ride participants. You pay only your share, making it affordable for everyone.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        .main-section {
            height: 400px;
            background: url('{{ asset("images/car_trip_background.png") }}') no-repeat center center/cover;
            position: relative;
        }

        .main-section::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .overlay-text {
            position: relative;
            z-index: 2;
            padding: 1rem;
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        /* Hover effect on images */
        .hover-scale:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        /* Max width for text content */
        .max-w-600 {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
@endsection
