<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable = [
        'user_id',
        'starting_point',
        'destination',
        'ride_time',
        'seats_available',
        'cost'
    ];
    
}
