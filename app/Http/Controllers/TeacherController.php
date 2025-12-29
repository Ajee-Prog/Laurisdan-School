<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,teacher']);
        // $this->middleware(['auth', 'role:teacher,admin']);
        // $this->middleware(['auth', 'role:student']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $teachers = Teacher::with(['class', 'parent'])->get();
        //  $teachers = Teacher::latest()->paginate(10);
        // $teachers = User::where('role','teacher')->paginate(20);
        $teachers = Teacher::with('class')->latest()->get();
        return view('teachers.index',compact('teachers'));
        // return view('students.index', compact('students'));
        // return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $teachers = Teacher::all();
        // $classes = SchoolClass::all();
        // $classes = Classroom::all();
        // return view('students.create', compact('parents','classes'));
        // return view('admin.teachers.create');
        $classes = SchoolClass::all();
        return view('teachers.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'nullable|email|unique:teachers',
            'phone'    => 'nullable',
            'subject'  => 'nullable|string',
            'class_id' => 'nullable|exists:classes,id',
            'address'  => 'nullable|string',
            'password' => 'required|min:6',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        /**  Check if user already exists */
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        // Create user only if not exists
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'teacher',
        ]);
    }
        

        // Upload image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('teachers', 'public');
        }

        Teacher::create([
            'user_id' => $user->id,
            'class_id' => $request->class_id,
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'subject'  => $request->subject,
            'address'  => $request->address,
            'image'    => $imagePath,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully');


//         $r->validate(['name'=>'required','email'=>'required|email|unique:users','password'=>'required|min:6']);
// $user = User::create(['name'=>$r->name,'email'=>$r->email,'password'=>Hash::make($r->password),'role'=>'teacher']);
// return redirect()->route('teachers.index')->with('success','Teacher added');





        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:teachers',
        //     'phone' => 'required',
        //     'address' => 'required',
            
        //     'password' => 'required|min:6',
        //     // 'phone' => 'required|string|max:20',
        //     // 'class_id' => 'required|exists:school_classes,id',
        //     // 'parent_id' => 'nullable|exists:parent_models,id',
        //     // 'address' => 'nullable|string',
        //     'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        // ]);




        // $user = User::create([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password),
        //         'role' => 'teacher'
        //         ]);

        // // if ($request->hasFile('passport')) {
        // //     $validated['passport'] = $request->file('passport')->store('students', 'public');
        // // }

        // $imagePath = $request->hasFile('image') ? 
        // $request->file('image')->store('teachers', 'public') : null;

        // // Student::create($validated);
        // Teacher::create([
        //     'user_id' => $user->id,
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'address' => $request->address,
        //     'class_id' => $request->class_id,
        //     // 'parent_id' => $request->parent_id,
        //     'subject'=>$request->subject,
        //     'image' => $imagePath,
        //     'password' => Hash::make($request->password)
        // ]);

        // return redirect()->route('teachers.index')->with('success', 'Teacher Registered successfully!');


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
        $teacher = Teacher::findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));

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
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:teachers,email,'.$teacher->id,
            'phone'     => 'required',
            'address'   => 'required',
            'image'     => 'nullable|image|max:2048',
        ]);

        $imagePath = $teacher->image;
        if ($request->hasFile('image')) {
            if ($teacher->image) Storage::disk('public')->delete($teacher->image);
            $imagePath = $request->file('image')->store('teachers', 'public');
        }

        $teacher->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'image'     => $imagePath,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $teacher = Teacher::findOrFail($id);
        if ($teacher->image) Storage::disk('public')->delete($teacher->image);
        $teacher->delete();
        return back()->with('success', 'Teacher deleted successfully.');

    }

    public function exportPDF(){
        $teachers = Teacher::all();
        $pdf = Pdf::loadView('admin.teachers.pdf', compact('teachers'));
        return $pdf->download('teachers-list.pdf');

    }
}
