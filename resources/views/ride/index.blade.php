@extends('layout.layout')

@section('title', 'My Rides')

@section('ride_content')
    <div class="container my-5">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-primary text-white fs-4 fw-semibold rounded-top-4 d-flex justify-content-between align-items-center">
                <span><i class="fas fa-list me-2"></i>My Rides</span>
                <a href="{{ route('ride.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i>Create Ride
                </a>
            </div>

            <div class="card-body p-4">
                @forelse($rides as $ride)
                    @if(auth()->id() === $ride->driver_id)
                        <div class="card shadow-sm mb-4 border-0 rounded-3">
                            <div class="row g-0">
                                @if($ride->image)
                                    <div class="col-md-4">
                                        <img src="{{ asset('storage/' . $ride->image) }}"
                                             class="img-fluid rounded-start h-100 w-100 object-fit-cover"
                                             alt="Ride Image">
                                    </div>
                                @endif

                                <div class="col-md-{{ $ride->image ? '8' : '12' }}">
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h4 class="card-title text-primary mb-0">
                                                {{ $ride->origin }} → {{ $ride->destination }}
                                            </h4>

                                            <div class="d-flex flex-wrap gap-2">
                                                @if($ride->departure_time > now())
                                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                                        <i class="fas fa-check-circle me-1"></i>Available
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger rounded-pill px-3 py-2">
                                                        <i class="fas fa-times-circle me-1"></i>Expired
                                                    </span>
                                                @endif

                                                <a href="{{ route('ride.edit', $ride) }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-edit me-1"></i>Edit
                                                </a>

                                                <form action="{{ route('ride.destroy', $ride) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this ride?')">
                                                        <i class="fas fa-trash-alt me-1"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="row text-muted small">
                                            <div class="col-6 col-md-4 mb-2">
                                                <div class="fw-semibold">Departure</div>
                                                {{ $ride->departure_time->format('M j, Y - g:i A') }}
                                            </div>
                                            <div class="col-6 col-md-4 mb-2">
                                                <div class="fw-semibold">Available Seats</div>
                                                {{ $ride->available_seats }}
                                            </div>
                                            <div class="col-6 col-md-4 mb-2">
                                                <div class="fw-semibold">Price/Seat</div>
                                                ${{ number_format($ride->price_per_seat, 2) }}
                                            </div>
                                        </div>

                                        @if($ride->notes)
                                            <div class="mt-3">
                                                <div class="text-muted small fw-semibold">Notes</div>
                                                <p class="mb-0">{{ $ride->notes }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-car-slash fa-2x mb-3"></i>
                        <p class="mb-0">You haven't created any rides yet.</p>
                    </div>
                @endforelse
            </div>

            <div class="card-footer bg-light rounded-bottom-4 text-end py-3">
                <small class="text-muted">Total Rides: {{ $rides->where('driver_id', auth()->id())->count() }}</small>
            </div>
        </div>
    </div>
@endsection
