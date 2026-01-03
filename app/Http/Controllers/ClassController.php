<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Request;


// use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::all();
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        return view('classes.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'teacher_id' => 'nullable',
            
        ]);

        SchoolClass::create($request->all());

        return redirect()->route('classes.index')->with('success', 'Class created successfully.');
    }

    public function edit(SchoolClass $class)
    {
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, SchoolClass $class)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class->update($request->all());
        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

//     
public function destroy(SchoolClass $class){
    $class->delete();
    return redirect()->route('classes.index')->with('success', 'Class deleted successfully.');
}


}
