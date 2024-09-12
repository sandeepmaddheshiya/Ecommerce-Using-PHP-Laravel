<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserLoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('users.user_login'); // Ensure this view file exists
    }

    // Handle the login request
    public function login(Request $request)
    {
        // Validate the request data
        $credentials = $request->only('email', 'password');

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check registration status
            if ($user->status === 'approved') {
                return redirect()->route('user_dashboard', ['id' => $user->id]);
            } else {
                Auth::logout();
                $message = $user->status === 'pending' ? 'Your account is pending approval' : 'Your account has been rejected';
                return redirect()->back()->withErrors(['email' => $message])->withInput();
            }
        }

        // Authentication failed
        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    // Handle logout request
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
