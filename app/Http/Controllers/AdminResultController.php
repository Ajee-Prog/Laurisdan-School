<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminResultController extends Controller
{
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
}
