<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;

class RideController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $upcoming = $user->rides()
            ->where('ride_time', '>', now())
            ->where('is_cancelled', false)
            ->with('reviews.user') 
            ->get();

        $past = $user->rides()
            ->where('ride_time', '<=', now())
            ->with('reviews.user')
            ->get();

        return view('rides.index', compact('upcoming', 'past'));
    }
    
    public function cancel(Ride $ride)
    {
        if ($ride->user_id !== auth()->id()) {
            abort(403);
        }
    
        $ride->update(['is_cancelled' => true]);
    
        return redirect()->route('rides.index')->with('status', 'Ride cancelled.');
    }

    public function create()
    {
        return view('rides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination' => 'required|string|max:255',
            'ride_time' => 'required|date',
            'details' => 'nullable|string',
        ]);

        $ride_time = \Carbon\Carbon::createFromFormat('d/m/Y', $validated['ride_time']);

        $request->user()->rides()->create([
            'destination' => $validated['destination'],
            'ride_time' => $validated['ride_time'],
            'details' => $validated['details'],
            'is_cancelled' => false,
        ]);

        return redirect()->route('rides.index')->with('status', 'Ride created successfully!');
    }
}
