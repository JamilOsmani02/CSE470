<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RideRequest extends Model
{
    protected $fillable = ['ride_id', 'user_id', 'status'];

}
