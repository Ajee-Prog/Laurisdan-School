<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminResultController extends Controller
{
    /*
    public function index(Request $request)
        {
            $results = ExamResult::with(['student', 'subject', 'exam'])
                ->when($request->term_id, fn($q) => $q->where('term_id', $request->term_id))
                ->when($request->session_id, fn($q) => $q->where('session_id', $request->session_id))
                ->get();

            return view('admin.results.index', compact('results'));
        }
    */
    public function edit($id)
    {
        $result = \App\Models\ExamResult::with('student','exam')->findOrFail($id);

        return view('admin.results.edit', compact('result'));
    }

    // Update CA Test and CBT REsult
    public function update(Request $request, $id)
    {
        $result = \App\Models\ExamResult::findOrFail($id);

        $ca = $request->ca_score;
        $test = $request->test_score;
        $exam = $result->exam_score;

        $total = $ca + $test + $exam;

        $result->update([
            'ca_score' => $ca,
            'test_score' => $test,
            'total_score' => $total,
            'term_id' => $request->term_id,
            'session_id' => $request->session_id,
        ]);

        return back()->with('success', 'Result updated successfully');
    }
    /*
    public function update(Request $request, $id)
{
    $result = ExamResult::findOrFail($id);

    $result->test_score = $request->test_score;
    $result->exam_score = $request->exam_score;
    $result->ca_score = $request->ca_score;

    // ✅ TOTAL
    $result->total = $result->ca_score + $result->test_score + $result->exam_score;

    // ✅ PERCENTAGE
    $result->percentage = ($result->total / 100) * 100;

    // ✅ GRADE
    if ($result->percentage >= 70) $result->grade = 'A';
    elseif ($result->percentage >= 60) $result->grade = 'B';
    elseif ($result->percentage >= 50) $result->grade = 'C';
    elseif ($result->percentage >= 40) $result->grade = 'D';
    else $result->grade = 'F';

    // ✅ EXTRA FIELDS
    $result->psychomotor = $request->psychomotor;
    $result->teacher_comment = $request->teacher_comment;

    $result->save();

    return back()->with('success', 'Result Updated Successfully');
}
     */
}
