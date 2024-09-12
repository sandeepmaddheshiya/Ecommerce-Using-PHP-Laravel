<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\SuperAdmin;

class SuperAdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('superadmin.login');
    }

    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        $credentials = $request->only('email', 'password');
        if (Auth::guard('superadmin')->attempt($credentials)) {
            // Redirect to dashboard on successful login
            return redirect()->route('superadmin.dashboard');
        }

        // Redirect back with error message on failure
        return redirect()->back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('superadmin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('superadmin.login.form');
    }
}
