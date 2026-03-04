<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;


class RoleMiddleware
{

    public function handle(Request $request, Closure $next,  ...$roles)
    {
        // **********************************
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
        // *****************************************

        // if (!Auth::check()) {
        //     return redirect('/login');
        // }

        // if (!in_array(Auth::user()->role, $roles)) {
        //     abort(403, "Unauthorized USER");
        // }

        // return $next($request);



    }
}
