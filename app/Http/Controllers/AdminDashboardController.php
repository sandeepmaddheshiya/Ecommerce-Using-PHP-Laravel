<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index($id)
    {
        // Retrieve the authenticated admin's data
        $admin = Auth::guard('admin')->user();

        // Ensure the ID matches the authenticated admin's ID
        if ($admin->id !== (int)$id) {
            return redirect()->route('admin.login.form')->withErrors(['access' => 'Unauthorized access.']);
        }

        // Render the admin dashboard view
        return view('admin.admin_dashboard', compact('admin'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.form');
    }
}
