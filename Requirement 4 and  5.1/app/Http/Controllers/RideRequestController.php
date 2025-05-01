<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RideRequest;

class RideRequestController extends Controller
{
    public function requestRide($rideId)
    {
        if (RideRequest::where('ride_id', $rideId)->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You already requested this ride.');
        }

        RideRequest::create([
            'ride_id' => $rideId,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Request sent.');
    }

    public function respond(Request $request, $requestId)
    {
        $rideRequest = RideRequest::findOrFail($requestId);
        $rideRequest->update(['status' => $request->status]);

        return back()->with('success', 'Response sent.');
    }
}
