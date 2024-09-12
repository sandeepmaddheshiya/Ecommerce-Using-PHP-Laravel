<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use App\Models\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApproveByAdminController extends Controller
{
    public function approveUser($id)
    {
        $user = User::all($id);
        if ($user) {
            $user->status = 'approved';
            $user->save();
        }
        return redirect()->route('superadmin.dashboard');
    }

    public function rejectUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 'rejected';
            $user->save();
        }
        return redirect()->route('superadmin.dashboard');
    }

    public function approveAdmin($id)
    {
        $admin = admin::find($id);
        if ($admin) {
            $admin->status = 'approved';
            $admin->save();
        }
        return redirect()->route('superadmin.dashboard');
    }

    public function rejectAdmin($id)
    {
        $admin = admin::find($id);
        if ($admin) {
            $admin->status = 'rejected';
            $admin->save();
        }
        return redirect()->route('superadmin.dashboard');
    }
}
