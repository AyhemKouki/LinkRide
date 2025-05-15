@extends('layout.layout')

@section('title', 'Rate Your Ride')

@section('rate-content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow border-0 rounded-4">
                    <div class="card-header bg-primary text-white fs-4 fw-semibold rounded-top-4">Rate Your Ride</div>

                    <div class="card-body">

                        <p class="mb-4">
                            You’re rating your ride with
                            <strong>{{ optional($reservation->ride->driver)->name ?? 'Unknown driver' }}</strong>
                            on
                            <strong>{{ optional($reservation->ride->departure_time)->format('M d, Y') ?? 'Unknown date' }}</strong>
                        </p>

                        {{-- Rating form --}}
                        <form method="POST" action="{{ route('reservations.submit-rating', $reservation) }}">
                            @csrf

                            {{-- Rating --}}
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating (1–5 stars)</label>
                                <select name="rating" id="rating" class="form-select" required>
                                    <option value="">Select rating</option>
                                    <option value="1">1 ★ – Poor</option>
                                    <option value="2">2 ★★ – Fair</option>
                                    <option value="3">3 ★★★ – Good</option>
                                    <option value="4">4 ★★★★ – Very Good</option>
                                    <option value="5">5 ★★★★★ – Excellent</option>
                                </select>
                                @error('rating')
                                <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Comment --}}
                            <div class="mb-3">
                                <label for="comment" class="form-label">Optional Comment</label>
                                <textarea name="comment" id="comment" rows="3"
                                          class="form-control"
                                          placeholder="Write a short comment (optional)">{{ old('comment') }}</textarea>
                                @error('comment')
                                <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Buttons --}}
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Submit Rating</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
