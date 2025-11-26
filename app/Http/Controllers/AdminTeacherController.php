<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;


class AdminTeacherController extends Controller
{
    public function index() {
        $teachers = Teacher::all();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create() {
        return view('admin.teachers.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:teachers',
            'password'=>'required|min:6'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        Teacher::create($data);
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully');
    }
    
public function destroy($id){
    Teacher::findOrFail($id)->delete();
        return back()->with('success', 'Teacher deleted');
}

}
