<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SessionModel;
// use Illuminate\Http\Request;
use PDF;


class SessionController extends Controller
{

    public function __construct(){ $this->middleware('auth'); }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = SessionModel::orderBy('start_date','desc')->paginate(12); 
        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $r->validate([
            'name'=>'required',
            'start_date'=>'nullable|date',
            'end_date'=>'nullable|date',
            'active'=>'nullable|boolean']); 
            if(isset($data['active']) && $data['active'])
                { SessionModel::query()->update(['active'=>false]); } 
            SessionModel::create($data); 
            return redirect()->route('sessions.index')->with('success','Session created.');
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
    public function edit(SessionModel $session)
    {
        return view('session.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, SessionModel $session)
    {
        $data = $r->validate([
            'name'=>'required',
            'start_date'=>'nullable|date',
            'end_date'=>'nullable|date',
            'active'=>'nullable|boolean']); 
            if(isset($data['active']) && $data['active'])
                { SessionModel::query()->update(['active'=>false]); } 
            $session->update($data); 
            return redirect()->route('sessions.index')->with('success','Session updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SessionModel $session)
    {
        $session->delete(); return redirect()->route('sessions.index')->with('success','Session deleted.');
    }

    // public function exportPdf(){
    //      $sessions = SessionModel::orderBy('start_date','desc')->get(); 
    //      $pdf = PDF::loadView('sessions.pdf', compact('sessions'))->setPaper('a4','portrait'); 
    //      return $pdf->download('sessions.pdf'); 
    //     }

}
