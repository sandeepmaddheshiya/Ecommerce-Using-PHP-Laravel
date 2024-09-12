<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\permissions;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function createPermissions()
    {
        // Creating permissions
        $permissions = ['create product', 'update product', 'delete product', 'view product'];
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission, 'guard_name' => 'admin']);
        }

        return "Permissions created successfully!";
    }

    public function assignPermission(Request $request)
    {
        $admin = Admin::find($request->admin_id);
        $permission = Permission::find($request->permission_id);
        $admin->permissions()->attach($permission);

        return redirect()->back()->with('success', 'Permission assigned successfully.');
    }


    public function index()
    {
        $permissions = Permission::all();
        $admins = Admin::all();

        return view('permissions.index', compact('permissions', 'admins'));
    }
}
