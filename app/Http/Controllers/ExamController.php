<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\Question;
use App\Models\ExamResult;
use App\Models\ClassModel;
use App\Models\SchoolClass;
use App\Models\SessionModel;
use App\Models\Student;
use App\Models\Term;
use Carbon\Carbon;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class ExamController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'role:admin,teacher']);
        // $this->middleware('auth');
        $this->middleware(['auth', 'role:admin,student']);
        // $this->middleware(['auth', 'role:parent,admin']);
        // $this->middleware(['auth', 'role:admin']);
    }
// public function __construct(){ $this->middleware(['auth', 'role:admin']); }

    public function toggleStatus($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->is_active = !$exam->is_active;
        $exam->save();

        return back()->with('success', 'Exam status updated');
    }


    public function index()
    {
        $student = auth()->user()->student;

        $exams = Exam::with('class','term')->orderBy('exam_date','desc')->paginate(12);
        // $exams = Exam::with('class','term')->latest()->get();
        return view('exams.index', compact('exams'));
        // return view('admin.exams.index', compact('exams'));
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

    /*public function  submit(Request $request){
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




    }*/


    public function create()
    {
        //  $classes = Session::all();
         $classes = SchoolClass::all();
        $terms = Term::all();
        return view('exams.create', compact('classes','terms'));

    }


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
        return redirect()->route('admin.exams.index')->with('success','Exam created.');

    }


    public function show($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);
        return view('exams.show', compact('exam'));
    }


    public function edit(Exam $exam)
    {
        $classes = SchoolClass::all();
        $terms = Term::all();
        return view('exams.edit', compact('exam','classes','terms'));
    }


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


    public function destroy(Exam $exam)
    {
        $exam->delete(); return redirect()->route('admin.exams.index')->with('success','Exam deleted.');
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


/*public function studentExams($id)
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




}*/


// // list for students
    public function studentExamss()
    {
        $student = Student::where('user_id', Auth::id())->first();
        $exams = $student ? Exam::where('class_id', $student->class_id)->get() : collect();
        // return view('student-exam.index', compact('exams'));
        return view('students.exams.list', compact('exams', 'student'));
    }

    // view exam brief (not CBT page)
    public function studentExamView($id)
    {
        $exam = Exam::findOrFail($id);
        $exam = Exam::with('questions')->findOrFail($id);
        // return view('student-exam.exam', compact('exam'));
        return view('exams.student-exam', compact('exam'));
        // return view('students.exams.list', compact('exam'));

    }


    // Start CBT Exam Used Start here****************************
    public function startExamCBT($examId)
    {
        $exam = Exam::with('questions')->findOrFail($examId);

        $user = auth()->user();
        // dd(auth()->user());

        if (!$user || $user->role !== 'student') {
            abort(403, 'Unauthorized USER');
        }

        $student = $user->student;

        if (!$student) {
            abort(403, 'Student profile not found');
        }

        $exam = Exam::with('questions')
            ->where('id', $examId)
            ->where('class_id', $student->class_id)
            ->where('is_active', 1)
            ->firstOrFail();

            // Check if already submitted
        $existing = ExamResult::where('exam_id', $exam->id)
            ->where('student_id', $student->id)
            ->first();

        if ($existing && $existing->is_submitted) {
            return redirect()->route('student.exams')
                ->with('error', 'You already submitted this exam.');
        }
        // *************************************

        // Ensure exam belongs to student class
        if ($exam->class_id && $student->class_id != $exam->class_id) {
            abort(403, 'Exam not assigned to your class');
        }

        $result = ExamResult::firstOrCreate(
            [
                'student_id' => $student->id,
                'exam_id'    => $exam->id,
            ],
            [
                'started_at' => now(),
            ]
        );

        // if ($result->is_submitted) {
        //     return redirect()->route('student.exams')
        //         ->with('error','You already submitted this exam.');
        // }

        $endTime = Carbon::parse($result->started_at)
            ->addMinutes($exam->duration);

        if (now()->gt($endTime)) {
            $result->update([
                'is_submitted' => true,
                'submitted_at' => now()
            ]);

            return redirect()->route('student.exams')
                ->with('error','Exam time elapsed.');
        }

        return view('students.exams.start', [
            'exam' => $exam,
            'questions' => $exam->questions,
            'endTime' => $endTime,
            'result' => $result
        ]);
    }
    // Start Exam CBT Used Ends here***************************



// public function downloadPdf(ExamResult $result){ $pdf = Pdf::loadView('student.exams.result_pdf', compact('result')); return $pdf->download('result_'.$result->id.'.pdf'); }
// */

private function grade($score)
{
    if ($score >= 70) return 'A';
    if ($score >= 60) return 'B';
    if ($score >= 50) return 'C';
    if ($score >= 45) return 'D';
    if ($score >= 40) return 'E';
    return 'F';
}


// New Submit Exam start here***********************************

public function submitExam(Request $request, $examId)
{
    $user = auth()->user();

    if (!$user || $user->role !== 'student') {
        abort(403);
    }

    $student = $user->student;



    $exam = Exam::with('questions')
        ->findOrFail($request->exam_id);

    $result = ExamResult::where('student_id', $student->id)
        ->where('exam_id', $exam->id)
        ->firstOrFail();

    if ($result->is_submitted) {
        return redirect()->route('student.exams')
            ->with('error','Exam already submitted.');
    }

    $score = 0;

    foreach ($exam->questions as $question) {
        $answer = $request->input('question_'.$question->id);

        if ($answer === $question->correct_option) {
            $score++;
        }
    }

    // New added
    $examScore = $score;
    // $testScore = $existing->test_score ?? 0;
    $testScore = $result->test_score ?? 0;

    $total = $examScore + $testScore;
    $percentage = $total; // assuming over 100
    // New added ended
// ///////////////////////////

// ///////////////////////////
    // $result->update([
    $result->updateOrCreate([
            'student_id' => $student->id,
            'exam_id' => $examId
    ],[
        // 'score' => $score,
        // 'is_submitted' => true,
        // 'submitted_at' => now()
        'exam_score' =>$examScore,
        'test_score' => $testScore,
        'total_score' => $total,  //Temporary (will be updated later)
        'percentage' => $percentage,
        'grade' => $this->grade($percentage),
        'is_submitted' => true,
        'submitted_at' => now()
    ]);

    // return redirect()->route('student.exams')
    //     ->with('success','Exam submitted. Score: '.$score);

        return view('students.result', compact('score','exam', 'student'));
}


        public function results()
        {
            $student = auth()->user()->student;

            $result = ExamResult::where('student_id', $student->id)->latest()->first();
            $sessions = SessionModel::all();

            return view('students.result', [
                'score' => $result->score ?? 0,
                'exam' => $result->exam ?? null,
                'sessions' => $sessions

            ]);
        }

        // Admin Generate exam code for student CBT

        public function generateCode($id)
        {
            $exam = \App\Models\Exam::findOrFail($id);

            $exam->access_code = strtoupper(substr(md5(time()), 0, 6)); // e.g 6-digit code
            $exam->save();

            return back()->with('success', 'Access code generated: '.$exam->access_code);
        }

        // Show Student Form for Code Generate
        public function showAccessForm($id)
        {
            $exam = \App\Models\Exam::findOrFail($id);

            return view('students.exams.access_code', compact('exam'));
        }

        // Verify Generated access Code
        public function verifyAccess(Request $request)
        {
            $exam = \App\Models\Exam::findOrFail($request->exam_id);
            $student = auth()->user()->student;

            //  Check access code
            if ($request->access_code !== $exam->access_code) {
                return back()->withErrors(['access_code' => 'Invalid access code']);
            }

            //  Check school fees (VERY IMPORTANT)
            if ($student->fee_status !== 'paid') {
                return back()->withErrors(['access_code' => 'You must pay school fees before taking exam']);
            }

            //  Allow access
            return redirect()->route('student.exams.start', $exam->id);
        }




        // New eam result for students
        /*
        public function viewMyResult(Request $request)
        {
            $student = auth()->user()->student;

            $results = \App\Models\ExamResult::with([
                'student.class',
                'exam',
                'session',
                'term',
                'teacher'
            ])
            ->where('student_id', $student->id)
            ->where('session_id', $request->session_id)
            ->where('term_id', $request->term_id)
            ->get();

            if ($results->isEmpty()) {
                return back()->with('error', 'No result found');
            }

            $total = $results->sum('score');
            $count = max($results->count(), 1);
            $percentage = $total / $count;

            return view('students.student_results', [
                'student' => $student,
                'results' => $results,
                'total_score' => $total,
                'percentage' => round($percentage, 2),
                'grade' => $this->getGrade($percentage),
                'overall_grade' => $this->getGrade($percentage),
            ]);
        } */

}
