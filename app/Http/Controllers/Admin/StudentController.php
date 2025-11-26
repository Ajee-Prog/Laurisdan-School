<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::where('role', 'student')->get();
        // return view('admin.students.index', compact('students'));
        // $students = Student::latest()->get();
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.students.create');
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
        // $data['role'] = 'student';

        // User::create($data);
        // return redirect()->route('admin.students.index')->with('success', 'Student registered successfully!');
    //     $data = $request->validate([
    //     'name'  => 'required|string|max:255',
    //     'email' => 'required|email|unique:students',
    //     // 'dob'=>'nullable|date',
    //     'date_of_birth' => 'nullable|date',
    //     'admission_no' => 'nullable',
    //     'gender' => 'required',
    //     'state' => 'required',
    //     'nationality' => 'required',
    //     'phone' => 'required',
    //     'address' => 'required|string|max:255',
    //     'parent_contact' => 'required',
    //     'religion' => 'required',
    //         // 'photo'=>'nullable|image|max:2048',
    //     'class_id' => 'required|exists:school_classes,id',
    //     'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    // ]);

    // // $data = $request->all();

    // if ($request->hasFile('image')) {
    //     $file = $request->file('image');
    //     $filename = time() . '_' . $file->getClientOriginalName();
    //     $file->move(public_path('uploads/students'), $filename);
    //     $data['image'] = 'uploads/students/' . $filename;
    // }

    // $user = User::create([
    //      'name'  => $data['name'],
    //      'email'  => $data['email'],
    //      'password'  => Hash::make($data['password']),
    //      'role'  => 'student',
    // ]);

    // Student::create([
    //     'user_id'=>$user->id,
    //     'student_code'=>'S'.time(),
    //     'date_of_birth'=>$data['date_of_birth'] ?? null,
    //     'class_id'=>$data['class_id'] ?? null,
    //     'admission_no'=>$data['admission_no'] ?? null,
    //     'gender'=>$data['gender'] ?? null,
    //     'nationality'=>$data['nationality'] ?? null,
    //     'phone'=>$data['phone'] ?? null,
    //     'address'=>$data['address'] ?? null,
    //     'parent_contact'=>$data['parent_contact'] ?? null,
    //     'religion'=>$data['religion'] ?? null,
    //     // $data
    // ]);
        

    // return redirect()->route('admin.students.index')->with('success', 'Student added successfully.');

    $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:students,email',
            'password' => 'required|string|min:6',
            'class_id' => 'nullable|integer',
        ]);

        $student = Student::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'class_id' => $request->class_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Student registered successfully!');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        User::findOrFail($id)->delete();
    return back()->with('success', 'Student deleted!');
    }
}
