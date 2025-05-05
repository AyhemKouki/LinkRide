@extends('layout.layout')

@section('title', 'Ride Details')

@section('ride_show')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- Ride Details Card -->
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">
                                <i class="fas fa-car me-2"></i>Ride Details
                            </h3>
                            <span class="badge bg-light text-primary fs-5">
                                ${{ number_format($ride->price_per_seat, 2) }} per seat
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Route Information -->
                        <div class="ride-route mb-4 p-3 bg-light rounded">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h4 class="mb-0 text-primary">
                                    <i class="fas fa-route me-2"></i>Route
                                </h4>
                                <span class="badge bg-info fs-6">
                                    <i class="fas fa-users me-1"></i>
                                    {{ $ride->available_seats }} seats available
                                </span>
                            </div>

                            <div class="route-details">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="circle-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 24px; height: 24px;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <strong>From:</strong> {{ $ride->origin }}
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-2">
                                    <div class="circle-icon bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 24px; height: 24px;">
                                        <i class="fas fa-flag-checkered"></i>
                                    </div>
                                    <div>
                                        <strong>To:</strong> {{ $ride->destination }}
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="circle-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 24px; height: 24px;">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <strong>Departure:</strong>
                                        {{ $ride->departure_time->format('l, F j, Y') }} at {{ $ride->departure_time->format('g:i A') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Driver Information -->
                        <div class="driver-info mb-4 p-3 bg-light rounded">
                            <h4 class="mb-3 text-primary">
                                <i class="fas fa-user me-2"></i>Driver Information
                            </h4>

                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    @if($ride->driver->profile_image)
                                        <img src="{{ asset('storage/'.$ride->driver->profile_image) }}"
                                             alt="Driver"
                                             class="rounded-circle"
                                             width="80"
                                             height="80">
                                    @else
                                        <img src="{{ asset('images/default-profile.jpg') }}"
                                             alt="Driver"
                                             class="rounded-circle"
                                             width="80"
                                             height="80">
                                    @endif

                                </div>
                                <div>
                                    <h5 class="mb-1">{{ $ride->driver->name }}</h5>

                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <img src="{{ asset('storage/'.$ride->image) }}"
                                     alt="Car"
                                     class="rounded-circle"
                                     width="80"
                                     height="80">
                                <div class="ms-3">
                                    <h5 class="mb-1">car photo</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        @if($ride->notes)
                            <div class="notes mb-4 p-3 bg-light rounded">
                                <h4 class="mb-3 text-primary">
                                    <i class="fas fa-info-circle me-2"></i>Additional Notes
                                </h4>
                                <p class="mb-0">{{ $ride->notes }}</p>
                            </div>
                        @endif

                        <!-- Map Preview -->
                        <div class="map mb-4 p-3 bg-light rounded">
                            <h4 class="mb-3 text-primary">
                                <i class="fas fa-map-marked-alt me-2"></i>Route Map
                            </h4>
                            <!-- Google Maps Card -->
                            <div class="map-card mb-4 p-3 bg-light rounded">
                                <iframe
                                    width="100%"
                                    height="400"
                                    src="https://maps.google.com/maps?q={{ $ride->origin }} to {{ $ride->destination }}&output=embed"
                                    frameborder="0"
                                    scrolling="no">
                                </iframe>
                                <p class="mt-2 small text-muted">View larger map:
                                    <a href="https://www.google.com/maps/dir/?api=1&origin={{ urlencode($ride->origin) }}&destination={{ urlencode($ride->destination) }}" target="_blank">
                                        Open in Google Maps
                                    </a>
                                </p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('ride.search') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Search
                            </a>

                            @if(auth()->check() && auth()->user()->id !== $ride->driver_id )
                                @if($ride->available_seats > 0 )
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookRideModal">
                                        <i class="fas fa-ticket-alt me-2"></i>Book This Ride
                                    </button>
                                @else
                                    <button type="button" class="btn btn-danger" disabled>
                                        <i class="fas fa-times-circle me-2"></i>No Seats Available
                                    </button>

                                @endif

                            @endif

                            @if(auth()->check() && auth()->user()->id === $ride->driver_id)
                                <div class="btn-group">
                                    <a href="{{ route('ride.edit', $ride->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit me-2"></i>Edit Ride
                                    </a>
                                    <form action="{{ route('ride.destroy', $ride->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ride?')">
                                            <i class="fas fa-trash me-2"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Book Ride Modal -->
    <div class="modal fade" id="bookRideModal" tabindex="-1" aria-labelledby="bookRideModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('reservations.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="ride_id" value="{{ $ride->id }}">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="bookRideModalLabel">Book This Ride</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="seats" class="form-label">Number of Seats</label>
                            <input type="number" class="form-control" id="seats" name="seats" min="1" max="{{ $ride->available_seats }}" value="1" required>
                        </div>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Your request will be sent to the driver for confirmation.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
