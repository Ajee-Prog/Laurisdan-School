<?php

namespace App\Http\Controllers;

use App\Helpers\AdmissionHelper;
use App\Models\Book;
use App\Models\Student;
use App\Models\ParentModel;
use App\Models\SchoolClass;
// use App\Models\ClassModel;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use App\Models\SessionModel;
use App\Models\Term;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


// use App\Models\Student;

// use Illuminate\Http\Request;


// use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['auth', 'role:admin,teacher']);
        $this->middleware(['auth', 'role:admin,student']);
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $student = Auth::user()->student;
        // $students = Student::with(['parentModel','class'])->get();
        // return view('students.dashboard', compact('student'));

        //  $students = Student::with(['class', 'parent'])->paginate(10);
        $users = User::paginate(20);
        // $students = Student::with('user', 'class')->paginate(20);
        $students = Student::with('user', 'class')->get();
        return view('students.index', compact('students'));

        //  $students = Student::with(['class', 'parent'])->get();
        // return view('students.index', compact('students'));
        // return view('admin.students.index', compact('students'));


    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $parents = ParentModel::all();
        $classes = \App\Models\SchoolClass::all();
        // $classes = Classroom::all();
        
        $generatedAdmissionNo = AdmissionHelper::generateAdmissionNo();
        
        return view('students.create', compact('parents','classes', 'generatedAdmissionNo'));
        // return view('admin.students.create', compact('classes','parents', 'generatedAdmissionNo'));

        

        //  $classes = ClassModel::all();
        // $parents = ParentModel::all();
        // return view('admin.students.create', compact('classes', 'parents'));


    }


    // -----------==============------------
    private function generateAdmissionNo()
{
    return 'LNPS-' . date('Y') . '-' . rand(1000, 9999);
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $admissionNo = $this->generateAdmissionNo();
        // Neww simple Store save start
        /*

        $data = $request->validate([
            'admission_no'   => 'required|unique:students,admission_no',
            'student_code'   => 'required|unique:students,student_code',
            'first_name'     => 'required',
            'last_name'      => 'required',
            'middle_name'    => 'required',
            'date_of_birth'  => 'required|date',
            'place_birth'    => 'required',
            'gender'         => 'required',
            'password'       => 'required',
            'class_id'       => 'nullable',
            'parent_id'      => 'nullable',
            'state'          => 'required',
            'lga'            => 'required',
            'nationality'    => 'required',
            'address'        => 'required',
            'medical_Att'    => 'required',
            'parent_contact' => 'required',
            'religion'       => 'required',
            'image'          => 'required|image|max:2048',
        ]);
    
        // Upload image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('students', 'public');
        }

        
    
        // Hash password
        $data['password'] = Hash::make($data['password']);
    
        Student::create($data);  */

        
    
        // Neww store ends

        $validatedData = $request->validate([
            'admission_no'   => 'required|unique:students,admission_no',
            'student_code'   => 'required|unique:students,student_code',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'date_of_birth' => 'required|date',
            'place_birth' => 'nullable|string',
            // 'student_code' => 'nullable|string',
            'gender' => 'required|string',
            // 'admission_no' => 'required',
            // 'phone' => 'required|string|max:20',
            'lga' => 'required|string|max:20',
            'state' => 'required',
            'nationality' => 'required',
            'religion' => 'required',
            'parent_contact' => 'required',
            'class_id' => 'required|exists:classes,id',
            'parent_id' => 'nullable|exists:parents,id',
            'address' => 'nullable|string',
            'medical_Att' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // $user = User::create([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password),
        //         'role' => 'student'
        //         ]);

        // state
        // Upload image
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('students', 'public');
        }

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);
        
        Student::create($validatedData);
        

        // $image = null;
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image')->store('students', 'public');
        // }
        
        
        // ENDS

        

        // $admissionNo = $this->generateAdmissionNo();

    //     $year = date('Y');
    // $count = Student::whereYear('created_at', $year)->count() + 1;

    // $admissionNo = "LNPS/$year/" . str_pad($count, 4, '0', STR_PAD_LEFT);

    

        // Student::create($validated);

        // THis was first Start here..
       /* Student::create([
            'user_id' => $user->id,
            'class_id' => $request->class_id,
            'parent_id' => $request->parent_id,
            // 'admission_no' => $request->admission_no,

            'admission_no' => $admissionNo,
            'student_code' => $request->student_code,
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'middle_name'    => $request->middle_name,
            'lga'    => $request->lga,
            // 'password' => bcrypt($admissionNo), // default password
            'password' => Hash::make($request->password),

            'date_of_birth' => $request->date_of_birth,
            'place_birth' => $request->place_birth,
            'gender' => $request->gender,
            // 'phone' => $request->phone,
            'state' => $request->state,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'medical_Att' => $request->medical_Att,
            'parent_contact' => $request->parent_contact,
            'religion' => $request->religion,
            'image' => $image
        ]);   
        
        */
        // This was first ENDs here..
   

        // return redirect()->route('admin.students.index')->with('success', 'Student Registered successfully!');
   
        // Student::create($request->all());
        return redirect()->route('students.index')->with('success','Student added successfully');

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
    public function edit(Student $student)
    {
        //  $parents = ParentModel::all();
        // $classes = ClassModel::all();
        // return view('students.edit', compact('student','parents','classes'));

        $student = Student::findOrFail($student);
        $classes = \App\Models\SchoolClass::all();
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
            // 'class_id' => 'required|exists:school_classes,id',
            'class_id' => 'required|exists:classes,id',
            'parent_id' => 'nullable|exists:parent_models,id',
            'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);


        $user = $student->user;
                $user->update(['name' => $request->name, 'email' => $request->email]);



                // if ($request->hasFile('photo')) {
                // if ($student->photo) Storage::disk('public')->delete($student->photo);
                // $student->photo = $request->file('photo')->store('students', 'public');
                // }


                // $student->update([
                //                     'class_id' => $request->class_id, 
                //                     'admission_no' => $request->admission_no, 
                //                     'dob' => $request->dob, 
                //                     'gender' => $request->gender
                //                 ]);





         if ($request->hasFile('image')) {
                    if ($student->image) {
                        Storage::disk('public')->delete($student->image);
                    }
            $validated['image'] = $request->file('image')->store('students', 'public');
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
    public function destroy(Student $student)
    // public function destroy($id)
    {
        // $student->delete();
        // return redirect()->route('students.index')->with('success','Student deleted');

        // $student = Student::findOrFail($id);
        // if ($student->image) {
        //     Storage::disk('public')->delete($student->image);
        // }
        // $student->delete();
        // return redirect()->route('students.index')->with('success', 'Student deleted.');

        if ($student->image) Storage::disk('public')->delete($student->image);
        $user = $student->user;
        $student->delete();
        if ($user) $user->delete();
        return back()->with('success', 'Deleted');


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
            return view('students.dashboard', compact('student', 'exams'));
    }


    //Show Exam all questions
    public function exam($examId){
        // $questions = Question::with('options')->inRandomOrder()->get(); //10 Random questions... 
        // return view('students.exam', compact('questions'));


        $student = Student::where('user_id', Auth::id())->first();

        if (!$student) {
        abort(403, 'Student not found.');
    }

        $exam = Exam::with('questions')->findOrFail($examId);

        // Optional: check student class matches exam class
        if ($exam->class_id != $student->class_id) {
            abort(403, 'You are not allowed to take this exam.');
        }

        $questions = $exam->questions;

        // Pass exam duration from the DB or set default (in seconds)
        $examDuration = $exam->duration * 60; // assuming duration is in minutes

         $exams = Exam::where('class_id', $student->class_id)->get();

        return view('students.exam', compact('student', 'exam','exams', 'questions', 'examDuration'));


        // $exams = Exam::where('class_id', $student->class_id)->get();
        // return view('students.exam', compact('exams'));
    }


    // List all the exams , then pass the id by selecting 1

    public function examList()
{
    $student = Student::where('user_id', auth()->id())->first();
    $exams = Exam::where('class_id', $student->class_id)->get();
    return view('students.exam-list', compact('exams'));
}



    public function startExam($subject){
            $exam = Exam::where('title', $subject)->firstOrFail();
            $questions = $exam->questions;
            return view('student.take-exam', compact('exam','questions'));
    }

    //Submit exam answers
    public function submitExam(Request $request){

        $exam = Exam::with('questions')->findOrFail($request->exam_id);
        $score = 0;


        foreach ($request->answers as $question_id => $answer) {
            $question = $exam->questions->find($question_id);
            if ($question && $question->answer == $answer) $score++;
        }

        return view('students.result', compact('score', 'exam'));




        // $total = count($request->answers ?? []);

        // if ($request->answers) {
        //     foreach ($request->answers as $question_id => $option_id) {
        //         $option  =  Option::find($option_id);

        //         if ($option && $option->is_correct) {
        //             $score++;
        //         }
        //     }
        // }
        // return view('students.result', compact('score', 'total'));

        // foreach ($request->answers as $question_id => $answer){
        //     $question = Question::find($question_id);
        //     if ($question->answer == $answer) $score++;
        //     }
        //     return view('student.exam-result', compact('score'));
    }


    public function books()
{
    $student = Student::where('user_id', Auth::id())->first();

    $books = Book::where('class_id', $student->class_id)->get();

    return view('students.books', compact('books', 'student'));
}


public function results(Request $request)
{
    // Get the logged-in user’s student profile
    $student = Student::where('user_id', Auth::id())->first();

    // If no student profile found, stop here
    if (!$student) {
        return redirect()->route('dashboard')->with('error', 'Student profile not found.');
    }

    $query = Exam::where('class_id', $student->class_id);

    

    // $results = DB::table('exam_results')
    //     ->where('student_id', $student->id)
    //     ->orderBy('created_at', 'desc')
    //     ->get();


    // Filter by session (optional)
    if($request->session_id) {
        $query->where('session_id', $request->session_id);
    }

    // Filter by term (optional)
    if($request->term_id) {
        $query->where('term_id', $request->term_id);
    }


    // Get matching exams
    $results = $query->get(); // Or join with scores table if exists

    // Load dropdown data
    $sessions = SessionModel::all();
    $terms = Term::all();

    
    return view('students.result', compact('student','results','sessions','terms'));
}





}
