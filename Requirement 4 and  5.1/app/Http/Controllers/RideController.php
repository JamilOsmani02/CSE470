<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ride;

class RideController extends Controller
{
    public function create()
    {
        return view('rides.create');
    }

    public function store(Request $request)
    {
        Ride::create([
            'user_id' => auth()->id(),
            'starting_point' => $request->starting_point,
            'destination' => $request->destination,
            'ride_time' => $request->ride_time,
            'seats_available' => $request->seats_available,
            'cost' => $request->cost,
        ]);

        return redirect()->route('dashboard')->with('success', 'Ride created successfully!');
    }
    
    public function search(Request $request)
    {
        $rides = Ride::query();
    
        // Filter by starting point and destination
        if ($request->starting_point) {
            $rides->where('starting_point', 'LIKE', '%' . $request->starting_point . '%');
        }
    
        if ($request->destination) {
            $rides->where('destination', 'LIKE', '%' . $request->destination . '%');
        }
    
        // Filter by cost (optional)
        if ($request->cost) {
            $rides->where('cost', '<=', $request->cost);
        }
    
        // Filter by ride time (optional)
        if ($request->ride_time) {
            $rides->where('ride_time', '>=', $request->ride_time);
        }
    
        $rides = $rides->get();
    
        return view('rides.search', compact('rides'));
    }
    
    public function history()
    {
        $rides = Ride::where('user_id', auth()->id())->get();
        return view('rides.history', compact('rides'));
    }
 


       

}
