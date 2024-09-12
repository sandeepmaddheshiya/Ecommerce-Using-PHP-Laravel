<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.admin_register');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new admin record
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            // 'salary' => $request->salary,
            'password' => Hash::make($request->password),
            // 'status' => 'pending', // default status
        ]);

        // Optionally, redirect to a different page or show a success message
        return redirect()->route('admin.register.form')->with('success', 'Admin registered successfully.');
    }
}
