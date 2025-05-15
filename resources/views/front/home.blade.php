@extends("layout.layout")

@section("home_content")
    <div class="container py-5">
        <!-- Top Destinations Section -->
        <div class="container mb-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Popular Routes</h2>
                <p class="text-muted">Explore frequently traveled routes across the country</p>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card shadow-sm h-100 hover-effect">
                        <img src="{{asset('images/sousse.jpg')}}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Sousse">
                        <div class="card-body text-center">
                            <h5 class="card-title">Tunis → Sousse</h5>
                            <p class="text-muted mb-1">From 12 $</p>
                            <small class="text-success">5 rides available</small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm h-100 hover-effect">
                        <img src="{{asset('images/monastir.jpg')}}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Monastir">
                        <div class="card-body text-center">
                            <h5 class="card-title">Sfax → Monastir</h5>
                            <p class="text-muted mb-1">From 10 $</p>
                            <small class="text-success">3 rides available</small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm h-100 hover-effect">
                        <img src="{{asset('images/tunis.jpg')}}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="tunis">
                        <div class="card-body text-center">
                            <h5 class="card-title">Nabeul → Tunis</h5>
                            <p class="text-muted mb-1">From 8 $</p>
                            <small class="text-success">7 rides available</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action Section -->
        <div class="container text-center py-5">
            <div class="bg-primary text-white p-5 rounded shadow-sm">
                <h2 class="fw-bold mb-3">Ready to Hit the Road?</h2>
                <p class="lead mb-4">Join thousands of travelers sharing rides every day.</p>
                <a href="{{ route('ride.search') }}" class="btn btn-outline-light btn-lg">Browse Rides</a>

            </div>
        </div>

        <!-- Testimonials Carousel -->
        <div class="container mb-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">What Our Passengers Say</h2>
                <p class="text-muted">Real feedback from our awesome community</p>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold"><i class="fas fa-comments text-primary me-2"></i>Recent Reviews</h2>
            </div>

            @if($ratings->isNotEmpty())
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($ratings->take(6)->chunk(2) as $chunkIndex => $chunk)
                            <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                                <div class="row justify-content-center">
                                    @foreach($chunk as $rating)
                                        <div class="col-md-6">
                                            <div class="card shadow-sm mx-2 mb-4">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start mb-3">
                                                        @if($rating->user->profile_image)
                                                            <img src="{{ asset('storage/' . $rating->user->profile_image) }}"
                                                                 class="rounded-circle me-3"
                                                                 width="50" height="50"
                                                                 alt="{{ $rating->user->name }}">
                                                        @else
                                                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3"
                                                                 style="width: 50px; height: 50px;">
                                                                <i class="fas fa-user text-white"></i>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <h6 class="mb-0">{{ $rating->user->name }}</h6>
                                                            <div class="star-rating small">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                                                @endfor
                                                                <small class="text-muted ms-2">{{ $rating->created_at->diffForHumans() }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="text-muted">
                                                        {{ $rating->comment ?? 'No comment provided.' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            @else
                <div class="text-center text-muted">
                    <p>No testimonials available yet.</p>
                </div>
            @endif
        </div>


        <!-- Top Drivers Section -->
        <div class="mb-5">
            <h2 class="fw-bold mb-4"><i class="fas fa-trophy text-warning me-2"></i>Top Rated Drivers</h2>

            @if($drivers->count() <= 0)
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-user-slash text-muted mb-3" style="font-size: 3rem;"></i>
                        <h4 class="text-muted">No driver ratings yet</h4>
                    </div>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($drivers as $driver)
                        <div class="col">
                            <div class="card h-100 shadow-sm hover-effect">
                                <div class="card-body text-center pt-4 pb-2">
                                    <!-- Driver Photo -->
                                    <div class="position-relative mb-3 mx-auto" style="width: 120px;">
                                        @if($driver->profile_image)
                                            <img src="{{ asset('storage/' . $driver->profile_image) }}"
                                                 class="rounded-circle border border-3 border-primary"
                                                 width="120"
                                                 height="120"
                                                 alt="{{ $driver->name }}">
                                        @else
                                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                                                 style="width: 120px; height: 120px;">
                                                <i class="fas fa-user text-white" style="font-size: 3rem;"></i>
                                            </div>
                                        @endif

                                        @if($loop->iteration <= 3)
                                            <div class="position-absolute top-0 start-100 translate-middle">
                                                <span class="badge rounded-pill bg-warning text-dark fs-6">
                                                    #{{ $loop->iteration }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Driver Name -->
                                    <h5 class="card-title mb-1">{{ $driver->name }}</h5>

                                    <!-- Rating -->
                                    <div class="star-rating mb-2">
                                        @php
                                            $avgRating = round($driver->avg_rating, 1);
                                        @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $avgRating ? 'text-warning' : 'text-secondary' }}"></i>
                                        @endfor
                                        <span class="ms-2 fw-bold">{{ $avgRating }}</span>
                                        <small class="text-muted">({{ $driver->ratings_count }} reviews)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <style>
        .star-rating {
            letter-spacing: 2px;
        }
        .star-rating.small {
            font-size: 0.9rem;
        }
        .hover-effect {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
        }
        .driver-info {
            transition: background-color 0.3s ease;
        }
        .driver-info:hover {
            background-color: #f0f0f0 !important;
        }
        .badge.bg-warning {
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
    </style>
@endsection
