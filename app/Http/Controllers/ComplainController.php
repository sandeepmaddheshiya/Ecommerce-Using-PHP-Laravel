<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\complain; // Import the complain model

class ComplainController extends Controller
{
    
        public function show()
        {
            // Get all complains from the database
            $complains = Complain::all(); // Correctly named model
            // Pass the complains to the view
            return view('superadmin.complainBox', compact('complains'));
        }
    
    
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:100',
            'message' => 'required|string',
        ]);

        // Create a new complain
        complain::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Redirect back or to a specific page with a success message
        return redirect()->back()->with('success', 'Your complain was submitted successfully!');
    }
}
