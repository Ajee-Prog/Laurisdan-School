<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\Question;
use App\Models\ExamResult;
use App\Models\ClassModel;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Term;
// use Illuminate\Http\Request;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,teacher']);
        // $this->middleware('auth');
        // $this->middleware(['auth', 'role:parent,admin']);
    }
// public function __construct(){ $this->middleware(['auth', 'role:admin']); }
    
    public function toggleStatus($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->is_active = !$exam->is_active;
        $exam->save();

        return back()->with('success', 'Exam status updated');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = auth()->user()->student;

        $exams = Exam::with('class','term')->orderBy('exam_date','desc')->paginate(12);
        // $exams = Exam::with('class','term')->latest()->get();
        // return view('exams.index', compact('exams'));
        return view('admin.exams.index', compact('exams'));
        // check if the student already took the exam
        $alreadyTaken = ExamResult::where('student_id',$tudent->id)->where('subject', $subject)->exists();
        if($alreadyTaken){
            return redirect()->route('students.dashboard')->with('error', 'You have already taken this '.$subject.'exam.');
        }

        // Load 10 random questions
        $questions = Question::where('subject', $subject)
            ->inRandomOrder()
            ->take(10)
            ->get();

        // 40-minute duration in seconds
        $examDuration = 40 * 60;

        return view('students.exams.cbt', compact('questions','subject','examDuration'));


    }

    public function  submit(Request $request){
        $student = auth()->user()->student;
        $subject = $request->input('subject');
        $answers = $request->input('answers', []);
        $score = 0;

        // Prevent multiple submissions
        if (ExamResult::where('student_id',$student->id)->where('subject',$subject)->exists()) {
            // return redirect()->route('student.dashboard')->with('error', 'You already submitted this exam.');
            return redirect()->route('dashboard.student')->with('error', 'You already submitted this exam.');
        }

         foreach ($answers as $id => $ans) {
            $question = Question::find($id);
            if ($question && strtoupper(trim($question->correct_answer)) == strtoupper(trim($ans))) {
                $score += 1;
            }
        }

        $finalScore = $score * 10;

        ExamResult::create([
            'student_id' => $student->id,
            'subject' => $subject,
            'score' => $finalScore,
        ]);

         return redirect()->route('dashboard.student')->with('success', 'Exam submitted successfully! Score: '.$finalScore);




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $classes = SchoolClass::all();
        $terms = Term::all();
        return view('exams.create', compact('classes','terms'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $data = $r->validate([
            'title'=>'required|string|max:255',
        'class_id'=>'nullable|exists:classes,id',
        'term_id'=>'nullable|exists:terms,id',
        'exam_date'=>'nullable|date',
        'subject' => 'required|string',
    ]);
        Exam::create($data);
        return redirect()->route('exams.index')->with('success','Exam created.');

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
    public function edit(Exam $exam)
    {
        $classes = SchoolClass::all(); 
        $terms = Term::all(); 
        return view('exams.edit', compact('exam','classes','terms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, Exam $exam)
    {
         $data = $r->validate([
            'title'=>'required',
            'class_id'=>'nullable',
            'term_id'=>'nullable',
            'exam_date'=>'nullable|date'
        ]); 
        $exam->update($data); 
        return redirect()->route('exams.index')->with('success','Exam updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete(); return redirect()->route('exams.index')->with('success','Exam deleted.'); 
    }


    // New Exam.... Assign Exam to student
    public function assignToStudent($exam_id){
        $exam = Exam::findOrFail($exam_id);
        $students = Student::where('class_id', $exam_id)->get();

        foreach ($students as $student) {
            $exam->students()->syncWithoutDetaching([$student->id => ['status' => 'pending']]);
        }
        return back()->with('success', 'Exam assigned to all students in this class!');
    }
    

   
public function exportPdf(){
    $exams = Exam::with('class','term')->orderBy('exam_date','desc')->get();
        $pdf = PDF::loadView('exams.pdf', compact('exams'))->setPaper('a4','portrait');
        return $pdf->download('exams.pdf');
}


// teacher-specific listing
    public function teacherExams(){
        $user = Auth::user();
        // if teacher has teacher model relation, filter by teacher_id
        $exams = Exam::where('teacher_id', $user->id)->withCount('questions')->get();
        return view('teacher.exams.index', compact('exams'));
    }


public function studentExams($id)
{
    $student = Student::where('user_id', Auth::id())->first();
        if(!$student) abort(403, 'Student profile not found');
        $exams = Exam::where('class_id', $student->class_id)->get();
        // return view('student.exams.index', compact('exams'));




    // $exam = Exam::all();
    $exam = Exam::with('questions.options')->findOrFail($id);
    // return view('exams.student-list', compact('exams'));

    // Save exam start time
    session(['exam_'.$id.'_start_time' => now()]);
    return view('student-exam.cbt', compact('exam', 'exams'));
    // return view('student.exams.index', compact('exams'));

      

    
}


// list for students
    public function studentExamss()
    {
        $student = Student::where('user_id', Auth::id())->first();
        $exams = $student ? Exam::where('class_id', $student->class_id)->get() : collect();
        return view('student-exam.index', compact('exams'));
    }

    // view exam brief (not CBT page)
    public function studentExamView($id)
    {
        $exam = Exam::findOrFail($id);
        // return view('student-exam.exam', compact('exam'));
        return view('exams.student-exam', compact('exam'));
    }

/**
 * Load the exam page when a student clicks "Take Exam" (loads questions)
 */
// public function startExamCBT($id)
public function startExamCBT($examId)
{
    $student = Auth::guard('student')->user();
    $exam = Exam::findOrFail($examId);

    $result = ExamResult::firstOrCreate(
        [
            'student_id' => $student->id,
            'exam_id' => $exam->id
        ],
        [
            'started_at' => now()
        ]
    );

    // ❌ Already submitted
    if ($result->is_submitted) {
        return redirect()->route('student.exams')->with('error', 'You have already submitted this exam.');
    }

    //  Time expired
    $endTime = $result->started_at->addMinutes($exam->duration);
    if (now()->gt($endTime)) {
        $result->update([
            'is_submitted' => true,
            'submitted_at' => now()
        ]);

        return redirect()->route('student.exams')->with('error', 'Exam time elapsed.');
    }

    // return view('exams.cbt', compact('exam', 'result'));
    return view('students.cbt', compact('exam', 'result'));

    // $exam = Exam::with('questions')->findOrFail($id);

    // return view('exams.student-exam', compact('exam'));
    // return view('student-exam.exam', compact('exam'));
    // optional: verify student class matches exam->class_id
        // $student = Student::where('user_id', Auth::id())->first();

        /*
        This can also be used................

        if ($student && $exam->class_id && $student->class_id != $exam->class_id) {
            abort(403,'You cannot take this exam.');
        }
        // New add starts here to test it.......
         // Prevent re-entry
    $existing = ExamResult::where('exam_id', $exam->id)
        ->where('student_id', $student->id)
        ->first();

    if ($existing) {
        return redirect()->route('student.exams')
            ->with('error', 'You have already taken this exam.');
    }

    session([
        'exam_end_time' => now()->addMinutes($exam->duration)->timestamp
    ]);

    return view('students.cbt', compact('exam'));  */

        // return view('student-exam.cbt', compact('exam'));
}

// This inside ExamController
/*
    public function index(){ $exams = Exam::where('teacher_id', Auth::id())->with('class')->paginate(20); return view('teacher.exams.index', compact('exams')); }
public function create(){ $classes = ClassModel::where('teacher_id', Auth::id())->orWhereNull('teacher_id')->get(); return view('teacher.exams.create', compact('classes')); }
public function store(Request $r){ $r->validate(['title'=>'required','class_id'=>'nullable|exists:school_classes,id']); Exam::create(['title'=>$r->title,'teacher_id'=>Auth::id(),'class_id'=>$r->class_id,'duration'=>$r->duration]); return redirect()->route('exams.index')->with('success','Exam created'); }
public function show(Exam $exam){ $exam->load('questions.options'); return view('teacher.exams.show', compact('exam')); }
public function edit(Exam $exam){ $classes = ClassModel::all(); return view('teacher.exams.edit', compact('exam','classes')); }
public function update(Request $r, Exam $exam){ $exam->update($r->only(['title','class_id','duration','subject','term','session'])); return redirect()->route('exams.index')->with('success','Updated'); }
public function destroy(Exam $exam){ $exam->delete(); return back()->with('success','Deleted'); }
 */




// it inside ExamResultController

/* 

public function listAvailable(){
$student = Auth::user();
$classId = optional($student->studentProfile)->class_id;
$exams = Exam::where('class_id', $classId)->get();
return view('student.exams.list', compact('exams'));
}


public function startExam(Exam $exam){
$questions = $exam->questions()->with('options')->get()->shuffle();
return view('student.exams.start', compact('exam','questions'));
}


// public function submitExam(Request $r, Exam $exam){
// $studentId = Auth::id();
// $score = 0; $total = $exam->questions()->count();
// foreach($exam->questions as $q){ $given = $r->input('question_'.$q->id); if(!$given) continue; $opt = Option::find($given); if($opt && $opt->is_correct) $score++; }
// $result = ExamResult::create(['exam_id'=>$exam->id,'student_id'=>$studentId,'score'=>$score,'total_questions'=>$total]);
// return redirect()->route('student.results')->with('success','Exam submitted');
// }


public function myResults(){ $results = ExamResult::where('student_id', Auth::id())->with('exam')->get(); return view('student.exams.results', compact('results')); }


public function downloadPdf(ExamResult $result){ $pdf = Pdf::loadView('student.exams.result_pdf', compact('result')); return $pdf->download('result_'.$result->id.'.pdf'); }
*/

public function submitCBT(Request $request, $id)
{
    $exam = Exam::with('questions')->findOrFail($id);

    // $answers = $request->input('answers', []); // answers[question_id] => selected option (A/B/C/D)
    //     if (!is_array($answers)) $answers = [];

    $score = 0;

    foreach ($exam->questions as $question) {
        $answer = $request->input('question_'.$question->id);

        if ($answer == $question->correct_option_id) {
            $score++;
        }

        /* 
        $answers = $request->input('answers', []); // answers[question_id] => selected option (A/B/C/D)
        if (!is_array($answers)) $answers = [];

        $score = 0;

        foreach ($exam->questions as $question) {
            $qid = $question->id;
            $given = $answers[$qid] ?? null;
            // Adapt comparison to your schema; here assume correct option stored as 'answer' with values 'A'..'D'
            if ($given && strtolower($given) === strtolower($question->answer)) {
                $score++;
            } 
        }*/
    }

    return view('student-exam.result', [
        'exam'  => $exam,
        'score' => $score,
        'total' => $exam->questions->count(),
    ]);
}

//Submit exam answers
    public function submitExam(Request $request){

        $student = Auth::guard('student')->user();

        $result = ExamResult::where('student_id', $student->id)->where('exam_id', $request->exam_id)->firstOrFail();

//         if ($result->is_submitted) {
//     abort(403, 'Exam already submitted');
// }

        // ❌ Already submitted
    if ($result->is_submitted) {
        return redirect()->route('student.exams')->with('error', 'Exam already submitted.');
    }

    // ⏰ Time check
    $exam = Exam::findOrFail($request->exam_id);
    $endTime = $result->started_at->addMinutes($exam->duration);

    if (now()->gt($endTime)) {
        $result->update([
            'is_submitted' => true,
            'submitted_at' => now()
        ]);

        return redirect()->route('student.exams')->with('error', 'Time elapsed. Exam auto-submitted.');
    }

    // ✅ Mark answers & calculate score
    $score = 0; // calculate here

    $result->update([
        'score' => $score,
        'is_submitted' => true,
        'submitted_at' => now()
    ]);

    return redirect()->route('student.results')->with('success', 'Exam submitted successfully.');

// ================
        ExamResult::create([
        'student_id' => $student->id,
        'exam_id'    => $request->exam_id,
        'score'      => $score,
        'submitted_at' => now(),
    ]);
    // return redirect()->route('student.results')->with('success', 'Exam submitted successfully');

    /*

        if (!$request->exam_id) {
        abort(400, "Exam ID missing.");
    }

        $exam = Exam::with('questions')->findOrFail($request->exam_id);

        // Fix: if no answers submitted
            $answers = $request->answers ?? [];

            if (!is_array($answers)) {
                $answers = [];
            }
            
        $score = 0;


        foreach ($request->answers as $question_id => $answer) {
            $question = $exam->questions->find($question_id);
            if ($question && $question->answer == $answer) $score++;
        }

        return view('students.result', compact('score', 'exam'));

        */


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

}
