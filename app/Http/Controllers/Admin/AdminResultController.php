<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use Illuminate\Http\Request;

class AdminResultController extends Controller
{
     public function index()
    {
        $results = ExamResult::with('student.user','exam')->latest()->get();
        return view('admin.results.index', compact('results'));
    }

    public function edit($id)
    {
        $result = ExamResult::with('student.user','exam')->findOrFail($id);
        return view('admin.results.edit', compact('result'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $result = ExamResult::findOrFail($id);

        $request->validate([
            'score' => 'required|numeric|min:0'
        ]);

        $result->update([
            'score' => $request->score
        ]);

        return redirect()->route('admin.results.index')
            ->with('success','Result updated successfully');
    }



    // New update test score
    private function grade($score)
    {
        if ($score >= 70) return 'A';
        if ($score >= 60) return 'B';
        if ($score >= 50) return 'C';
        if ($score >= 45) return 'D';
        if ($score >= 40) return 'E';
        return 'F';
    }

    public function updateTestScore(Request $request)
    {
        $result = ExamResult::findOrFail($request->result_id);

        $result->test_score = $request->test_score;

        // Recalculate
        $result->total_score = $result->test_score + $result->exam_score;
        $result->percentage = $result->total_score;
        $result->grade = $this->grade($result->total_score);

        $result->save();

        return back()->with('success', 'Test score added successfully');
    }
}
