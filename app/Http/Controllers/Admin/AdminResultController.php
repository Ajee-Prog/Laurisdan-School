<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use Illuminate\Http\Request;

class AdminResultController extends Controller
{
    //  public function index()
     public function index(Request $request)
    {
        // $results = ExamResult::with('student.user','exam')->latest()->get();
        $results = ExamResult::with('student.user', 'subject','exam')
            ->when($request->term_id, fn($q) => $q->where('term_id', $request->term_id))
                ->when($request->session_id, fn($q) => $q->where('session_id', $request->session_id))
                ->get();

        return view('admin.results.index', compact('results'));
    }
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

    // public function updateTestScore(Request $request , $id)
    public function updateTestScore(Request $request)
    {
        $result = ExamResult::findOrFail($request->result_id);

        $result->test_score = $request->test_score;

        // Recalculate
        // $result->total_score = $result->test_score + $result->exam_score;
        // TOTAL
        $result->total = $result->test_score + $result->exam_score;
        // $result->percentage = $result->total_score;
            $result->percentage = $result->total; //This OLD can be commented if calculation goes wrong
        // ✅ PERCENTAGE
        $result->percentage = ($result->total / 100) * 100;

        //  GRADE
        if ($result->percentage >= 70) $result->grade = 'A';
        elseif ($result->percentage >= 60) $result->grade = 'B';
        elseif ($result->percentage >= 50) $result->grade = 'C';
        elseif ($result->percentage >= 40) $result->grade = 'D';
        else $result->grade = 'F';
        // $result->grade = $this->grade($result->total_score);
        $result->grade = $this->grade($result->total);
        /*
        $result->ca_score = $request->ca_score;

        // ✅ TOTAL
        $result->total = $result->ca_score + $result->test_score + $result->exam_score;

        // ✅ PERCENTAGE
        $result->percentage = ($result->total / 100) * 100;
        */

        // ✅ EXTRA FIELDS
        $result->psychomotor = $request->psychomotor;
        $result->teacher_comment = $request->teacher_comment;


        $result->save();

        return back()->with('success', 'Test score/psychomotor/teacher coment added successfully');
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
