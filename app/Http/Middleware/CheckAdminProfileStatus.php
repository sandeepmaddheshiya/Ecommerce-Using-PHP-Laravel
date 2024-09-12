<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminProfileStatus
{
    public function handle($request, Closure $next)
    {
        $admin = Auth::guard('admin')->user();

        if ($admin->profile_status == 'pending') {
            return redirect()->route('profile.pending');
        }

        if ($admin->profile_status == 'rejected') {
            return redirect()->route('profile.rejected');
        }

        return $next($request);
    }
}
