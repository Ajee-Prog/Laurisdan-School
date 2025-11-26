<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
// use App\Models\SchoolClass;
use App\Models\Book;
use App\Models\SchoolClass;
use App\Models\Exam;
use App\Models\User;

//

class DashboardController extends Controller
{
//     

public function index(){
    // $students = Student::count();
    // $teachers = Teacher::count();
    // $classes = SchoolClass::count();
    // $books = Book::count();
    // $exams = Exam::count();

    // return view('admin.dashboard', compact('students', 'teachers', 'classes', 'books', 'exams'));


        $students = Student::count();
        $teachers = User::where('role', 'teacher')->count();
        $parents = User::where('role', 'parent')->count();
        $classes = SchoolClass::count();
        return view('admin.dashboard', compact('students', 'teachers', 'parents', 'classes'));
}

}
