<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentProfileController extends Controller
{
    public function edit()
    {
        $student = Auth::user()->student;
        return view('student.profile', compact('student'));
    }



public function update(Request $request){
    $student = Auth::user()->student;
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $student->name = $request->name;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/students', 'public');
            $student->image = 'storage/' . $path;
        }

        $student->save();
        return redirect()->back()->with('success', 'Profile updated successfully!');

}

}
