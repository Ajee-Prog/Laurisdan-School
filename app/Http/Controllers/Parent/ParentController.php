<?php

namespace App\Http\Controllers\Parent;

use App\Models\ParentModel;
use App\Models\User;
use Illuminate\Http\Request;
// use PDF;
use Barryvdh\DomPDF\Facade\PDF;


use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

class ParentController extends Controller
{

    public function __construct(){ $this->middleware('auth'); }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = ParentModel::with('user')->paginate(12); 
        return view('parents.index', compact('parents')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $data = $r->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'relation'=>'nullable',
            'phone'=>'nullable'
        ]);
        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt('password'),
            'role'=>'parent'
        ]);
        ParentModel::create([
            'user_id'=>$user->id,
            'relation'=>$data['relation'] ?? null,
            'phone'=>$data['phone'] ?? null
        ]);
        return redirect()->route('parents.index')->with('success','Parent created.');

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
    public function edit(ParentModel $parent)
    {
        return view('parents.edit', compact('parent')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, ParentModel $parent)
    {
        $data = $r->validate([
            'relation'=>'nullable',
            'phone'=>'nullable'
        ]); 
        $parent->update($data); 
        return redirect()->route('parents.index')->with('success','Parent updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentModel $parent)
    {
         if($parent->user) $parent->user->delete(); 
         $parent->delete(); 
         return redirect()->route('parents.index')->with('success','Parent deleted.'); 
    }

    public function exportPdf(){
        $parents = ParentModel::with('user')->get();
        $pdf = PDF::loadView('parents.pdf', compact('parents'))->setPaper('a4','portrait');
        return $pdf->download('parents.pdf');
    }

    public function dashboard(){
        return view('parents.dashboard');
    }

}
