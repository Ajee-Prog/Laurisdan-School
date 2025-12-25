<?php

namespace App\Http\Controllers\Student;

use App\Helpers\AdmissionHelper;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\ClassModel;
use App\Models\ParentModel;
use App\Models\Question;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use App\Models\User;


class StudentController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['auth', 'role:admin,teacher']);
        $this->middleware(['auth', 'role:student']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with(['class', 'parent'])->paginate(10);
        return view('admin.students.index', compact('students'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Show form to create student
    public function create()
    {
        $classes = SchoolClass::all();
        $parents = ParentModel::all();
        
        $generatedAdmissionNo = AdmissionHelper::generateAdmissionNo();
     
        // return view('admin.students.create', compact('classes', 'generatedAdmissionNo', 'parents'));
        return view('students.create', compact('classes', 'generatedAdmissionNo', 'parents'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students',
            'phone' => 'required|string|max:20',
            'class_id' => 'required|exists:school_classes,id',
            'parent_id' => 'nullable|exists:parent_models,id',
            'address' => 'nullable|string',
            'passport' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);


        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('students', 'public');
        }


        // if ($request->hasFile('passport')) {
        //     $validated['passport'] = $request->file('passport')->store('students', 'public');
        // }

         $admissionNo = AdmissionHelper::generateAdmissionNo();

                $user = User::create([
                    'name'         => $request->name,
                    'admission_no' => $admissionNo,
                    'password'     => bcrypt($request->password),
                    'role_id'      => 'student', // student
                ]);

        // Student::create($validated);
        // Student::create($validated);
        Student::create([
            'user_id' => $user->id,
            'class_id' => $request->class_id,
            'parent_id' => $request->parent_id,
            'admission_no' => $request->admission_no,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'state' => $request->state,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'parent_contact' => $request->parent_contact,
            'religion' => $request->religion,
            'image' => $image
        ]);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::with(['class', 'parent'])->findOrFail($id);
        return view('admin.students.show', compact('student'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $classes = SchoolClass::all();
        $parents = ParentModel::all();
        return view('admin.students.edit', compact('student', 'classes', 'parents'));

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
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:20',
            'class_id' => 'required|exists:school_classes,id',
            'parent_id' => 'nullable|exists:parent_models,id',
            'address' => 'nullable|string',
            'passport' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('passport')) {
            if ($student->passport) {
                Storage::disk('public')->delete($student->passport);
            }
            $validated['passport'] = $request->file('passport')->store('students', 'public');
        }

        $student->update($validated);
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');


    }

    public function exam(Request $request)
{
    $questions = Question::with('options')
        ->where('session_id', $request->session_id)
        ->where('term_id', $request->term_id)
        ->where('subject_id', $request->subject_id)
        ->inRandomOrder()
        ->limit(10)
        ->get();

    return view('students.exam', compact('questions'));
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        if ($student->passport) {
            Storage::disk('public')->delete($student->passport);
        }
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted.');

    }

    // Export all students to PDF
    public function exportPdf()
    {
        $students = Student::with('class')->get();
        $pdf = Pdf::loadView('admin.students.pdf', compact('students'));
        return $pdf->download('students_list.pdf');
    }

    // Student dashboard view

public function dashboard(){
    $student = auth()->user()->student; // assuming 1:1 with User
        $exams = $student->examResults()->latest()->take(5)->get();
        return view('student.dashboard', compact('student', 'exams'));
}


}
