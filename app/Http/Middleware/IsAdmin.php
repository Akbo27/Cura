<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $hasAuth = auth()->check();
        if(!$hasAuth) {
            abort(401);
        }

        $isAdmin = auth()->user()->is_admin;
        if($isAdmin) {
            return $next($request);
        }

        return redirect()->route('admin.appointments.index');
    }
}
