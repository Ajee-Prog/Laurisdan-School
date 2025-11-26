<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CBTController extends Controller
{

    //  public function start($exam_id)
     public function start($examId)
    {
        // ensure student guard
        $student = Auth::guard('student')->user();
        if (!$student) abort(403);

        $exam = Exam::with('questions.options')->findOrFail($examId);

        // check pivot entry; create if missing
        $pivot = DB::table('exam_student')
            ->where('exam_id', $examId)
            ->where('student_id', $student->id)
            ->first();

            // default total time for exam in seconds (exam->duration stored in minutes)
        $defaultTime = (int)$exam->duration * 60;

        if (!$pivot) {
            // assign the exam to the student with default time_remaining
            DB::table('exam_student')->insert([
                'exam_id' => $examId,
                'student_id' => $student->id,
                'score' => null,
                'status' => 'pending',
                'time_remaining' => $defaultTime,
                'started_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $timeRemaining = $defaultTime;
        } else {
            // if already completed return to results or block
            if ($pivot->status === 'completed') {
                return redirect()->route('student.exam.result', $examId)
                    ->with('message', 'You have already submitted this exam.');
            }
            // use stored time_remaining if present and > 0, otherwise exam default
            $timeRemaining = ($pivot->time_remaining !== null && (int)$pivot->time_remaining > 0)
                ? (int)$pivot->time_remaining
                : $defaultTime;
        }

         // load previously saved answers (if you have exam_answers table)
        $savedAnswers = DB::table('exam_answers')
            ->where('exam_id', $examId)
            ->where('student_id', $student->id)
            ->pluck('option_id', 'question_id') // question_id => option_id
            ->toArray();

        return view('students.cbt.start', compact('exam', 'timeRemaining', 'savedAnswers'));





        // return view('student.cbt.start', compact('exam'));
    }

    // Save answers + remaining time via AJAX
    public function saveProgress(Request $request, $examId)
    {
        $student = Auth::guard('student')->user();
        if (!$student) return response()->json(['error' => 'Unauthenticated'], 401);

        $answers = $request->input('answers', []); // expects { questionId: optionId, ... }
        $timeRemaining = (int)$request->input('time_remaining', 0);

        // upsert each exam answer into exam_answers table
        foreach ($answers as $questionId => $optionId) {
            DB::table('exam_answers')->updateOrInsert(
                [
                    'exam_id' => $examId,
                    'student_id' => $student->id,
                    'question_id' => $questionId
                ],
                [
                    'option_id' => $optionId,
                    'updated_at' => now(),
                    'created_at' => now()
                ]
            );
        }

        // update pivot time_remaining and updated_at
        DB::table('exam_student')
            ->where('exam_id', $examId)
            ->where('student_id', $student->id)
            ->update([
                'time_remaining' => $timeRemaining,
                'updated_at' => now()
            ]);

        return response()->json(['status' => 'saved']);
    }

    // Ends here..

    // Student submits exam (manual or auto)

    public function submit(Request $request, $examId){
        $exam = Exam::with('questions.options')->findOrFail($examId);
        $student = Auth::guard('student')->user();
        if(!$student) abort(403);

         // get final answers: prefer submitted, otherwise saved in exam_answers
        $submittedAnswers = $request->all();

        // We'll read radio inputs named question_{id}
        $answers = [];

         foreach ($exam->questions as $q) {
            $field = 'question_' . $q->id;
            if ($request->has($field)) {
                $answers[$q->id] = $request->input($field);
            } else {
                // look in saved answers table
                $opt = DB::table('exam_answers')
                    ->where('exam_id', $examId)
                    ->where('student_id', $student->id)
                    ->where('question_id', $q->id)
                    ->value('option_id');
                if ($opt) $answers[$q->id] = $opt;
            }
        }

         // scoring
        $scoreCount = 0;
        foreach ($exam->questions as $q) {
            $selected = $answers[$q->id] ?? null;
            $correct = $q->options->where('is_correct', true)->first();
            if ($correct && $selected && intval($selected) === intval($correct->id)) {
                $scoreCount++;
            }
        }

        $totalQuestions = $exam->questions->count();
        $percentage = $totalQuestions ? round(($scoreCount / $totalQuestions) * 100, 2) : 0;

         // update pivot: score (store percentage), status, ended_at
        DB::table('exam_student')
            ->where('exam_id', $examId)
            ->where('student_id', $student->id)
            ->update([
                'score' => $percentage,
                'status' => 'completed',
                'time_remaining' => 0,
                'ended_at' => now(),
                'updated_at' => now()
            ]);

        // clean up saved answers for that student (optional)
        DB::table('exam_answers')
            ->where('exam_id', $examId)
            ->where('student_id', $student->id)
            ->delete();

        // return result view
        return view('students.cbt.result', [ 'exam' => $exam, 'score' => $scoreCount,
        'total' => $totalQuestions,
            'percentage' => $percentage
        ]);
    // }







        // $score = 0;
        // foreach ($exam->questions as $question) {
        //     $selected = $request->input('question_'.$question->id);
        //     $correct = $question->options()->where('is_correct', true)->first();

        //     if ($correct && $correct->id == $selected) {
        //         $score += 1;
        //     }
        // }

        // $total = $exam->questions->count();
        // $percentage = ($total > 0) ? round(($score / $total) * 100) : 0;

        // $exam->students()->updateExistingPivot($student->id, [
        //     'score' => $percentage,
        //     'status' => 'completed'
        // ]);

        return view('student.cbt.result', compact('exam', 'score', 'total', 'percentage'));

    }


    // Optional: view result (if already submitted)
//     public function result($examId)
//     {
//         $student = Auth::guard('student')->user();
//         $pivot = DB::table('exam_student')
//             ->where('exam_id', $examId)
//             ->where('student_id', $student->id)
//             ->first();

//         if (!$pivot || $pivot->status !== 'completed') {
//             return redirect()->route('student.exam.start', $examId)
//                 ->with('message', 'Exam not submitted yet.');
//         }

//         $exam = Exam::findOrFail($examId);
//         return view('student.cbt.result', [
//             'exam' => $exam,
//             'score' => null,
//             'total' => null,
//             'percentage' => $pivot->score
//         ]);
//     }
public function result($examId){
    $student = Auth::guard('student')->user();
        $pivot = DB::table('exam_student')
            ->where('exam_id', $examId)
            ->where('student_id', $student->id)
            ->first();

        if (!$pivot || $pivot->status !== 'completed') {
            return redirect()->route('students.exam.start', $examId)
                ->with('message', 'Exam not submitted yet.');
        }
        $exam = Exam::findOrFail($examId);
        return view('students.cbt.result', ['exam' => $exam,
            'score' => null,
            'total' => null,
            'percentage' => $pivot->score]);
    
}





// CBT extra controll ends.............................
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($exam_id)
    {
        // $exam = Exam::with('questions.options')->findOrFail($exam_id);
        // return view('student.cbt.start', compact('exam'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
