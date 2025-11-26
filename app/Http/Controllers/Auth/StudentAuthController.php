<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{
     public function showLoginForm() {
        return view('auth.student-login');
    }

    public function login(Request $request) {
        $credentials = $request->only('student_code', 'password');

        if (Auth::guard('student')->attempt($credentials)) {
            return redirect()->route('students.dashboard');
        }

        return back()->withErrors(['student_code' => 'Invalid student code or password']);
    }


public function logout(){
    Auth::guard('student')->logout();
        return redirect('/student/login');
}

}
