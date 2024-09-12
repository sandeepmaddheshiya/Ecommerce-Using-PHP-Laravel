<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\admin;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.admin_login');
    }

    public function login(Request $request)
    {
        // Validate the request data
        $credentials = $request->only('email', 'password');

        // Attempt to log the admin in
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();

            // Check registration status
            if ($admin->status === 'approved') {
                return redirect()->route('admin.dashboard', ['id' => $admin->id]);
            } else {
                Auth::guard('admin')->logout();
                return redirect()->back()->withErrors(['email' => 'Your account is pending approval'])->withInput();
            }
        }

        // Authentication failed
        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.form');
    }
}
