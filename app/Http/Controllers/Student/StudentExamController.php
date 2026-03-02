<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// namespace App\Http\Controllers\Student;

// use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Student;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentExamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:student']);
    }

    // 📌 List exams for student class
    public function index()
    {
        $student = Student::where('user_id', Auth::id())->firstOrFail();

        $exams = Exam::where('class_id', $student->class_id)
            ->where('is_active', true)
            ->get();

        return view('students.exams.index', compact('exams'));
    }

    // 📌 Exam info page
    public function view(Exam $exam)
    {
        return view('students.exams.view', compact('exam'));
    }

    // 🚀 START CBT
    public function start(Exam $exam)
    {
        $student = Student::where('user_id', Auth::id())->firstOrFail();

        // 🔐 Class check
        if ($exam->class_id !== $student->class_id) {
            abort(403, 'This exam is not for your class');
        }

        $exam->load('questions');

        if ($exam->questions->count() === 0) {
            return redirect()->back()->with('error','No questions found for this exam.');
        }

        $result = ExamResult::firstOrCreate(
            [
                'student_id' => $student->id,
                'exam_id'    => $exam->id
            ],
            [
                'started_at' => now()
            ]
        );

        if ($result->is_submitted) {
            return redirect()->route('student.exams')
                ->with('error','You already submitted this exam.');
        }

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
            'exam'      => $exam,
            'questions' => $exam->questions,
            'endTime'   => $endTime
        ]);
    }

    // 📝 SUBMIT CBT
    public function submit(Request $request, Exam $exam)
    {
        $student = Student::where('user_id', Auth::id())->firstOrFail();

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
            if ($answer === $question->answer) {
                $score++;
            }
        }

        $result->update([
            'score'        => $score,
            'is_submitted' => true,
            'submitted_at' => now()
        ]);

        return redirect()->route('student.exams')
            ->with('success','Exam submitted successfully. Score: '.$score);
    }
}
