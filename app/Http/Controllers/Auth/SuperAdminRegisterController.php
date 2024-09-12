<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SuperAdminRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('superadmin.register');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:55|unique:super_admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new SuperAdmin
        $superadmin = SuperAdmin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the SuperAdmin in
        Auth::guard('superadmin')->login($superadmin);

        // Redirect to the dashboard
        return redirect()->route('superadmin.dashboard');
    }
}
