<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Ride;
use App\Notifications\ReservationConfirmed;
use App\Notifications\ReservationRejected;
use App\Notifications\ReservationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all reservations where:
        // - The ride belongs to the current user (driver) OR
        // - The reservation belongs to the current user (passenger)
        $reservations = Reservation::where(function($query) {
            $query->whereHas('ride', function($q) {
                $q->where('driver_id', auth()->id()); // Driver's view
            })->orWhere('user_id', auth()->id()); // Passenger's view
        })
            ->with(['ride', 'user'])
            ->latest()
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ride_id' => 'required|exists:rides,id',
            'seats' => 'required|integer|min:1'
        ]);

        $ride = Ride::findOrFail($request->ride_id);

        // Check available seats
        if ($ride->available_seats < $request->seats) {
            return back()->with('error', 'Not enough seats available.');
        }

        // Create reservation
        $reservation = Reservation::create([
            'ride_id' => $ride->id,
            'user_id' => Auth::id(),
            'seats' => $request->seats,
            'status' => 'pending'
        ]);

        // Notify driver
        $ride->driver->notify(new ReservationRequest($reservation));

        return redirect()->back()->with('success', 'Your booking request has been sent to the driver.');
    }

    public function confirm(Reservation $reservation)
    {
        // Only driver can confirm
        if (auth()->id() !== $reservation->ride->driver_id) {
            abort(403);
        }

        $reservation->update(['status' => 'confirmed']);

        // Update available seats
        $reservation->ride->decrement('available_seats', $reservation->seats);

        // Notify passenger
        $reservation->user->notify(new ReservationConfirmed($reservation));

        return back()->with('success', 'Reservation confirmed successfully.');
    }

    public function reject(Reservation $reservation)
    {
        if (auth()->id() !== $reservation->ride->driver_id) {
            abort(403);
        }

        $reservation->update(['status' => 'rejected']);

        // Notify passenger
        $reservation->user->notify(new ReservationRejected($reservation));

        return back()->with('success', 'Reservation rejected.');
    }

    public function destroy(Reservation $reservation)
    {
        // Only allow cancellation if pending or owner
        abort_if(
            !$reservation->isPending() && auth()->id() !== $reservation->user_id,
            403,
            'You can only cancel pending reservations'
        );

        $reservation->update(['status' => 'canceled']);

        if ($reservation->isConfirmed()) {
            $reservation->ride->increment('available_seats', $reservation->seats);
        }

        return back()->with('success', 'Reservation canceled.');
    }
}
