<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;

class SuperAdminController extends Controller
{
    // Show the SuperAdmin dashboard
    public function dashboard()
    {
        $users = User::where('status', 'pending')->paginate(3);
        $admins = Admin::where('status', 'pending')->paginate(3);

        return view('superadmin.dashboard', compact('users', 'admins'));
    }


    public function users()
    {
        $users = User::paginate(3);
        return view('superadmin.users', compact('users'));
    }

    public function admins()
    {
        $admins = Admin::paginate(3);
        return view('superadmin.admins', compact('admins'));
    }

    public function userslist()
    {
        $userslist = User::where('status', 'approved')->get();

        return view('superadmin.users', compact('userslist'));
    }

    public function AdminList()
    {
        $adminlist = Admin::where('status', 'approved')->get();

        return view('superadmin.admins', compact('adminlist'));
    }

    public function updateSalary(Request $request, $id)
    {
        $request->validate([
            'salary' => 'required|numeric|min:0',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->salary = $request->input('salary');
        $admin->save();

        return redirect()->route('superadmin.adminlist')->with('success', 'Salary updated successfully.');
    }

    public function editAdmin($id)
    {
        // Find the admin by ID
        $admin = Admin::findOrFail($id);

        // Return a view to edit the admin details
        return view('superadmin.editAdmin', compact('admin'));
    }


    public function updateAdmin(Request $request, $id)
    {
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
        'phone' => 'required|string|max:15',
        'address' => 'required|string',
        'salary' => 'required|numeric|min:0',
    ]);

    // Find the admin by ID
    $admin = Admin::findOrFail($id);

    // Update the admin details
    $admin->name = $request->input('name');
    $admin->email = $request->input('email');
    $admin->phone = $request->input('phone');
    $admin->address = $request->input('address');
    $admin->salary = $request->input('salary');
    $admin->save();

    // Redirect to the admin list with success message
    return redirect()->route('superadmin.adminlist')->with('success', 'Admin updated successfully.');
    }


    public function destroyAdmin($id)
    
    {
        // Find the admin by ID and delete
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('superadmin.adminlist')->with('success', 'Admin deleted successfully.');
    }
    public function destroyUser($id)
    
    {
        // Find the admin by ID and delete
        $User = User::findOrFail($id);
        $User->delete();

        return redirect()->route('superadmin.userslist')->with('success', 'User deleted successfully.');
    }


    public function logout(Request $request)
    {
        Auth::guard('superadmin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('superadmin.login.form');
    }
}
