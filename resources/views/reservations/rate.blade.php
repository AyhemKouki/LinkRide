@extends('layout.layout')

@section('rate-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Rate Your Ride</div>

                    <div class="card-body">
                        <p>
                            You're rating your ride with {{ optional($reservation->ride->driver)->name ?? 'Unknown driver' }}
                            on {{ optional($reservation->ride->date)->format('M d, Y') ?? 'Unknown date' }}
                        </p>


                        <form method="POST" action="{{ route('reservations.submit-rating', $reservation) }}">
                            @csrf

                            <div class="form-group">
                                <label for="rating">Rating (1-5 stars)</label>
                                <select name="rating" id="rating" class="form-control" required>
                                    <option value="">Select rating</option>
                                    <option value="1">1 - Poor</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="3">3 - Good</option>
                                    <option value="4">4 - Very Good</option>
                                    <option value="5">5 - Excellent</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="comment">Optional Comment</label>
                                <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Rating</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
