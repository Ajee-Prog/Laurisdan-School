<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
     public function showLoginForm() {
        return view('auth.student-login');
    }

    public function login(Request $request) {

        $request->validate([
            'admission_no' => 'required',
            'password' => 'required',
        ]);

        // ******************
        $credentials = [
            'admission_no' => $request->admission_no,
            'password'     => $request->password,
            'role'         => 'student'
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.student');
        }
        // ******************

        // if (Auth::guard('student')->attempt([
        //     'admission_no' => $request->admission_no,
        //     'password' => $request->password,
        //     'role'         => 'student'
        // ])) {
        //     $request->session()->regenerate();

        //     return redirect()->route('dashboard.student');
        // }

        // return back()->withErrors([
        //     'admission_no' => 'Invalid admission number or password',
        // ]);



    }

    // New student ends here


    public function logout(){
        Auth::guard('student')->logout();
            return redirect('/student/login');
    }

}
