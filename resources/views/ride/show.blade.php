@extends('layout.layout')

@section('title', 'Ride Details')

@section('ride_show')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Ride Card -->
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                        <h3 class="mb-0"><i class="fas fa-car me-2"></i>Ride Details</h3>
                        <span class="badge bg-light text-primary fs-5">${{ number_format($ride->price_per_seat, 2) }} / seat</span>
                    </div>

                    <div class="card-body p-4">
                        <!-- Route Info -->
                        <div class="mb-4 p-4 bg-light rounded-3 border">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-primary mb-0"><i class="fas fa-route me-2"></i>Route</h4>
                                <span class="badge bg-info text-dark px-3 py-2"><i class="fas fa-users me-1"></i>{{ $ride->available_seats }} seats available</span>
                            </div>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2 d-flex align-items-center">
                                    <div class="bg-success text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 32px; height: 32px;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <strong>From:</strong> {{ $ride->origin }}
                                </li>
                                <li class="mb-2 d-flex align-items-center">
                                    <div class="bg-danger text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 32px; height: 32px;">
                                        <i class="fas fa-flag-checkered"></i>
                                    </div>
                                    <strong>To:</strong> {{ $ride->destination }}
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 32px; height: 32px;">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <strong>Departure:</strong> {{ $ride->departure_time->format('l, F j, Y') }} at {{ $ride->departure_time->format('g:i A') }}
                                </li>
                            </ul>
                        </div>

                        <!-- Driver Info -->
                        <div class="mb-4 p-4 bg-light rounded-3 border">
                            <h4 class="text-primary mb-3"><i class="fas fa-user me-2"></i>Driver</h4>
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <img src="{{ asset($ride->driver->profile_image ? 'storage/'.$ride->driver->profile_image : 'images/default-profile.jpg') }}"
                                         class="rounded-circle border shadow-sm"
                                         width="80" height="80" alt="Driver">
                                </div>
                                <div>
                                    <h5 class="mb-1">{{ $ride->driver->name }}</h5>
                                    <div class="text-warning">
                                        @php $avgRating = round($ride->driver->avg_rating, 1); @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $avgRating ? '' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/'.$ride->image) }}"
                                     class="rounded-3 shadow-sm" width="80" height="80" alt="Car Image">
                                <div class="ms-3">
                                    <h6 class="mb-0 text-muted">Car Photo</h6>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        @if($ride->notes)
                            <div class="mb-4 p-4 bg-light rounded-3 border">
                                <h4 class="text-primary mb-2"><i class="fas fa-info-circle me-2"></i>Additional Notes</h4>
                                <p class="mb-0 text-muted">{{ $ride->notes }}</p>
                            </div>
                        @endif

                        <!-- Map Preview -->
                        <div class="mb-4 p-4 bg-light rounded-3 border">
                            <h4 class="text-primary mb-3"><i class="fas fa-map-marked-alt me-2"></i>Route Map</h4>
                            <iframe
                                width="100%" height="400" frameborder="0" scrolling="no"
                                src="https://maps.google.com/maps?q={{ urlencode($ride->origin) }} to {{ urlencode($ride->destination) }}&output=embed">
                            </iframe>
                            <p class="mt-2 small text-muted">
                                <a href="https://www.google.com/maps/dir/?api=1&origin={{ urlencode($ride->origin) }}&destination={{ urlencode($ride->destination) }}"
                                   target="_blank">Open in Google Maps</a>
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('ride.search') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Search
                            </a>

                            @auth
                                @if(auth()->user()->id !== $ride->driver_id)
                                    @if($ride->available_seats > 0)
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookRideModal">
                                            <i class="fas fa-ticket-alt me-2"></i>Book This Ride
                                        </button>
                                    @else
                                        <button class="btn btn-danger" disabled>
                                            <i class="fas fa-times-circle me-2"></i>No Seats Available
                                        </button>
                                    @endif
                                @else
                                    <div class="btn-group">
                                        <a href="{{ route('ride.edit', $ride->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <form action="{{ route('ride.destroy', $ride->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Book Ride Modal -->
    <div class="modal fade" id="bookRideModal" tabindex="-1" aria-labelledby="bookRideModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 rounded-3 shadow-lg">
                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ride_id" value="{{ $ride->id }}">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="bookRideModalLabel"><i class="fas fa-ticket-alt me-2"></i>Book This Ride</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="seats" class="form-label">Seats to Book</label>
                            <input type="number" name="seats" id="seats" class="form-control" min="1" max="{{ $ride->available_seats }}" required>
                        </div>
                        <div class="alert alert-info d-flex align-items-center">
                            <i class="fas fa-info-circle me-2"></i>
                            Request will be sent to the driver for confirmation.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
