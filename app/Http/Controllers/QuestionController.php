<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Option;


// use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('options')->latest()->paginate(10);
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'options.*' => 'required|string',
            'correct_option' => 'required|integer',
        ]);

        $question = Question::create([
            'question' => $request->question,
            'session_id' => $request->session_id,
            'term_id' => $request->term_id,
            'subject_id' => $request->subject_id
        ]);

        foreach ($request->options as $index => $optionText) {
            Option::create([
                'question_id' => $question->id,
                'option_text' => $optionText,
                'is_correct' => $index == $request->correct_option,
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Question created successfully!');
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
 
}
