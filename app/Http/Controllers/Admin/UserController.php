<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\ParentModel;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index()
    {
        // $users = User::where('role', '!=', 'admin')->get();
        $users = User::paginate(20);
        // $users = User::orderBy('id', 'desc')->paginate(10);
        
        return view('admin.users.index', compact('users'));

    }

    public function create()
    {
         $classes = SchoolClass::all();
        $parents = ParentModel::all();
        return view('admin.users.create', compact('classes', 'parents'));

    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6| confirmed',
            'role' => 'required|in:superadmin,admin,teacher,student,parent',
            'class_id' => 'nullable|exists:classes,id',
            'parent_id' => 'nullable|exists:parents,id',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make( $data['password'] ),
            'role' => $data['role'],
        ]);

        // Handle role-based records
    switch ($data['role']) {
        case 'student':
            \App\Models\Student::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'class_id' => $data['class_id'] ?? null,
                'parent_id' => $data['parent_id'] ?? null,
            ]);
            break;

        case 'teacher':
            \App\Models\Teacher::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            break;

        case 'parent':
            \App\Models\ParentModel::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            break;
    }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

   
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
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted');

    }
}
