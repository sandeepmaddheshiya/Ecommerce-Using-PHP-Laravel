<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserRegisterController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        return view('users.user_register');
    }

    // Handle the registration request
    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new user instance with default approved status
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'approved', // Set status to approved
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect to the user dashboard with the user ID
        return redirect()->route('user_dashboard', ['id' => $user->id])->with('success', 'User registered successfully.');
    }
}
