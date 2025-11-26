<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentAuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.parent-login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('parent')->attempt($credentials)) {
            return redirect()->route('parents.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }


public function logout(){
    Auth::guard('parent')->logout();
        return redirect('/parent/login');
}

}
