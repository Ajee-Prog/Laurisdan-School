<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Student;

use App\Models\ClassModel;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\PDF;

class TeacherController extends Controller
{
    public function __construct(){ $this->middleware('auth'); }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Auth::user();
        $teachers = Teacher::with('user')->paginate(12);
        $students = Student::where('class_id', $teacher->teacher->class_id ?? null)->count();
        $classes = ClassModel::count();

        return view('teachers.index', compact('teachers', 'students', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'subject' => 'required|string|max:255',
            'user_id' => 'required|exists:users, id',
            'address' => 'required|string|max:255',
            'class_id' => 'required|exists:classes, id',
            'employee_no' => 'nullable',
            'phone' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpj,jpeg,png|max:2048',
        ]);
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt('password'),
            'role' => 'teacher'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/students/'),$filename);
            $data['image'] = 'uploads/students/'.$filename;
        }

        Teacher::create([
            'user_id' => $user->id,
            'employee_no' => $data['employee_no'] ?? null,
            'phone' => $data['phone'] ?? null,
            'subject' => $data['subject'] ?? null,
            'address' => $data['address'] ?? null
        ]);


        // $data = $request->all();

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $filename = time().'_'.$file->getClientOriginalName();
        //     $file->move(public_path('uploads/students/'),$filename);
        //     $data['image'] = 'uploads/students/'.$filename;
        // }

        // Student::create($data);
        return  redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
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
    public function edit(Teacher $teacher)
    {
         return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, Teacher $teacher)
    {
        $data = $r->validate(['employee_no'=>'nullable','phone'=>'nullable']); 
        $teacher->update($data); 
        return redirect()->route('teachers.index')->with('success','Teacher updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
         if($teacher->user) $teacher->user->delete(); 
         $teacher->delete(); 
         return redirect()->route('teachers.index')->with('success','Teacher deleted.');
    }

    
    public function exportPdf(){
        $teachers = Teacher::with('user')->get(); 
        $pdf = PDF::loadView('teachers.pdf', compact('teachers'))->setPaper('a4','portrait'); 
        // PDF::loadView('teachers.pdf', compact('teachers'));
        return $pdf->download('teachers.pdf');
    }

    public function dashboard(){
        return view('teacher.dashboard');
    }

}
