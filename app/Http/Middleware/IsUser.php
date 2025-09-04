<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role !== 'user') {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
