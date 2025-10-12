<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // if (!Auth()::check()) {
        //     return redirect('/login');
        // }

        // if (!in_array(Auth::user()->role, $roles)) {
        //     abort(403, 'Unauthorized');
        // }

        // if (!$request->user() ||  $request->user()->role !== $role) {
        //     abort(403);
        // }

        if (!Auth::check()) {
            return redirect('/login');
        }
        if (! in_array(Auth::user()->role, $roles)) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
