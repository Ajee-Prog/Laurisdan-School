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
        // $student = Auth::guard('student')->user();
        $student = auth()->user();

        if (!$student || $student->role !== 'student') {
            abort(403, 'Unauthorized USER');
        }
        // $exams = $student->examResults()->latest()->take(5)->get();

        return view('dashboard.student', compact('student'));
    }

    public function dashboard()
    {
        $user = auth()->user();
        // $student = Auth::guard('student')->user();
        $student = $user->student; // get related student profile

        //   auth()->user()->role === 'student'
        // if (!$student || $student->role !== 'student') {
        //     abort(403, 'Unauthorized USER');
        // }


        $exams = Exam::where('class_id', $student->class_id)->get();

        return view('dashboard.student', compact('student', 'exams'));
        // return view('student.dashboard', compact('student', 'exams'));
    }


}
