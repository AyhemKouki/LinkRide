@extends("layout.layout")

@section("home_content")
    <div class="container py-4">
        <h2 class="mb-4">User Ratings</h2>

        @if($ratings->isEmpty())
            <div class="alert alert-info">No ratings yet.</div>
        @else
            <div class="row">
                @foreach($ratings as $rating)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                        @endfor
                                    </div>
                                    <small class="text-muted">{{ $rating->created_at->diffForHumans() }}</small>
                                </div>

                                @if($rating->comment)
                                    <p class="mt-2">{{ $rating->comment }}</p>
                                @endif

                                <div class="text-muted small">
                                    @if($rating->reservation && $rating->reservation->ride)
                                        <div>Ride: {{ $rating->reservation->ride->origin }} → {{ $rating->reservation->ride->destination }}</div>
                                    @endif

                                    @if($rating->driver)
                                        <div>Driver: {{ $rating->driver->name }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                {{ $ratings->links() }}
            </div>
        @endif
    </div>

    <div class="container py-4">
        <h2 class="mb-4">Best Drivers</h2>
        @if($drivers->count() <= 0)
            <div class="alert alert-info">No ratings yet.</div>
        @else
            <div class="row">
                @foreach($drivers as $driver)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <!-- Driver Photo -->
                                <div class="mb-3">
                                    @if($driver->profile_image)
                                        <img src="{{ asset('storage/' . $driver->profile_image) }}"
                                             class="rounded-circle"
                                             width="100"
                                             height="100"
                                             alt="{{ $driver->name }}">
                                    @else
                                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                                             style="width: 100px; height: 100px; margin: 0 auto;">
                                            <i class="fas fa-user text-white" style="font-size: 2.5rem;"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Driver Name -->
                                <h5 class="card-title">{{ $driver->name }}</h5>

                                <!-- Rating -->
                                <div class="star-rating mb-2">
                                    @php
                                        $avgRating = round($driver->avg_rating, 1);
                                    @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $avgRating ? 'text-warning' : 'text-secondary' }}"></i>
                                    @endfor
                                    <span class="ms-2">{{ $avgRating }}/5</span>
                                </div>


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        .star-rating {
            font-size: 1.2rem;
            letter-spacing: 2px;
        }
        .card {
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .driver-info {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
@endsection
