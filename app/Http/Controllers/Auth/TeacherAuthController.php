<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.teacher-login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('teacher')->attempt($credentials)) {
            return redirect()->route('teachers.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

//     
public function logout(){
    Auth::guard('teacher')->logout();
        return redirect('/teacher/login');
}

}
