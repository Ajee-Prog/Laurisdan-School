<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();
        // $exams = $student->examResults()->latest()->take(5)->get();

        return view('dashboard.student', compact('student'));
    }

    public function dashboard()
    {
        $student = Auth::guard('student')->user();

        $exams = Exam::where('class_id', $student->class_id)->get();

        return view('dashboard.student', compact('student', 'exams'));
    }
}
