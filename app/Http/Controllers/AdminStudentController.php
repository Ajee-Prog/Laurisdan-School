<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;


class AdminStudentController extends Controller
{
     public function index() {
        $students = Student::all();
        return view('admin.students.index', compact('students'));
    }

    public function create() {
        return view('admin.students.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'password' => 'required|min:6',
            'date_of_birth' => 'required|min:6',
            'gender' => 'required',
            'admission_no' => 'required',
            'phone' => 'required|string|max:20',
            'state' => 'required',
            'nationality' => 'required',
            'religion' => 'required',
            'parent_contact' => 'required',
            'class_id' => 'required|exists:classe_models,id',
            'parent_id' => 'nullable|exists:parent_models,id',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // state

        // if ($request->hasFile('passport')) {
        //     $validated['passport'] = $request->file('passport')->store('students', 'public');
        // }

        $imagePath = $request->file('image') ? 
        $request->file('image')->store('students', 'public') : null;

        // Student::create($validated);
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'admission_no' => $request->admission_no,
            'state' => $request->state,
            'nationality' => $request->nationality,
            'religion' => $request->religion,
            'parent_contact' => $request->parent_contact,
            'phone' => $request->phone,
            'class_id' => $request->class_id,
            'parent_id' => $request->parent_id,
            'image' => $imagePath,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student Registered successfully!');
    }


public function destroy($id){
    Student::findOrFail($id)->delete();
    return back()->with('success', 'Student deleted');
}

}
