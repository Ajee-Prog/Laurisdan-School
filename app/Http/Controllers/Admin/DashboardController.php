<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassModel;
use App\Models\Book;
use App\Models\Exam;
//

class DashboardController extends Controller
{
//     public function index()
//     {
//         $students = Student::count();
//         $teachers = Teacher::count();
//         $classes = SchoolClass::count();

//         return view('admin.dashboard', compact('students','teachers','classes'));
//     }

public function index(){
    $students = Student::count();
    $teachers = Teacher::count();
    $classes = ClassModel::count();
    $books = Book::count();
    $exams = Exam::count();

    return view('admin.dashboard', compact('students', 'teachers', 'classes', 'books', 'exams'));
}

}
