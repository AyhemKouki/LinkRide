<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RideController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rides
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resources([
        'ride' => RideController::class,
    ]);
    Route::get('/rides/search', [RideController::class, 'search'])->name('ride.search');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Reservations and notifications
Route::middleware('auth')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])
        ->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::post('/reservations/{reservation}/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
    Route::post('/reservations/{reservation}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::post('/notifications/mark-as-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Notifications marked as read');
    })->name('markNotificationsAsRead');

    Route::get('/reservations/{reservation}/rate', [ReservationController::class, 'showRatingForm'])
        ->name('reservations.rate');

    Route::post('/reservations/{reservation}/rate', [ReservationController::class, 'submitRating'])
        ->name('reservations.submit-rating');

    Route::post('/reservations/{reservation}/complete', [ReservationController::class, 'complete'])
        ->name('reservations.complete');
});

require __DIR__.'/auth.php';
