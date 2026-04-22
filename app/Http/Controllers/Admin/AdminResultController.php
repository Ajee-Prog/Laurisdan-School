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
}
