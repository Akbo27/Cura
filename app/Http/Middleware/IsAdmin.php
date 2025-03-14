<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Dump the authenticated user to see their properties

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->is_admin !== true) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
