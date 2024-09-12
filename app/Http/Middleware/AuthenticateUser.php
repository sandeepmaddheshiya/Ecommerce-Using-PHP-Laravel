<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserProfile
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user->profile_status == 'pending') {
            return redirect()->route('profile.pending');
        }

        if ($user->profile_status == 'rejected') {
            return redirect()->route('profile.rejected');
        }

        return $next($request);
    }
}
