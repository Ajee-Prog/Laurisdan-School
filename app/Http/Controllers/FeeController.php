<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeeController extends Controller
{
    public function generateReceipt($id)
    {
        $fee = Fee::with('student')->findOrFail($id);

        $pdf = Pdf::loadView('receipt.fee', compact('fee'));

        return $pdf->download('School_Fee_Receipt_'.$fee->id.'.pdf');
    }

    // public function studentHistory()
    // {
    //     $fees = Fee::where('student_id', Auth::user()->student->id)->get();
    //     return view('students.fee-history', compact('fees'));
    // }



    public function index()
    {
        $fees = Fee::with('student')->latest()->paginate(10);
        return view('admin.fees.index', compact('fees'));
    }

    public function create()
    {
        $students = Student::all();
        return view('admin.fees.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'session' => 'required',
            'term' => 'required',
            'class' => 'required',
            'amount' => 'required|integer',
            'amount_paid' => 'required|integer',
        ]);

        $balance = $request->amount - $request->amount_paid;

        Fee::create([
            'student_id' => $request->student_id,
            'session' => $request->session,
            'term' => $request->term,
            'class' => $request->class,
            'amount' => $request->amount,
            'amount_paid' => $request->amount_paid,
            'balance' => $balance,
            'payment_method' => $request->payment_method,
            'payment_date' => now(),
        ]);

        return redirect()->route('fees.index')->with('success', 'Fee added successfully');
    }

    public function receipt($id)
    {
        $fee = Fee::with('student')->findOrFail($id);
        return view('admin.fees.receipt', compact('fee'));
    }

    // public function receiptPdf($id)
    // {
    //     $fee = Fee::with('student')->findOrFail($id);
    //     $pdf = PDF::loadView('admin.fees.receipt-pdf', compact('fee'));
    //     return $pdf->download('Receipt_'.$fee->student->name.'.pdf');
    // }









    // 1) Student fee history (student-facing)
    public function studentHistory()
    {
        $student = Student::where('user_id', Auth::id())->first();
        if (!$student) {
            return redirect()->route('dashboard')->with('error','Student profile not found.');
        }

        $fees = Fee::where('student_id', $student->id)->orderBy('payment_date','desc')->get();
        return view('students.fees.history', compact('fees','student'));
    }

    // 2) PDF generation (improved, uses receipt-pdf blade)
    public function receiptPdf($id)
    {
        $fee = Fee::with('student')->findOrFail($id);

        // Authorization: allow admin or the owning student
        if (Auth::user()->role === 'student' && Auth::id() !== $fee->student->user_id) {
            abort(403);
        }

        $pdf = Pdf::loadView('admin.fees.receipt-pdf', compact('fee'))->setPaper('a4', 'portrait');
        return $pdf->download('Receipt_'.$fee->id.'.pdf');
    }

    // 3) Admin finance dashboard (basic stats)
    public function financeDashboard()
    {
        $totalCollected = Fee::sum('amount_paid');
        $totalOutstanding = Fee::sum('balance');
        $totalExpected = Fee::sum('amount');
        $byTerm = Fee::selectRaw('term, SUM(amount_paid) as collected, SUM(balance) as outstanding')
                      ->groupBy('term')->get();

        return view('admin.fees.finance-dashboard', compact('totalCollected','totalOutstanding','totalExpected','byTerm'));
    }

    // 4) CSV import (bank uploads)
    // CSV expected columns: student_email,session,term,class,amount,amount_paid,payment_date,payment_method
    public function importCsv(Request $request)
    {
        $request->validate(['csv_file'=>'required|file|mimes:csv,txt']);

        $path = $request->file('csv_file')->getRealPath();
        $rows = array_map('str_getcsv', file($path));
        // first row header
        $header = array_map('strtolower', array_map('trim', $rows[0]));
        unset($rows[0]);

        $imported = 0;
        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            // find student by email (falls back on name search if needed)
            $student = Student::where('email', $data['student_email'] ?? '')
                        ->orWhere('name', $data['student_name'] ?? '')
                        ->first();

            if (!$student) continue;

            $amount = intval($data['amount'] ?? 0);
            $amount_paid = intval($data['amount_paid'] ?? 0);
            $balance = $amount - $amount_paid;
            $payment_date = $data['payment_date'] ?? now();
            $payment_method = $data['payment_method'] ?? 'Bank';

            Fee::create([
                'student_id' => $student->id,
                'session' => $data['session'] ?? 'N/A',
                'term' => $data['term'] ?? 'N/A',
                'class' => $data['class'] ?? $student->class->name ?? 'N/A',
                'amount' => $amount,
                'amount_paid' => $amount_paid,
                'balance' => $balance,
                'payment_method' => $payment_method,
                'payment_date' => $payment_date,
            ]);

            $imported++;
        }

        return back()->with('success', "Imported {$imported} payment(s) from CSV.");
    }

}
