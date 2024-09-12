<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminProfile
{
    public function handle(Request $request, Closure $next)
    {
        $admin = Auth::guard('admin')->user();
        $adminId = $request->route('id');

        if ($admin->id != $adminId) {
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
