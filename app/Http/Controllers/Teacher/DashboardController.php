<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // $teacher = Auth::user();
        // $students = Student::where('class_id', $teacher->teacher->class_id ?? null)->count();
        // $classes = ClassModel::count();

        // return view('teachers.dashboard', compact('teacher', 'students', 'classes'));

        $teacher = Auth::user()->teacherProfile; // Relation from User model
        $class = $teacher->class;
        $students = $class ? $class->students : collect();

        $exams = Exam::where('teacher_id', $teacher->id)->latest()->get();

        return view('teacher.dashboard', compact('teacher', 'class', 'students', 'exams'));
    }
}
