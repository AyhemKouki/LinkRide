@extends('layout.layout')

@section('title', 'Reservation Requests')

@section('reservation_content')
    <div class="container py-4">
        <h2 class="mb-4">Reservation Requests</h2>

        @forelse($reservations as $reservation)
            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    {{-- Header: Requester + Seats --}}
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="mb-1">
                                {{ $reservation->user->name }} — {{ $reservation->seats }} seat(s)
                            </h5>
                            <p class="text-muted mb-1">
                                From <strong>{{ $reservation->ride->origin }}</strong>
                                to <strong>{{ $reservation->ride->destination }}</strong>
                            </p>
                            <small class="text-muted">Requested on {{ $reservation->created_at->format('M d, Y H:i') }}</small>

                            @if($reservation->ride && $reservation->ride->date)
                                <div class="mt-2">
                                    <small class="text-muted">
                                        Ride date: {{ $reservation->ride->date->format('M d, Y') }}
                                    </small>
                                    @if($reservation->isCompleted())
                                        <span class="badge bg-secondary ms-2">Completed</span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        {{-- Status + Actions --}}
                        <div class="text-end">
                            @if($reservation->status === 'pending')
                                @if(auth()->id() === $reservation->ride->driver_id)
                                    <form action="{{ route('reservations.confirm', $reservation) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success mb-1">Confirm</button>
                                    </form>
                                    <form action="{{ route('reservations.reject', $reservation) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger mb-1">Reject</button>
                                    </form>
                                @endif
                            @else
                                <span class="badge bg-{{
                                    $reservation->status === 'confirmed' ? 'success' :
                                    ($reservation->status === 'completed' ? 'secondary' : 'danger')
                                }} mb-2 d-block">
                                    {{ ucfirst($reservation->status) }}
                                </span>

                                {{-- Mark Completed --}}
                                @if(auth()->id() === $reservation->ride->driver_id && $reservation->isConfirmed())
                                    <form action="{{ route('reservations.complete', $reservation) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-info w-100">
                                            Mark as Completed
                                        </button>
                                    </form>
                                @endif

                                {{-- Rate This Ride --}}
                                @if(auth()->id() === $reservation->user_id && $reservation->isCompleted() && !$reservation->rating)
                                    <a href="{{ route('reservations.rate', $reservation) }}" class="btn btn-sm btn-primary w-100 mt-2">
                                        Rate This Ride
                                    </a>
                                @endif

                                {{-- Display Rating --}}
                                @if($reservation->rating)
                                    <div class="mt-2">
                                        <small>Rating:
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $reservation->rating->rating)
                                                    ★
                                                @else
                                                    ☆
                                                @endif
                                            @endfor
                                        </small>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="alert alert-info">No reservation requests found.</div>
        @endforelse
    </div>
@endsection
