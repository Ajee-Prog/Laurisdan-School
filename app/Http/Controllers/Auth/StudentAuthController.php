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
    //     $credentials = $request->only('student_code', 'password');

    //     if (Auth::guard('student')->attempt($credentials)) {
    //         return redirect()->route('students.dashboard');
    //     }

    //     return back()->withErrors(['student_code' => 'Invalid student code or password']);
    // }
    $request->validate([
            'admission_no' => 'required',
            'password'     => 'required',
        ]);

        if (Auth::guard('student')->attempt([
            'admission_no' => $request->admission_no,
            'password'     => $request->password
        ])) {
            $request->session()->regenerate();
            return redirect()->route('students.dashboard');
        }

        return back()->withErrors([
            'admission_no' => 'Invalid admission number or password',
        ]);
    }

    // public function logout()
    // {
    //     Auth::guard('student')->logout();
    //     return redirect()->route('student.login');
    // }

    // New Student login
    protected function credentials(Request $request)
{
    if ($request->has('admission_no')) {
        return [
            'admission_no' => $request->admission_no,
            'password' => $request->password,
        ];
    }

    return [
        'email' => $request->email,
        'password' => $request->password,
    ];
}

// New student ends here


public function logout(){
    Auth::guard('student')->logout();
        return redirect('/student/login');
}

}
