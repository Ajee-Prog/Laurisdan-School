<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create($examId)
    {
        $exam = Exam::findOrFail($examId);
        return view('teachers.questions.create', compact('exam'));
    }

    public function store(Request $request, $examId)
    {
        $request->validate([
            'question_text' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_option' => 'required|in:A,B,C,D',
        ]);

        Question::create([
            'exam_id' => $examId,
            'question_text' => $request->question_text,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'correct_option' => $request->correct_option,
        ]);

        return back()->with('success', 'Question added successfully!');
    }
}
