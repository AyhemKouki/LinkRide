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
                            <p class="mb-1">From* {{ $reservation->ride->origin }} to {{ $reservation->ride->destination }}</p>
                            <small class="text-muted">Requested on {{ $reservation->created_at->format('M d, Y H:i') }}</small>
                        </div>
                        <div>
                            @if($reservation->status === 'pending')
                                <form action="{{ route('reservations.confirm', $reservation) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                </form>
                                <form action="{{ route('reservations.reject', $reservation) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            @else
                                <span class="badge bg-{{ $reservation->status === 'confirmed' ? 'success' : 'danger' }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
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
