<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\SchoolClass;
use App\Models\Term;
// use Illuminate\Http\Request;
use PDF;


class ExamController extends Controller
{

    public function __construct(){ $this->middleware('auth'); }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::with('class','term')->orderBy('exam_date','desc')->paginate(12);
        return view('exams.index', compact('exams'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $classes = ClassModel::all();
        $terms = Term::all();
        return view('exams.create', compact('classes','terms'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $r->validate(['title'=>'required','class_id'=>'nullable|exists:classes,id','term_id'=>'nullable|exists:terms,id','exam_date'=>'nullable|date']);
        Exam::create($data);
        return redirect()->route('exams.index')->with('success','Exam created.');

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
    public function edit(Exam $exam)
    {
        $classes = ClassModel::all(); $terms = Term::all(); return view('exams.edit', compact('exam','classes','terms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, Exam $exam)
    {
         $data = $r->validate([
            'title'=>'required',
            'class_id'=>'nullable',
            'term_id'=>'nullable',
            'exam_date'=>'nullable|date'
        ]); 
        $exam->update($data); 
        return redirect()->route('exams.index')->with('success','Exam updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete(); return redirect()->route('exams.index')->with('success','Exam deleted.'); 
    }

//     public function exportPdf()
//     {
//         $exams = Exam::with('class','term')->orderBy('exam_date','desc')->get();
//         $pdf = PDF::loadView('exams.pdf', compact('exams'))->setPaper('a4','portrait');
//         return $pdf->download('exams.pdf');
//     }

}
