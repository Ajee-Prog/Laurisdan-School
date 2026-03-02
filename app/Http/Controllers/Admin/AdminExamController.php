<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\SchoolClass;
use App\Models\Term;

class AdminExamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    // List all exams
    public function index()
    {
        $exams = Exam::with('class','term')->latest()->paginate(15);
        return view('admin.exams.index', compact('exams'));
    }

    // Show create form
    public function create()
    {
        $classes = SchoolClass::all();
        $terms = Term::all();
        return view('admin.exams.create', compact('classes','terms'));
    }

    // Store exam
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'class_id'  => 'required|exists:school_classes,id',
            'term_id'   => 'required|exists:terms,id',
            'exam_date' => 'required|date',
            'duration'  => 'required|integer',
            'subject'   => 'required|string'
        ]);

        Exam::create($data);

        return redirect()->route('admin.exams.index')
            ->with('success','Exam created successfully.');
    }

    public function edit(Exam $exam)
    {
        $classes = SchoolClass::all();
        $terms = Term::all();
        return view('admin.exams.edit', compact('exam','classes','terms'));
    }

    public function update(Request $request, Exam $exam)
    {
        $exam->update($request->all());

        return redirect()->route('admin.exams.index')
            ->with('success','Exam updated.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();

        return back()->with('success','Exam deleted.');
    }
}
