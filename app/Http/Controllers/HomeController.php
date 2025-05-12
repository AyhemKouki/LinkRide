<?php

namespace App\Http\Controllers;

use App\Models\Rating;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.home');
    }
    public function showRatings()
    {
        $ratings = Rating::with(['user', 'driver', 'reservation.ride'])
            ->latest()
            ->paginate(15);


        return view('front.home', compact('ratings'));
    }
}
