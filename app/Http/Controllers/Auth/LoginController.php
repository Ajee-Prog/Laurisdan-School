<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     public function showLoginForm()
    {
        return view('auth.login');
    }

     public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return redirect()->intended($this->redirectTo($user));
        }

        return back()->withErrors(['email'=>'Invalid credentials']);
    }

    protected function redirectTo($user)
    {
        // return match($user->role) {
        //     'admin'   => '/admin/dashboard',
        //     'teacher' => '/teacher/dashboard',
        //     'parent'  => '/parent/dashboard',
        //     default   => '/student/dashboard',
        // };

        $role = Auth::user()->role;

    switch ($role) {
        case 'superadmin':
            // return '/dashboard/superadmin';
            return route('superadmin.dashboard');
        case 'admin':
            return route('admin.dashboard');
        case 'teacher':
            return route('teacher.dashboard');

        case 'parent':
            // return '/dashboard/parent';
            return route('parent.dashboard');
        default:
            // return '/student/dashboard';
            return route('student.dashboard');
    }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    // protected function redirectTo(){
    //     $role = auth()->user()->role;
    //     return match($role){
    //         'admin' => route('admin.dashboard'),
    //         'teacher' => route('teacher.dashboard'),
    //         'student' => route('student.dashboard'),
    //         'parent' => route('parent.dashboard'),
    //         default => '/home',
    //     };
    // }
}
