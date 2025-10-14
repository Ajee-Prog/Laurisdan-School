<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use Illuminate\Http\Request;

use App\Models\Session;
use App\Models\SessionModel;
use App\Models\Term;
use App\Models\Subject;
use Barryvdh\DomPDF\Facade\Pdf;


class ResultController extends Controller
{
        public function index(Request $request)
    {
        $sessions = SessionModel::all();
        $terms = Term::all();
        $subjects = Subject::all();

        $query = ExamResult::with(['student','session','term','subject']);

        if ($request->filled('session_id')) {
            $query->where('session_id', $request->session_id);
        }
        if ($request->filled('term_id')) {
            $query->where('term_id', $request->term_id);
        }
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $results = $query->latest()->paginate(20);

        return view('admin.results.index', compact('results','sessions','terms','subjects'));
    }

        public function exportPdf(Request $request)
    {
        $query = ExamResult::with(['student','session','term','subject']);

        if ($request->filled('session_id')) {
            $query->where('session_id', $request->session_id);
        }
        if ($request->filled('term_id')) {
            $query->where('term_id', $request->term_id);
        }
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $results = $query->get();

        $pdf = PDF::loadView('admin.results_pdf', compact('results'));
        return $pdf->download('filtered_results.pdf');
    }

}
