<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        $admin = Auth::user()->admin;
        if ($admin && $admin->permissions->contains('name', $permission)) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have permission to access this resource.');
    }
}
