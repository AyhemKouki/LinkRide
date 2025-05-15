@extends('layout.layout')

@section('title', 'Search Rides')

@section('ride_search')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Search Card -->
                <div class="card border-0 shadow-lg mb-5 rounded-4">
                    <div class="card-header bg-gradient bg-primary text-white rounded-top-4">
                        <h4 class="mb-0 fw-semibold"><i class="fas fa-search me-2"></i>Search for a Ride</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('ride.search') }}" method="GET">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="origin" class="form-label fw-medium">From</label>
                                    <input type="text" class="form-control rounded-3" id="origin" name="origin"
                                           placeholder="Departure location" value="{{ request('origin') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="destination" class="form-label fw-medium">To</label>
                                    <input type="text" class="form-control rounded-3" id="destination" name="destination"
                                           placeholder="Destination" value="{{ request('destination') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="date" class="form-label fw-medium">Date</label>
                                    <input type="date" class="form-control rounded-3" id="date" name="date"
                                           value="{{ request('date') }}" min="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="seats" class="form-label fw-medium">Seats Needed</label>
                                    <input type="number" class="form-control rounded-3" id="seats" name="seats"
                                           value="{{ request('seats', 1) }}" min="1" max="10">
                                </div>
                                <div class="col-md-4">
                                    <label for="max_price" class="form-label fw-medium">Max Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">$</span>
                                        <input type="number" class="form-control rounded-end-3" id="max_price"
                                               name="max_price" value="{{ request('max_price') }}" min="0" step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('ride.search') }}" class="btn btn-light border px-4">
                                    <i class="fas fa-undo me-1"></i>Reset
                                </a>
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                    <i class="fas fa-search me-1"></i>Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Results Section -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-bottom-0 rounded-top-4">
                        <h4 class="fw-semibold mb-0"><i class="fas fa-car-side me-2 text-primary"></i>Available Rides</h4>
                    </div>
                    <div class="card-body p-4">
                        @if($rides->count() > 0)
                            <div class="vstack gap-4">
                                @foreach($rides as $ride)
                                    <div class="border rounded-4 p-4 shadow-sm bg-light">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="fw-bold text-dark mb-0">
                                                <i class="fas fa-map-marker-alt text-primary"></i> {{ $ride->origin }}
                                                <i class="fas fa-arrow-right text-muted mx-2"></i>
                                                <i class="fas fa-map-marker-alt text-primary"></i> {{ $ride->destination }}
                                            </h5>
                                            <span class="badge bg-success fs-6 px-3 py-2">${{ number_format($ride->price_per_seat, 2) }}</span>
                                        </div>

                                        <div class="d-flex justify-content-between text-muted mb-2">
                                            <div>
                                                <i class="far fa-calendar-alt me-1"></i>
                                                {{ $ride->departure_time->format('D, M j, Y') }} -
                                                {{ $ride->departure_time->format('g:i A') }}
                                            </div>
                                            <div>
                                                <i class="fas fa-users me-1"></i>
                                                <span class="badge bg-info text-dark px-3">{{ $ride->available_seats }} seat{{ $ride->available_seats > 1 ? 's' : '' }}</span>
                                            </div>
                                        </div>

                                        @if($ride->notes)
                                            <p class="text-muted small mb-2">
                                                <i class="fas fa-info-circle me-1"></i>
                                                {{ Str::limit($ride->notes, 100) }}
                                            </p>
                                        @endif

                                        <div class="text-end">
                                            <a href="{{ route('ride.show', $ride->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
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
                            <div class="text-center py-5">
                                <i class="fas fa-info-circle fa-2x text-primary mb-3"></i>
                                <h5 class="fw-semibold">No rides found</h5>
                                <p class="text-muted">Try changing the search criteria or check back later.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
