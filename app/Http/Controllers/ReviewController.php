<?php

// app/Http/Controllers/ReviewController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string',
        ]);

        // Create a new review
        Review::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->id(), // Ensure the user is authenticated
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Redirect back or to a specific page with a success message
        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

}
