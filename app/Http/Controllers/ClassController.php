<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
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
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
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
