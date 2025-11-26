<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = User::where('role', 'teacher')->get();
        // return view('admin.teachers.index', compact('teachers'));
        // $myClasses = ClassModel::count();
        $teachers = Teacher::all();
        return view('admin.teachers.index', compact('teachers, myClasses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:6',
        // ]);

        // $data['password'] = Hash::make($data['password']);
        // $data['role'] = 'teacher';

        // User::create($data);
        // return redirect()->route('admin.teachers.index')->with('success', 'Teacher registered successfully!');
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:teachers',
            'password'=>'required|min:6',
            'subject'=>'nullable|string'
        ]);
        $data['password'] = Hash::make($data['password']);
        Teacher::create($data);
        return redirect()->route('teachers.index')->with('success','Teacher added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Teacher deleted!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
