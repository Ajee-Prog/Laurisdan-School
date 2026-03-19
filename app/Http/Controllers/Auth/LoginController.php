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

    /*
    |--------------------------------------------------------------------------
    | Show Login Form
    |--------------------------------------------------------------------------
    */

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Login System (Email OR Admission Number)
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        $login = $request->login;

        // Detect if email or admission number
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'admission_no';

        $credentials = [
            $field => $login,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();
            // $user = auth()->user();
            // $role = auth()->user()->role;

            switch ($user->role) {

                case 'superadmin':
                    return redirect()->route('superadmin.dashboard');

                case 'admin':
                    return redirect()->route('admin.dashboard');

                case 'teacher':
                    return redirect()->route('teacher.dashboard');

                case 'parent':
                    return redirect()->route('parent.dashboard');

                case 'student':
                    // return redirect()->route('student.dashboard');
                    return redirect()->route('student.dashboard');

                default:
                    return redirect('/');
            }
        }

        return back()->withErrors([
            'login' => 'Invalid login credentials'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }



    // End of clean login***************




   /* //  public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email'=>'required|email',
    //         'password'=>'required',
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         $user = Auth::user();
    //         return redirect()->intended($this->redirectTo($user));
    //     }

    //     return back()->withErrors(['email'=>'Invalid credentials']);
    // }*/


        // return match($user->role) {
        //     'admin'   => '/admin/dashboard',
        //     'teacher' => '/teacher/dashboard',
        //     'parent'  => '/parent/dashboard',
        //     default   => '/student/dashboard',
        // };

        // $role = Auth::user()->role;


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
