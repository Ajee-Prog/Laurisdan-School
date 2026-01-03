<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Option;
use App\Models\SessionModel;
use App\Models\Subject;
use App\Models\Term;
use Illuminate\Validation\Rule;

// use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'role:admin']);
    // }

    public function __construct()
    {
        $this->middleware(['auth','role:admin,teacher']);
    }
    // public function index($exam_id)
    // {
    //     // new implementation
    //     $exam = Exam::findOrFail($exam_id);
    //     // $questions = $exam->questions()->with('options')->get();
    //     // return view('admin.questions.index', compact('exam','questions'));
    //     // old workable
    //     $questions = Question::with('options')->latest()->paginate(10);
    //     return view('admin.questions.index', compact('questions'));
    // }

    public function index($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        // $questions = Question::with('exam','options')->latest()->get();
        $questions = Question::where('exam_id', $exam_id)->get();
        return view('admin.questions.index', compact('exam','questions'));
    }

    // // public function create($exam_id)
    // // {
    //     $exam = Exam::findOrFail($exam_id);
    //     $sessions = SessionModel::all();
    //     $terms = Term::all();
    //     $subjects = Subject::all();

        // return view('admin.questions.create', compact('exam','sessions','terms','subjects'));
    //     // new implementation
    //     $exam = Exam::findOrFail($exam_id);
    //     return view('admin.questions.create', compact('exam'));
    //     // old workable
    //     // return view('admin.questions.create');
    // }
    public function create(Exam $exam)
    // public function create($exam_id = null)
    {

        // // $exam = Exam::findOrFail($exam_id);
        // $exam = $exam_id ? Exam::find($exam_id) : null;
        // $exams = Exam::all();
        // $sessions = SessionModel::all();
        // $terms = Term::all();
        // $subjects = Subject::all();

        // return view('admin.questions.create', compact('exams','exam','sessions','terms','subjects'));
        // Load dropdown lists
        $exam    = $exam;
        $exams    = Exam::all();
        $sessions = \App\Models\SessionModel::all();
        $terms = \App\Models\Term::all();
        $subjects = Subject::all();

    return view('admin.questions.create', compact('exam','exams', 'subjects', 'sessions', 'terms'));
       
    }

    public function store(Request $request, $examId)
    // public function store(Request $request, Exam $exam)
    {
        $request->validate([
        'question_text'   => 'required|string',
        'options'         => 'required|array|min:4|max:4',
        'options.*'       => 'required|string',
        'correct_option'  => 'required|in:0,1,2,3',
        'subject'         => 'required|string',
        'subject_id'      => 'nullable|exists:subjects,id',
        // 'exam_id'      => 'nullable|exists:exams,id',
    ]);

    $options = $request->options;
    $correctIndex = $request->correct_option;

    Question::create([
        // 'exam_id'        => $exam->id,
        'exam_id'        => $examId,
        'subject'        => $request->subject,
        'subject_id'     => $request->subject_id,
        'question_text'  => $request->question_text,
        'option_a'       => $request->options[0],
        'option_b'       => $request->options[1],
        'option_c'       => $request->options[2],
        'option_d'       => $request->options[3],
        // 'correct_option' => $request->correct_option,
        'correct_option' => ['A','B','C','D'][$correctIndex],
    ]);

        // New detect and matching db Question and its Options
        // Validate inputs
    // $request->validate([
    //     'exam_id' => ['nullable','exists:exams,id'],
    //     'subject_id' => ['nullable','exists:subjects,id'],
    //     // -------------------------------------
    //     'question_text' => 'required',
    //         'options'       => 'required|array|size:4',
    //         'correct_option'=> 'required|in:0,1,2,3',
    //         'session_id'    => 'required',
    //         'term_id'       => 'required',
    //         'subject'         => 'required',

    //         // 'subject_id'    => 'required',
    //         'option_a' => ['required','string'],
    //         'option_b' => ['required','string'],
    //         'option_c' => ['required','string'],
    //         'option_d' => ['required','string'],
    //         // correct_option will store 'A'|'B'|'C'|'D'
    //         'correct_option' => ['required', Rule::in(['A','B','C','D'])],



    //     // --------------------------------------
        
    // ]);

    // // Save Question
    // $question = Question::create([
    //     'exam_id' => $request->exam_id ?? null,
    //     // -----------------------------------------------
    //         // 'exam_id'        => $exam_id,
    //         'subject'        => $request->subject,
    //         'question_text'  => $request->question_text,
    //         'option_a'       => $request->options[0],
    //         'option_b'       => $request->options[1],
    //         'option_c'       => $request->options[2],
    //         'option_d'       => $request->options[3],
    //         'correct_option' => $request->correct_option,
    //         'session_id'     => $request->session_id,
    //         'term_id'        => $request->term_id,
    //         'subject_id'     => $request->subject_id ?? null,
    //     // -------------------------------
        
    // ]);

        // return redirect()->route('admin.exams.show', $exam_id)->with('success', 'Question added successfully!');

        // return redirect()->route('admin.questions.index', compact('exam_id => $question->exam_id'))->with('success', 'Question added successfully.');
        // return redirect()->route('exams.show', $examId)->with('success', 'Question added successfully!');
        return redirect()->route('questions.index')->with('success', 'Question created successfully!');
        // New detect ends here............

        
        // $request->validate([
        //     'question_text' => 'required',
        //     // 'options' => 'required|array|min:2',
        //     'options.*' => 'required',
        //     'correct_option' => 'required',
        // ]);

        // $request->validate([
        //     'class_id' => 'required',
        //     'subject_id' => 'required',
        //     'question' => 'required',
        //     'options.*' => 'required',
        //     'correct_option' => 'required'
        // ]);

        // $question = Question::create([
        //     'exam_id' => $exam_id,
        //     'question_text' => $request->question_text
        //     // 'question' => $request->question,
        //     // 'subject_id' => $request->subject_id ?? null,
        //     // 'session_id' => $request->session_id ?? null,
        //     // 'term_id' => $request->term_id ?? null,
        //     // 'subject_id' => $request->subject_id
        // ]);

        // // Save question
        // $question = Question::create([
        //     'class_id' => $request->class_id,
        //     'subject_id' => $request->subject_id,
        //     'question' => $request->question,
        //     'correct_option' => $request->correct_option
        // ]);

        // // ------------------------
        // $request->validate([
        //     'exam_id'=>'nullable|exists:exams,id',
        //     'session_id'=>'nullable|exists:sessions,id',
        //     'term_id'=>'nullable|exists:terms,id',
        //     'subject_id'=>'nullable|exists:subjects,id',
        //     'question'=>'required|string',
        //     'options'=>'required|array|min:4',
        //     'options.*' => 'required',
        //     'correct_option'=>'required|in:A,B,C,D'
        // ]);

        // $question = Question::create([
        //     'exam_id'=>$request->exam_id,
        //     'session_id'=>$request->session_id,
        //     'term_id'=>$request->term_id,
        //     'subject_id'=>$request->subject_id,
        //     'question'=>$request->question,
        //     'correct_option'=> $request->correct_option,
        // ]);


        // // foreach ($request->options as $key => $opt) {
        // //     Option::create([
        // //         'question_id' => $question->id,
        // //         'option_text' => $opt,
        // //         'is_correct' => $key == $request->correct_option,
        // //     ]);
        // // }

        // // Save options
        // foreach ($request->options as $key => $value) {
        //     Option::create([
        //         'question_id' => $question->id,
        //         'option_text' => $value,
        //         'option_key' => $key   // A, B, C, D
        //     ]);
       // }

        // return redirect()->route('questions.index')->with('success', 'Question added successfully!');
        // // return redirect()->route('questions.index')->with('success', 'Question created successfully!');
        // // return redirect()->route('admin.questions.index', $exam_id)->with('success', 'Question Added successfully!');
    }


    public function show(Question $question)
    {
        // $question->load('exam','subjectModel');
        $question->load('exam');
        return view('admin.questions.show', compact('question'));
    }

    // public function edit(Question $question)
    // {
    //     $question->load('options');
    //     return view('admin.questions.edit', compact('question'));
    // }
    
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $sessions  = SessionModel::all();
        $terms  = Term::all();
        $subjects  = Subject::all();

        return view('admin.questions.edit', compact('question', 'sessions','terms', 'subjects'));
    }

    // -------------------------------------------------------

    // public function update(Request $request, Question $question)
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'question' => 'required|string',
        //     'options' => 'required|array|min:2',
        //     'options.*' => 'required|string',
        //     'correct_option' => 'required|integer',
        // ]);
        // ---------------------------------------
        $question = Question::findOrFail($id);

        $question->update([
            'question_text'  => $request->question_text,
            'option_a'       => $request->options[0],
            'option_b'       => $request->options[1],
            'option_c'       => $request->options[2],
            'option_d'       => $request->options[3],
            'correct_option' => $request->correct_option,
            'session_id'     => $request->session_id,
            'term_id'        => $request->term_id,
            'subject_id'     => $request->subject_id,
        ]);

        // Delete old options & recreate
        $question->options()->delete();

        foreach ($request->options as $index => $optionText) {
            Option::create([
                'question_id' => $question->id,
                'option_text' => $optionText,
                'is_correct' => $index == $request->correct_option,
            ]);
        }

        // return redirect()->route('questions.index')->with('success', 'Question updated successfully!');
        return redirect()->back()->with('success', 'Question updated.');
    }


public function destroy(Question $question){
    $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted!');
}



/*
    public function index(){ $questions = Question::with('exam')->paginate(20); return view('teacher.questions.index', compact('questions')); }


public function create(){ $exams = Exam::all(); return view('teacher.questions.create', compact('exams')); }


public function store(Request $r){
$r->validate(['exam_id'=>'required|exists:exams,id','question_text'=>'required','options'=>'required|array|min:2','correct_index'=>'required|integer']);
$q = Question::create(['exam_id'=>$r->exam_id,'question_text'=>$r->question_text]);
foreach($r->options as $i=>$optText){ Option::create(['question_id'=>$q->id,'option_text'=>$optText,'is_correct'=>($i==(int)$r->correct_index)]); }
return redirect()->route('questions.index')->with('success','Question added');
}


public function destroy(Question $question){ $question->delete(); return back()->with('success','Deleted'); }
*/
 
}
