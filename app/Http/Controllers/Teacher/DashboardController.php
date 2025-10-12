<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassModel;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();
        $students = Student::where('class_id', $teacher->teacher->class_id ?? null)->count();
        $classes = ClassModel::count();

        return view('teachers.dashboard', compact('teacher', 'students', 'classes'));
    }
}
