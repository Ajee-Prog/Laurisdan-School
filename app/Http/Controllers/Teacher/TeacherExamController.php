<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class TeacherExamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    // Teacher exams only
    public function index()
    {
        $exams = Exam::where('teacher_id', Auth::id())
            ->withCount('questions')
            ->latest()
            ->get();

        return view('teacher.exams.index', compact('exams'));
    }

    public function create()
    {
        return view('teacher.exams.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'duration' => 'required|integer',
            'subject' => 'required'
        ]);

        $data['teacher_id'] = Auth::id();

        Exam::create($data);

        return redirect()->route('teacher.exams.index')
            ->with('success','Exam created.');
    }

    public function show(Exam $exam)
    {
        $exam->load('questions.options');
        return view('teacher.exams.show', compact('exam'));
    }
}
