<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamAccess;
use App\Models\SchoolClass;
use App\Models\Term;

class AdminExamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    // List all exams
    public function index()
    {
        $exams = Exam::with('class','term')->latest()->paginate(15);
        return view('admin.exams.index', compact('exams'));
    }

    // Show create form
    public function create()
    {
        $classes = SchoolClass::all();
        $terms = Term::all();
        return view('admin.exams.create', compact('classes','terms'));
    }

    // Store exam
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'class_id'  => 'required|exists:school_classes,id',
            'term_id'   => 'required|exists:terms,id',
            'session_id'   => 'required|exists:sessions,id',
            'exam_date' => 'required|date',
            'duration'  => 'required|integer',
            'subject_id'   => 'required|exists:subjects,id',  //ADD
            // 'subject'   => 'required|string'
        ]);

        Exam::create($data);

        return redirect()->route('admin.exams.index')
            ->with('success','Exam created successfully.');
    }

    public function edit(Exam $exam)
    {
        $classes = SchoolClass::all();
        $terms = Term::all();
        return view('admin.exams.edit', compact('exam','classes','terms'));
    }

    public function update(Request $request, Exam $exam)
    {
        $exam->update($request->all());

        return redirect()->route('admin.exams.index')
            ->with('success','Exam updated.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();

        return back()->with('success','Exam deleted.');
    }

    public function generateCode($id)
    {
        $exam = \App\Models\Exam::findOrFail($id);

        $exam->access_code = strtoupper(substr(md5(time()), 0, 6)); // e.g 6-digit code
        $exam->save();

        return back()->with('success', 'Access code generated: '.$exam->access_code);
    }

    public function storeBulkQuestions(Request $request, $examId)
    {
        // $exams = Exam::all();


        for ($i = 1; $i <= 20; $i++) {

            if ($request->input("question_text_$i") && $request->input("correct_option_$i")) {

                \App\Models\Question::create([
                    'exam_id' => $examId,
                    // 'subject' => $request->subject,
                    'subject_id' => $request->subject_id,
                    'session_id' => $request->session_id,
                    'term_id' => $request->term_id,
                    'question_text' => $request->input("question_text_$i"),
                    'type' => $request->type,
                    'option_a' => $request->input("option_a_$i"),
                    'option_b' => $request->input("option_b_$i"),
                    'option_c' => $request->input("option_c_$i"),
                    'option_d' => $request->input("option_d_$i"),
                    'correct_option' => $request->input("correct_option_$i"),
                    // 'correct_answer' => $request->correct_answer,
                    'correct_answer' => $request->input("correct_answer_$i"),
                ]);
            }
        }

        return back()->with('success', 'Questions added successfully!');
        // return view('dashboard.admin', compact('exams'));
    }

    // Exam access code Table model
    public function generateStudentCode($examId, $studentId)
    {
        $code = strtoupper(substr(md5(uniqid()), 0, 6));

        ExamAccess::updateOrCreate(
            [
                'exam_id' => $examId,
                'student_id' => $studentId
            ],
            [
                'code' => $code,
                'used' => false
            ]
        );

        return back()->with('success', 'Code generated: '.$code);
    }
}
