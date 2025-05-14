<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\User;

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

        $drivers = User::select('id', 'name', 'profile_image' , 'avg_rating')
            ->where('avg_rating', '>', 0)
            ->withCount('ratings')
            ->limit(3)
            ->orderBy('avg_rating', 'desc')
            ->get();



        return view('front.home', compact('ratings','drivers'));
    }
}
