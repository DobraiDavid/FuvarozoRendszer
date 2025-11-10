<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Simple check: admin has ID = 1 or email contains 'admin'
        if (auth()->guard('fuvarozo')->check() &&
            (auth()->guard('fuvarozo')->id() == 1 ||
                str_contains(auth()->guard('fuvarozo')->user()->email, 'admin'))) {
            return $next($request);
        }

        abort(403, 'Csak adminisztrátorok férhetnek hozzá.');
    }
}