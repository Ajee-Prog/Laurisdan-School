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
use App\Models\Subject;
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
         $sessions = SessionModel::all();
         $classes = SchoolClass::all();
        $terms = Term::all();
        $subjects = Subject::all(); //ADD
        return view('exams.create', compact('classes','terms', 'sessions', 'subjects'));

    }


    public function store(Request $r)
    {
        $data = $r->validate([
            'title'=>'required|string|max:255',
        'class_id'=>'nullable|exists:classes,id',
        'term_id'=>'required|exists:terms,id',
        'session_id'=>'nullable|exists:sessions,id',
        'subject_id'=>'nullable|exists:subjects,id',

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
        $sessions = SessionModel::all();
        return view('exams.edit', compact('exam','classes','terms', 'sessions'));
    }


    public function update(Request $r, Exam $exam)
    {
         $data = $r->validate([
            'title'=>'required',
            'class_id'=>'nullable',
            'term_id'=>'nullable',
            'session_id'=>'nullable',
            'subject_id'=>'nullable',
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
                'subject_id' => $exam->subject_id, // ✅ FIX HERE
                'term_id' => $exam->term_id,
                'session_id' => $exam->session_id,

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

// public function submitExam(Request $request, $examId)
public function submitExam(Request $request)
{
    $examId = $request->exam_id; //get from form
    $user = auth()->user();

    if (!$user || $user->role !== 'student') {
        abort(403);
    }

    $student = $user->student;



    // $exam = Exam::with('questions')->findOrFail($request->exam_id);
    $exam = Exam::with(['questions','term'])->findOrFail($request->exam_id);
    $term = $exam->term;


        // Convert to exam score (e.g out of 60)
    // $examScore = ($score / $totalQuestions) * 60; //New added

    $result = ExamResult::where('student_id', $student->id)
        ->where('exam_id', $exam->id)
        ->firstOrFail();

    if ($result->is_submitted) {
        return redirect()->route('student.exams')
            ->with('error','Exam already submitted.');
    }

    $score = 0;
    // $totalQuestions = $exam->questions()->count();
    $answers = $request->answers ?? [];


    foreach ($exam->questions as $question) {
        $answer = $request->input('question_'.$question->id);
        // New
        $studentAnswer = $answers[$question->id] ?? null;

        if (!$studentAnswer) continue;

        // ✅ MCQ
        if ($question->type == 'mcq') {
            if ($studentAnswer == $question->correct_option) {
                $score++;
            }
        }

        // ✅ FILL-IN-THE-GAP
        if ($question->type == 'fill') {

            $correct = strtolower(trim($question->correct_answer));
            // $student = strtolower(trim($studentAnswer));
            $studentAnswerFormatted = strtolower(trim($studentAnswer));

            // if ($correct == $student) {
            if ($correct == $studentAnswerFormatted) {
                $score++;
            }
        }
        // end new

        // if ($answer === $question->correct_option) {
        //     $score++;
        // }
    }

    // New added
    $results = ExamResult::with(['exam.subject'])
        ->where('student_id', $student->id)
        ->get();
    $examScore = $score;
    $totalQuestions = $exam->questions()->count();
    // Convert to exam score (e.g out of 60)
    $examScore = ($score / $totalQuestions) * 60; //New add
    // $testScore = $existing->test_score ?? 0;
    $testScore = $result->test_score ?? 0;

    // $total = $examScore + $testScore;
    $totalScore = $examScore + $testScore;
    // $percentage = $total; // assuming over 100
    $percentage = $totalScore; // since total is 100 //New calculation

    $grade = $this->grade($percentage);
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
        'exam_score' =>round($examScore),
        'test_score' => $testScore,
        // 'total_score' => $total,  //Temporary (will be updated later)
        // 'total_score' => round($totalScore),  //Permanent (will be updated later, No)
        'total' => round($totalScore),  //Permanent (will be updated later, No)
        'percentage' => round($percentage),
        // 'grade' => $this->grade($percentage),
        'grade' => $grade,
        'is_submitted' => true,
        'submitted_at' => now()
    ]);

    // return redirect()->route('student.exams')
    //     ->with('success','Exam submitted. Score: '.$score);
    $groupedResults = collect($results)->groupBy('term_id');

        // return view('students.result', compact('score','exam', 'student', 'results', 'examScore', 'testScore','totalQuestions', 'totalScore'));
        return view('students.result', compact('exam', 'term', 'groupedResults', 'percentage', 'grade', 'student', 'results', 'examScore', 'testScore','totalQuestions', 'totalScore'));
}

// New exam controller to clean start here
public function results(Request $request)
{
    $student = auth()->user()->student;

    if (!$student) {
        return back()->with('error', 'Student not found');
    }

    // $results = ExamResult::with(['term', 'subject'])
    //     ->where('student_id', auth()->id()) // ✅ THIS IS KEY
    //     ->get();
    $results = ExamResult::with(['term', 'subject'])
        ->where('student_id', $student->id) // ✅ FIXED HERE
        ->get();


    // dd($results); // 🔥 SHOULD NOW SHOW DATA

    $groupedResults = $results->groupBy('term_id');

    $terms = Term::all();
    $sessions = SessionModel::all();
    $subjects = Subject::all();

    return view('students.result', compact('groupedResults', 'student', 'terms', 'sessions', 'subjects'));
}


 /*public function results(Request $request)
{
    $user = auth()->user();

    if (!$user || $user->role !== 'student') {
        abort(403);
    }

    $student = $user->student;

    $term_id = $request->term_id;
    $session_id = $request->session_id;

    $term = Term::find($term_id);

    // ✅ FIRST / SECOND TERM
    // if ($term && ($term->name === 'First Term' || $term->name === 'Second Term')) {
    if ($term && in_array($term->name, ['First Term', 'Second Term'])) {

        $results = ExamResult::with(['subject', 'term'])
            // ->where('student_id', $student->id)
            ->where('student_id', auth()->id)
            ->where('term_id', $term_id)
            ->when($session_id, fn($q) => $q->where('session_id', $session_id))
            ->get();

            dd($results);

        $groupedResults = $results; // simple list

        // $groupedResults = $results->groupBy('term_id'); // simple list


    }

    // ✅ THIRD TERM (CUMULATIVE)
    elseif ($term && $term->name === 'Third Term') {

        // $results = ExamResult::with(['subject', 'term'])
        //     ->where('student_id', $student->id)
        //     ->when($session_id, fn($q) => $q->where('session_id', $session_id))
        //     ->get()
        //     ->groupBy('subject_id'); // group by subject
        $groupedResults = ExamResult::with(['subject', 'term'])
            ->where('student_id', auth()->id)
            ->when($session_id, fn($q) => $q->where('session_id', $session_id))
            ->get()
            ->groupBy('subject_id'); // group by subject


        // $groupedResults = $results;
        // $groupedResults = $results->groupBy('term_id');
        dd($groupedResults);


    }

    else {
        $groupedResults = collect();
    }

    // ✅ CALCULATIONS
    $total = 0;
    $count = 0;

    if ($term && $term->name === 'Third Term') {
        foreach ($groupedResults as $records) {
            foreach ($records as $r) {
                $total += $r->total;
                $count++;
            }
        }
    } else {
        // $total = $groupedResults->sum('total');
        // $count = $groupedResults->count();

        $total = collect($groupedResults)->flatten()->sum('total');
    $count = collect($groupedResults)->flatten()->count();
    }
dd($groupedResults);
    $average = $count ? $total / $count : 0;
    $overallGrade = $this->grade($average);

    $terms = Term::all();
    $sessions = SessionModel::all();
    $subjects = Subject::all();


    // return view('students.result', compact(
    //     'groupedResults',
    //     'student',
    //     'term',
    //     'total',
    //     'average',
    //     'overallGrade',
    //     'terms',
    //     'sessions',
    //     'subjects'
    // ));
    return view('students.result', [
        'groupedResults' => $groupedResults,
        'student' => $student,
        'term' => $term,
        'total' => $total,
        'average' => $average,
        'overallGrade' => $overallGrade,
        'terms' => Term::all(),
        'sessions' => SessionModel::all(),
        'subjects' => Subject::all(),
    ]);
}  */
// New exam controller clean ends here
       /**  public function results(Request $request)
       * {
        *    // $student = auth()->user()->student;
        *    // New correct way
         *   $user = auth()->user();
         *   // $term = Term::find($term_id);


           * if (!$user || $user->role !== 'student') {
           *     abort(403);
           * }

           * $student = $user->student;
            */
            // New added for result to balance
          // * $term_id = $request->term_id;
          // * $student_id = $student->id;
          // * $query = ExamResult::with(['subject', 'term', 'session', 'exam'])->where('student_id', $student->id);
           //* // $query = ExamResult::with(['subject', 'term', 'session', 'exam'])
          // * *//         ->where('student_id', $student->id)->get()
         //   *//             ->groupBy('term_id');

        //   * // ✅ FILTERS
            //*if ($request->term_id) {
           //     $query->where('term_id', $request->term_id);
           // *}

           // *if ($request->session_id) {
             //   $query->where('session_id', $request->session_id);
            //*}

           // *if ($request->subject_id) {
           //  *   $query->where('subject_id', $request->subject_id);
          // * }

           // *$results = $query->get();
          // * $results = $results->groupBy('term_id');

          //  *// Dropdown data
           // *$terms = Term::all();
            //*$sessions = SessionModel::all();
           // *$subjects = Subject::all();
          // *// New added for result to balance ends here

          //  *// $results = ExamResult::with(['exam.subject'])->where('student_id', $student->id)
          //  *//     ->get()->groupBy('term_id');
          // * // New to Old importan to make student results work
           // */
          /*
            *$results = ExamResult::with(['subject','term','session'])
           * ->where('student_id', $student->id)
            *->when($request->term_id, fn($q)=>$q->where('term_id',$request->term_id))
            *->when($request->session_id, fn($q)=>$q->where('session_id',$request->session_id))
           * ->get()
            *->groupBy('term_id'); /// ✅ IMPORTANT
            // New to Old importants ends here

            // New to importants result control First, 2ND Term, 3RD Term
               * $term = Term::find($term_id);

                /*
                if ($term->name === 'First Term') {

                    $results = ExamResult::with(['subject', 'term'])
                        ->where('student_id', $student_id)
                        ->where('term_id', $term_id)
                        ->get();

                }

                elseif ($term->name === 'Second Term') {

                    $results = ExamResult::with('subject')
                        ->where('student_id', $student_id)
                        ->where('term_id', $term_id)
                        ->get();

                }  */
                // if (!$term) {
                //     $results = collect();
                // }

                // elseif ($term->name === 'First Term' || $term->name === 'Second Term') {

                //     $results = ExamResult::with(['subject', 'term'])
                //         ->where('student_id', $student_id)
                //         ->where('term_id', $term_id)
                //         ->get();

                // }

                // elseif ($term->name === 'Third Term') {

                //     $results = ExamResult::with('subject', 'term', 'session')
                //         ->where('student_id', $student_id)
                //         ->whereIn('term_id', function ($query) use ($term) {
                //             $query->select('id')
                //                 ->from('terms')
                //                 ->where('session_id', $term->session_id);
                //         })
                //         ->get()
                //         ->groupBy('subject_id');
                // }
            //  New to importants result control Ends Here

                // Calculate average
                // $total = $results->sum('total_score');
                /*$total = $results->sum('total');
                $count = $results->count(); /*/ /*
                if ($term && $term->name === 'Third Term') {

                    $total = $results->flatten()->sum('total'); // grouped data
                    $count = $results->flatten()->count();

                } else {

                    $total = $results->sum('total');
                    $count = $results->count();
                }

                $average = $count ? $total / $count : 0;

                $overallGrade = $this->grade($average);

                // New correct way ends here

            // $result = ExamResult::where('student_id', $student->id)->latest()->first();
            // $sessions = SessionModel::all();

            // return view('students.result', [
            //     'score' => $result->score ?? 0,
            //     'exam' => $result->exam ?? null,
            //     'sessions' => $sessions

            // ]);
        //     return view('students.result', compact('results', 'student', 'total','count','average', 'terms',
        // 'sessions','subjects','overallGrade'));
        return view('students.result', compact('results', 'student', 'total',  'terms',
        'sessions','subjects','overallGrade', 'term'));
        } */

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

            //

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

            // update - ADMIN ADD TEST SCORE (CA)
            public function updateTestScore(Request $request)
            {
                $result = ExamResult::findOrFail($request->result_id);

                $result->test_score = $request->test_score;

                $totalScore = $result->exam_score + $request->test_score;
                $result->total_score = $totalScore;
                $result->percentage = $totalScore;
                $result->grade = $this->grade($totalScore);

                $result->save();

                return back()->with('success', 'Test score updated');
            }

            // PARENT VIEW (ONLY THEIR CHILD)
            public function parentResult()
            {
                $student = Student::where('parent_id', auth()->id())->first();

                $results = ExamResult::where('student_id', $student->id)->get();

                return view('parent.result', compact('results'));
            }
            // STUDENT RESULT DISPLAY
            public function studentResult()
            {
                $student = auth()->user()->student;

                $results = ExamResult::with('subject')
                    ->where('student_id', $student->id)
                    ->get()
                    ->groupBy('term_id');

                return view('student.result', compact('student', 'results'));
            }

            public function printResults(){
                $student = auth()->user()->student;

                if (!$student) {
                    return back()->with('error', 'Student not found');
                }

                // $results = ExamResult::with(['term', 'subject'])
                //     ->where('student_id', auth()->id()) // ✅ THIS IS KEY
                //     ->get();
                $results = ExamResult::with(['term', 'subject'])
                    ->where('student_id', $student->id) // ✅ FIXED HERE
                    ->get();


                // dd($results); // 🔥 SHOULD NOW SHOW DATA

                $groupedResults = $results->groupBy('term_id');

                $terms = Term::all();
                $sessions = SessionModel::all();
                $subjects = Subject::all();

                // return view('students.result', compact('groupedResults', 'student', 'terms', 'sessions', 'subjects'));
                return view('students.student_results_download', compact('groupedResults', 'student', 'terms', 'sessions', 'subjects') );
            }

}
