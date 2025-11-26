<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
// use App\Rules\UserRole;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request; //as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    // new implementation start
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:users',
            'password'=>'required|min:6|confirmed',
            'role'=>'required|in:admin,teacher,parent,student'
        ]);

        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'role'=>$data['role'],
        ]);

        Auth::login($user);

        return redirect($this->redirectPath());
    }


     protected function redirectPath()
    {
        $role = Auth::user()->role;

        // return match($role) {
        //     'admin'   => '/admin/dashboard',
        //     'teacher' => '/teacher/dashboard',
        //     'parent'  => '/parent/dashboard',
        //     default   => '/student/dashboard',
        // };

        // $role = Auth::user()->role;

    switch ($role) {
        case 'admin':
            return '/admin/dashboard';
        case 'teacher':
            return '/teacher/dashboard';
        case 'parent':
            return '/parent/dashboard';
        default:
            return '/student/dashboard';
    }
    }
    // new implementation ends

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.user::class],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin, teacher, student, parent'],
            // 'role' => ['required', 'string', new UserRole],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role']
        ]);

        // event(new Registered($user));
        // Auth::login($user);
        // return redirect(RouteServiceProvider::HOME);
    }
}
