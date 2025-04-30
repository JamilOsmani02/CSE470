<?php

namespace App\Http\Controllers;
use App\Models\Ride;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Ride $ride)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);
    
        $ride->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);
    
        return redirect()->back()->with('status', 'Review submitted!');
    }
     //
}
