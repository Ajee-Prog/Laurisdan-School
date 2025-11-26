<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;


class AdminTeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'teacher';

        User::create($data);
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher registered successfully!');
    }


public function destroy($id){
    User::findOrFail($id)->delete();
    return back()->with('success', 'Teacher deleted!');

}

}
