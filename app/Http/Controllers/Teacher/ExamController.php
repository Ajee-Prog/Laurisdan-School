<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = Auth::user()->teacherProfile;
        $exams = Exam::where('teacher_id', $teacher->id)->with('class')->get();
        return view('teachers.exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teacher = Auth::user()->teacherProfile;
        $classes = SchoolClass::where('teacher_id', $teacher->id)->get();
        return view('teacher.exams.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teacher = Auth::user()->teacherProfile;

        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'term' => 'required|string',
            'esession' => 'required|string',
            'class_id' => 'required|integer'
        ]);

        $exam = Exam::create([
            'teacher_id' => $teacher->id,
            'class_id' => $request->class_id,
            'title' => $request->title,
            'subject' => $request->subject,
            'term' => $request->term,
            'session' => $request->esession,
        ]);

        return redirect()->route('teacher.exams.questions.create', $exam->id)
                         ->with('success', 'Exam created successfully! Now add questions.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);
        return view('teacher.exams.show', compact('exam'));
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
        Exam::findOrFail($id)->delete();
        return redirect()->route('teacher.exams.index')->with('success', 'Exam deleted successfully.');
    }
}
