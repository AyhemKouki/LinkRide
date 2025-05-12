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

    <style>
        .star-rating {
            font-size: 1.2rem;
            letter-spacing: 2px;
        }
    </style>
@endsection
