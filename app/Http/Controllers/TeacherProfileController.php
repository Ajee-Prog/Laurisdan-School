<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TeacherProfileController extends Controller
{
    public function edit()
    {
        $teacher = Auth::user()->teacher;
        return view('teacher.profile', compact('teacher'));
    }

    public function update(Request $request)
    {
        $teacher = Auth::user()->teacher;

        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $teacher->name = $request->name;
        $teacher->subject = $request->subject;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/teachers', 'public');
            $teacher->image = 'storage/' . $path;
        }

        $teacher->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
