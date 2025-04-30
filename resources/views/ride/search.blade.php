@extends('layout.layout')

@section('title', 'Search Rides')
@section('ride_search')

    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- Search Form -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-search me-2"></i>Find Your Ride</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ride.search') }}" method="GET">
                            <div class="row g-3">
                                <!-- Origin -->
                                <div class="col-md-6">
                                    <label for="origin" class="form-label">From</label>
                                    <input type="text" class="form-control" id="origin" name="origin"
                                           value="{{ request('origin') }}" placeholder="Starting point">
                                </div>

                                <!-- Destination -->
                                <div class="col-md-6">
                                    <label for="destination" class="form-label">To</label>
                                    <input type="text" class="form-control" id="destination" name="destination"
                                           value="{{ request('destination') }}" placeholder="Destination">
                                </div>

                                <!-- Date -->
                                <div class="col-md-6">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                           value="{{ request('date') }}" min="{{ date('Y-m-d') }}">
                                </div>

                                <!-- Seats -->
                                <div class="col-md-3">
                                    <label for="seats" class="form-label">Seats Needed</label>
                                    <input type="number" class="form-control" id="seats" name="seats"
                                           value="{{ request('seats', 1) }}" min="1" max="10">
                                </div>

                                <!-- Max Price -->
                                <div class="col-md-3">
                                    <label for="max_price" class="form-label">Max Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="max_price" name="max_price"
                                               value="{{ request('max_price') }}" min="0" step="0.01">
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="col-12 d-flex justify-content-between mt-3">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-search me-2"></i>Search
                                    </button>
                                    <a href="{{ route('ride.search') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-undo me-2"></i>Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Search Results -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><i class="fas fa-list me-2"></i>Available Rides</h4>
                    </div>
                    <div class="card-body">
                        @if($rides->count() > 0)
                            <div class="list-group">
                                @foreach($rides as $ride)
                                    <div class="list-group-item list-group-item-action mb-3 rounded-3">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-2 text-primary">
                                                <i class="fas fa-map-marker-alt"></i> {{ $ride->origin }}
                                                <i class="fas fa-arrow-right mx-2"></i>
                                                <i class="fas fa-map-marker-alt"></i> {{ $ride->destination }}
                                            </h5>
                                            <span class="badge bg-success fs-6">
                                            ${{ number_format($ride->price_per_seat, 2) }}
                                        </span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <i class="far fa-calendar-alt me-1"></i>
                                                <strong>{{ $ride->departure_time->format('D, M j, Y') }}</strong>
                                                at {{ $ride->departure_time->format('g:i A') }}
                                            </div>
                                            <span class="badge bg-info">
                                            <i class="fas fa-users me-1"></i>
                                            {{ $ride->available_seats }} available
                                        </span>
                                        </div>

                                        @if($ride->notes)
                                            <p class="mb-2"><i class="fas fa-info-circle me-1"></i> {{ Str::limit($ride->notes, 100) }}</p>
                                        @endif

                                        <div class="d-flex justify-content-between align-items-center mt-3">

                                            <a href="{{ route('ride.show', $ride->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i> View Details
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $rides->appends(request()->query())->links() }}
                            </div>
                        @else
                            <div class="alert alert-info text-center">
                                <i class="fas fa-info-circle fa-2x mb-3"></i>
                                <h4>No rides found matching your criteria</h4>
                                <p class="mb-0">Try adjusting your search filters or check back later</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
