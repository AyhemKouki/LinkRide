@extends('layout.layout')

@section('title', 'Reservation Requests')

@section('reservation_content')
    <div class="container py-4">
        <h2>Reservation Requests</h2>

        <div class="list-group mt-4">
            @forelse($reservations as $reservation)
                <div class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>{{ $reservation->user->name }} - {{ $reservation->seats }} seat(s)</h5>
                            <p class="mb-1">From {{ $reservation->ride->origin }} to {{ $reservation->ride->destination }}</p>
                            <small class="text-muted">Requested on {{ $reservation->created_at->format('M d, Y H:i') }}</small>

                            @if($reservation->ride && $reservation->ride->date)
                                <div class="mt-2">
                                    <small class="text-muted">Ride date: {{ $reservation->ride->date->format('M d, Y') }}</small>
                                    @if($reservation->isCompleted())
                                        <span class="badge bg-secondary ms-2">Completed</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="text-end">
                            @if($reservation->status === 'pending')
                                @if(auth()->id() === $reservation->ride->driver_id)
                                    <form action="{{ route('reservations.confirm', $reservation) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                    </form>
                                    <form action="{{ route('reservations.reject', $reservation) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                @endif
                            @else
                                <span class="badge bg-{{
                                    $reservation->status === 'confirmed' ? 'success' :
                                    ($reservation->status === 'completed' ? 'secondary' : 'danger')
                                }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>

                                @if(auth()->id() === $reservation->ride->driver_id && $reservation->isConfirmed())
                                    <form action="{{ route('reservations.complete', $reservation) }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm w-100">
                                            Mark as Completed
                                        </button>
                                    </form>
                                @endif

                                @if(auth()->id() === $reservation->user_id &&
                                    $reservation->isCompleted() &&
                                    !$reservation->rating)
                                    <a href="{{ route('reservations.rate', $reservation) }}"
                                       class="btn btn-primary btn-sm mt-2 d-block">
                                        Rate This Ride
                                    </a>
                                @endif

                                @if($reservation->rating)
                                    <div class="mt-2">
                                        <small> rating:
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
            @empty
                <div class="alert alert-info">No reservation requests found.</div>
            @endforelse
        </div>
    </div>
@endsection
