<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\SessionModel;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\PDF;


// use Illuminate\Http\Request;

class TermController extends Controller
{
    public function __construct(){ $this->middleware('auth'); }
    public function index(){ 
        $terms = Term::with('session')->paginate(12); 
        return view('terms.index', compact('terms'));
     }
    public function create(){ 
        $sessions = SessionModel::all(); 
        return view('terms.create', compact('sessions'));
     }
    public function store(Request $r){
         $data = $r->validate([
            'name'=>'required',
            'session_id'=>'nullable|exists:sessions,id',
            'start_date'=>'nullable|date',
            'end_date'=>'nullable|date']); 

         Term::create($data); 
         return redirect()->route('terms.index')->with('success','Term created.'); 
        }
    public function edit(Term $term){
         $sessions = SessionModel::all();
          return view('terms.edit', compact('term','sessions'));
         }
    public function update(Request $r, Term $term){
         $data = $r->validate([
            'name'=>'required',
            'session_id'=>'nullable',
            'start_date'=>'nullable|date',
            'end_date'=>'nullable|date']);
             $term->update($data); 
             return redirect()->route('terms.index')->with('success','Term updated.'); 
            }
    public function destroy(Term $term){ 
        $term->delete(); 
        return redirect()->route('terms.index')->with('success','Term deleted.');
     }
    
    public function exportPdf(){
        $terms = Term::with('session')->get(); 
        $pdf = PDF::loadView('terms.pdf', compact('terms'))->setPaper('a4','portrait'); 
        return $pdf->download('terms.pdf');
    }

}
