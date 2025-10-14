<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\Question;
use App\Models\ExamResult;
use App\Models\ClassModel;
use App\Models\Term;
// use Illuminate\Http\Request;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;


class ExamController extends Controller
{

    public function __construct(){ $this->middleware('auth'); }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($subject)
    {
        $student = auth()->user()->student;
        $exams = Exam::with('class','term')->orderBy('exam_date','desc')->paginate(12);
        // $exams = Exam::with('class','term')->latest()->get();
        return view('exams.index', compact('exams'));
        // return view('admin.exams.index', compact('exams'));
        // check if the student already took the exam
        $alreadyTaken = ExamResult::where('student_id',$tudent->id)->where('subject', $subject)->exists();
        if($alreadyTaken){
            return redirect()->route('student.dashboard')->with('error', 'You have already taken this '.$subject.'exam.');
        }

        // Load 10 random questions
        $questions = Question::where('subject', $subject)
            ->inRandomOrder()
            ->take(10)
            ->get();

        // 40-minute duration in seconds
        $examDuration = 40 * 60;

        return view('student.exams.cbt', compact('questions','subject','examDuration'));


    }

    public function  submit(Request $request){
        $student = auth()->user()->student;
        $subject = $request->input('subject');
        $answers = $request->input('answers', []);
        $score = 0;

        // Prevent multiple submissions
        if (ExamResult::where('student_id',$student->id)->where('subject',$subject)->exists()) {
            return redirect()->route('student.dashboard')->with('error', 'You already submitted this exam.');
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

         return redirect()->route('student.dashboard')->with('success', 'Exam submitted successfully! Score: '.$finalScore);




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $classes = ClassModel::all();
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
        'exam_date'=>'nullable|date']);
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
        $classes = ClassModel::all(); 
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

   
public function exportPdf(){
    $exams = Exam::with('class','term')->orderBy('exam_date','desc')->get();
        $pdf = PDF::loadView('exams.pdf', compact('exams'))->setPaper('a4','portrait');
        return $pdf->download('exams.pdf');
}

}
