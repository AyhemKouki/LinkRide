<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable = [
        'driver_id',
        'origin',
        'destination',
        'departure_time',
        'available_seats',
        'price_per_seat',
        'image',
        'notes',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
    protected function casts(): array
    {
        return [
            'departure_time' => 'datetime',
        ];
    }
}
