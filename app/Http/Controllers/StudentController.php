<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ParentModel;
use App\Models\ClassModel;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


// use App\Models\Student;

// use Illuminate\Http\Request;


// use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,teacher']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Auth::user()->student;
        // $students = Student::with(['parentModel','class'])->get();
        // return view('students.dashboard', compact('student'));

         $students = Student::with(['class', 'parent'])->paginate(10);
        return view('students.index', compact('students'));


    }

    //Show Exam all questions
    public function exam(){
        $questions = Question::with('options')->inRandomOrder()->get(); //10 Random questions... 
        return view('student.exam', compact('questions'));
    }

    //Submit exam answers
    public function submitExam(Request $request){
        $score = 0;
        $total = count($request->answers ?? []);

        if ($request->answers) {
            foreach ($request->answers as $question_id => $option_id) {
                $option  =  Option::find($option_id);

                if ($option && $option->is_correct) {
                    $score++;
                }
            }
        }
        return view('student.result', compact('score', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = ParentModel::all();
        $classes = ClassModel::all();
        return view('students.create', compact('parents','classes'));

        //  $classes = ClassModel::all();
        // $parents = ParentModel::all();
        // return view('admin.students.create', compact('classes', 'parents'));


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
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('passport')) {
            $validated['passport'] = $request->file('passport')->store('students', 'public');
        }

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');



        // $request->validate([
        //     'full_name' => 'required',
        //     'student_code' => 'required|unique:students',
        //     'parent_id' => 'required',
        //     'class_id' => 'required'
        // ]);

        // Student::create($request->all());
        // return redirect()->route('students.index')->with('success','Student added successfully');

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
        //  $parents = ParentModel::all();
        // $classes = ClassModel::all();
        // return view('students.edit', compact('student','parents','classes'));

        $student = Student::findOrFail($id);
        $classes = ClassModel::all();
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
        // $student->update($request->all());
        // return redirect()->route('students.index')->with('success','Student updated successfully');
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:20',
            'class_id' => 'required|exists:school_classes,id',
            'parent_id' => 'nullable|exists:parent_models,id',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Student $student)
    public function destroy($id)
    {
        // $student->delete();
        // return redirect()->route('students.index')->with('success','Student deleted');

        $student = Student::findOrFail($id);
        if ($student->passport) {
            Storage::disk('public')->delete($student->passport);
        }
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted.');


    }

     public function exportPdf()
    {
        $students = Student::with('class')->get();
        $pdf = Pdf::loadView('admin.students.pdf', compact('students'));
        return $pdf->download('students_list.pdf');
    }


public function dashboard(){
    $student = auth()->user()->student; // assuming 1:1 with User
        $exams = $student->examResults()->latest()->take(5)->get();
        return view('student.dashboard', compact('student', 'exams'));
}


}
