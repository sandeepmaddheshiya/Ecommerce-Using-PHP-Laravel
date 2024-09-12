<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index($id)
    {
        // Retrieve the authenticated user's data
        $user = Auth::guard('web')->user();

        // Ensure the ID matches the authenticated user's ID
        if ($user->id !== (int)$id) {
            return redirect()->route('login')->withErrors(['access' => 'Unauthorized access.']);
        }

        // Render the user dashboard view
        return view('users.user_dashboard', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
