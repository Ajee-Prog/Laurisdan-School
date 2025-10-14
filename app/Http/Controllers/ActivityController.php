<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Activity;
// use Illuminate\Http\Request;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;


class ActivityController extends Controller
{
    public function __construct(){ $this->middleware('auth'); }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::orderBy('activity_date','desc')->paginate(12);
        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $data = $r->validate(['title'=>'required','description'=>'nullable','activity_date'=>'nullable|date']);
        Activity::create($data);
        return redirect()->route('activities.index')->with('success','Activity created.');

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
    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, Activity $activity)
    {
        $data = $r->validate([
            'title'=>'required',
            'description'=>'nullable',
            'activity_date'=>'nullable|date'
        ]); 
        $activity->update($data); 
        return redirect()->route('activities.index')->with('success','Activity updated.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
         return redirect()->route('activities.index')->with('success','Activity deleted.');
    }


   
public function exportPdf(){
    $activities = Activity::orderBy('activity_date','desc')->get();
        $pdf = PDF::loadView('activities.pdf', compact('activities'))->setPaper('a4','portrait');
        return $pdf->download('activities.pdf');
}

}

