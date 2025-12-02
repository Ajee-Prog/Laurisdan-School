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
    public function handle(Request $request, Closure $next,  ...$roles)
    {

        //  if ($role === 'teacher' && !auth('teacher')->check()) {
        //     return redirect('/teacher/login');
        // }

        // if ($role === 'student' && !auth('student')->check()) {
        //     return redirect('/student/login');
        // }

        // if ($role === 'parent' && !auth('parent')->check()) {
        //     return redirect('/parent/login');
        // }

        // return $next($request);


        // if (!Auth::check()) {
        //     return redirect('/login');
        // }

        // if (!in_array(Auth::user()->role, $roles)) {
        //     abort(403, 'Unauthorized');
        // }

        // if (!$request->user() ||  $request->user()->role !== $role) {
        //     abort(403);
        // }


        // main check middleware....

        // if (!Auth::check()) {
        //     return redirect('login');
        // }

        // if (in_array(Auth::user()->role, $roles)) {

        //     return $next($request);
            
        // }
        
        // abort(403, 'Unauthorized');

        // if (Auth::check() && Auth::user()->role == 'admin') {
        //     return $next($request); // Continue to the next middleware or controller
        // } else {
        //     return redirect('/login'); // Return a redirect response
        // }

        if (!Auth::check()) {
            return redirect('/login');
        }

        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, "Unauthorized");
        }

        return $next($request);
// --------------------------------------------------

        //  if (!auth()->check()) {
        //         abort(403);
        //     }

        //     if (!in_array(auth()->user()->role, $roles)) {
        //         abort(403, 'Unauthorized');
        //     }

        //     return $next($request);
    }
}
