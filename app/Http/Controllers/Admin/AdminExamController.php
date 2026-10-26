<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamAccess;
use App\Models\Question;
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
        $exam = Exam::findOrFail($examId);

        $request->validate([
        'subject_id' => 'required|exists:subjects,id',
        'session_id' => 'required|exists:sessions,id',
        'term_id' => 'required|exists:terms,id',

        'questions' => 'required|array|min:1',

        'questions.*.question_text' => 'required|string',
        'questions.*.type' => 'required|in:mcq,fill,true_false',

        'questions.*.option_a' => 'nullable|string',
        'questions.*.option_b' => 'nullable|string',
        'questions.*.option_c' => 'nullable|string',
        'questions.*.option_d' => 'nullable|string',

        'questions.*.correct_option' => 'nullable|string',
        'questions.*.correct_answer' => 'nullable|string',
    ]);

    foreach ($request->questions as $questionData) {
        $type = $questionData['type'];

        if ($type === 'mcq') {
            $request->validate([
                'questions.*.option_a' => 'required|string',
                'questions.*.option_b' => 'required|string',
                'questions.*.option_c' => 'required|string',
                'questions.*.option_d' => 'required|string',
                'questions.*.correct_option' => 'required|in:A,B,C,D',
            ]);
        }

        if ($type === 'fill') {
            if (empty(trim($questionData['correct_answer'] ?? ''))) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'questions' => 'Enter the correct answer for every fill-in-the-gap question.',
                    ]);
            }
        }

        if ($type === 'true_false') {
            $request->validate([
                'questions.*.correct_answer' => 'required|in:True,False',
            ]);
        }

        \App\Models\Question::create([
            'exam_id' => $exam->id,
            'subject_id' => $request->subject_id,
            'session_id' => $request->session_id,
            'term_id' => $request->term_id,

            'question_text' => $questionData['question_text'],
            'type' => $type,

            // Nullable options for fill and true/false questions
            'option_a' => $type === 'mcq'
                ? $questionData['option_a'] : null,
            'option_b' => $type === 'mcq'
                ? $questionData['option_b'] : null,
            'option_c' => $type === 'mcq'
                ? $questionData['option_c'] : null,
            'option_d' => $type === 'mcq'
                ? $questionData['option_d'] : null,

            'correct_option' => $type === 'mcq'
                ? $questionData['correct_option'] : null,

            'correct_answer' => $type === 'mcq'
                ? $questionData['correct_option']
                : ($questionData['correct_answer'] ?? null),
        ]);
    }

    return redirect()
        ->route('admin.exams.index')
        ->with('success', 'Questions added successfully!');
        // $exams = Exam::all();


        /*

        for ($i = 1; $i <= 20; $i++) {

        $questionText = $request->input("question_text_$i");
        $type = $request->input("type_$i");

        // Skip empty questions
        if (!$questionText || !$type) {
            continue;
        }

        $data = [
            'exam_id' => $examId,

            'subject_id' => $request->subject_id,

            'session_id' => $request->session_id,

            'term_id' => $request->term_id,

            'question_text' => $questionText,

            'type' => $type,

            'option_a' => null,
            'option_b' => null,
            'option_c' => null,
            'option_d' => null,

            'correct_option' => null,

            'correct_answer' => null,
        ];


        /*
        |--------------------------------------------------------------------------
        | MULTIPLE CHOICE
        |--------------------------------------------------------------------------
        *

        if ($type === 'mcq') {

            $data['option_a'] =
                $request->input("option_a_$i");

            $data['option_b'] =
                $request->input("option_b_$i");

            $data['option_c'] =
                $request->input("option_c_$i");

            $data['option_d'] =
                $request->input("option_d_$i");

            $data['correct_option'] =
                $request->input("correct_option_$i");
        }


        /*
        |--------------------------------------------------------------------------
        | FILL IN THE GAP
        |--------------------------------------------------------------------------
        *

        elseif ($type === 'fill') {

            $data['correct_answer'] =
                $request->input("correct_answer_$i");
        }


        /*
        |--------------------------------------------------------------------------
        | TRUE / FALSE
        |--------------------------------------------------------------------------
        *

        elseif ($type === 'true_false') {

            $data['correct_answer'] =
                $request->input("correct_answer_$i");
        }


        \App\Models\Question::create($data);
    }

    // return back()->with(
    //     'success',
    //     'Questions added successfully!'
    // );

        return back()->with('success', 'Questions added successfully!');
        // return view('dashboard.admin', compact('exams')); */
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
