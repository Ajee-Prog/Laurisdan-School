<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Fee;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{

    public function loginForm()
{
    return view('auth.superadmin-login');
}

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password,
        'role' => 'superadmin'
    ])) {
        return redirect()->route('superadmin.dashboard');
    }

    return back()->with('error', 'Invalid login credentials');
}  



    public function dashboard()
    {
        return view('superadmin.dashboard', [
            'totalAdmins'   => User::where('role', 'admin')->count(),
            'totalTeachers' => Teacher::count(),
            'totalStudents' => Student::count(),
            'totalParents'  => User::where('role', 'parent')->count(),
            'totalExams'    => Exam::count(),
            'totalSubjects' => Subject::count(),
            'classes'       => SchoolClass::count(),
            'fees'          => Fee::count(),
        ]);
    }


    // LIST ALL ADMINS
    public function index()
    {
        $admins = User::whereIn('role', ['super_admin', 'admin'])->get();
        return view('superadmin.index', compact('admins'));
    }

    // CREATE FORM
    public function create()
    {
        return view('superadmin.create');
    }

    // STORE NEW ADMIN
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role
        ]);

        return redirect()->route('superadmin.index')
                         ->with('success','Admin created successfully');
    }

    // EDIT FORM
    public function edit(User $user)
    {
        return view('superadmin.edit', compact('user'));
    }

    // UPDATE ADMIN
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'role'=>'required'
        ]);

        $data = $request->only('name','email','role');

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('superadmin.index')->with('success','Admin Updated');
    }

    // DELETE ADMIN
    public function destroy(User $user)
    {
        if ($user->role === 'super_admin') {
            return back()->with('error', 'You cannot delete a Super Admin');
        }

        $user->delete();
        return back()->with('success','Admin Removed');
    }
}
