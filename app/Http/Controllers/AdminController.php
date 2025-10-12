<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ExamResult;
use App\Models\ClassModel;
use Illuminate\Http\Request;




class AdminController extends Controller
{
    public function index(){
        return view('dashboard.admin');
    }

    public function dashboard(){
        // Students per class
        $studentsPerClass = ClassModel::withCount('students')->get();
        $classLabels = $studentsPerClass->pluck('name');
        $classCounts = $studentsPerClass->pluck('students_count');

        // Average score per subject
        $resultsBySubject = ExamResult::with('subject')->get()->groupBy('subject.name');
        $subjectLabels = [];
        $subjectScores = [];
        foreach ($resultsBySubject as $subject => $res) {
            $subjectLabels[] = $subject;
            $subjectScores[] = round($res->avg('score'), 2);
        }

        // Pass/Fail
        $totalResults = ExamResult::count();
        $passes = ExamResult::where('score', '>=', 50)->count();
        $fails = $totalResults - $passes;



return view('admin.dashboard', compact(
            'classLabels','classCounts',
            'subjectLabels','subjectScores',
            'passes','fails'));




    }

    
}
