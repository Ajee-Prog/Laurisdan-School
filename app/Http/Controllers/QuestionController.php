<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Option;


// use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
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

    public function index()
    {
        $questions = Question::with('options')->latest()->get();
        return view('admin.questions.index', compact('questions'));
    }

    // public function create($exam_id)
    // {
    //     // new implementation
    //     $exam = Exam::findOrFail($exam_id);
    //     return view('admin.questions.create', compact('exam'));
    //     // old workable
    //     // return view('admin.questions.create');
    // }
    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'question_text' => 'required',
        //     // 'options' => 'required|array|min:2',
        //     'options.*' => 'required',
        //     'correct_option' => 'required',
        // ]);

        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
            'question' => 'required',
            'options.*' => 'required',
            'correct_option' => 'required'
        ]);

        // $question = Question::create([
        //     'exam_id' => $exam_id,
        //     'question_text' => $request->question_text
        //     // 'question' => $request->question,
        //     // 'subject_id' => $request->subject_id ?? null,
        //     // 'session_id' => $request->session_id ?? null,
        //     // 'term_id' => $request->term_id ?? null,
        //     // 'subject_id' => $request->subject_id
        // ]);

        // Save question
        $question = Question::create([
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'question' => $request->question,
            'correct_option' => $request->correct_option
        ]);


        // foreach ($request->options as $key => $opt) {
        //     Option::create([
        //         'question_id' => $question->id,
        //         'option_text' => $opt,
        //         'is_correct' => $key == $request->correct_option,
        //     ]);
        // }

        // Save options
        foreach ($request->options as $key => $value) {
            Option::create([
                'question_id' => $question->id,
                'option_text' => $value,
                'option_key' => $key   // A, B, C, D
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Question added successfully!');
        // return redirect()->route('questions.index')->with('success', 'Question created successfully!');
        // return redirect()->route('admin.questions.index', $exam_id)->with('success', 'Question Added successfully!');
    }

    public function edit(Question $question)
    {
        $question->load('options');
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'correct_option' => 'required|integer',
        ]);

        $question->update([
            'question' => $request->question,
            'session_id' => $request->session_id,
            'term_id' => $request->term_id,
            'subject_id' => $request->subject_id
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

        return redirect()->route('questions.index')->with('success', 'Question updated successfully!');
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
