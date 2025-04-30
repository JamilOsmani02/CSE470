<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination', 
        'ride_time', 
        'details', 
        'is_cancelled',
    ];

    protected $casts = [
        'ride_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
