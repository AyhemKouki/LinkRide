<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RideController extends Controller
{
    public function index()
    {
        $rides = Ride::all();
        return view('ride.index', compact('rides'));
    }

    public function create()
    {
        return view('ride.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required |date|after:now',
            'available_seats' => 'required | integer|min:1|max:10',
            'price_per_seat' => 'required|numeric|min:0.01|max:1000',
            'notes' => 'nullable|string|max:500',
        ]);

        // Set driver_id to current user
        $data['driver_id'] = auth()->id();

        $image = Storage::putFile('uploads', $request->file('image'));

        $data['image'] = $image;

        Ride::create($data);
        flash()->success('Ride created successfully');
        return redirect()->route('ride.index');
    }

    public function show(Ride $ride)
    {
        return view('ride.show' , compact('ride'));
    }

    public function edit(Ride $ride)
    {
        return view('ride.edit' , compact('ride'));
    }

    public function update(Request $request, Ride $ride)
    {
        //update image
        if ($request->hasFile('image'))
        {
            $request->validate(['image' => 'required|image']);
            Storage::delete($ride->image);
            $image = Storage::putFile('uploads', $request->file('image'));
            $ride->update(['image' => $image]);
        }
        //update other data
        $data = $request->validate([
            'origin' => 'required |string|max:255',
            'destination' => 'required |string|max:255',
            'departure_time' => 'required |date|after:now',
            'available_seats' => 'required | integer | min:1 | max:10',
            'price_per_seat' => 'required | numeric|min:0.01|max:1000',
            'notes' => 'nullable|string|max:500',
        ]);
        $ride->update($data);
        flash()->success('Ride updated successfully');
        return redirect()->route('ride.index');
    }

    public function destroy(Ride $ride)
    {
        Storage::delete($ride->image);
        $ride->delete();
        flash()->success('Ride deleted successfully');
        return redirect()->route('ride.index');

    }
}
