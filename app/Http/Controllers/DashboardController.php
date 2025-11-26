<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\ParentModel;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {


        $user = Auth::user();

        // If somehow no role exists
        if (!$user || !$user->role) {
            abort(403, 'No role assigned to this user.');
        }

        switch ($user->role) {

            /*
            |--------------------------------------------------------------------------
            | ADMIN DASHBOARD
            |--------------------------------------------------------------------------
            */
            case 'admin':

                return view('dashboard.admin', [
                    'students' => Student::count(),
                    'teachers' => Teacher::count(),
                    'classes'  => SchoolClass::count(),
                    'books'    => Book::count(),
                    'exams'    => Exam::count(),
                ]);

            /*
            |--------------------------------------------------------------------------
            | TEACHER DASHBOARD
            |--------------------------------------------------------------------------
            */
            case 'teacher':

                $teacher = Teacher::where('user_id', $user->id)->first();

                return view('dashboard.teacher', [
                    'teacher' => $teacher
                ]);

            /*
            |--------------------------------------------------------------------------
            | STUDENT DASHBOARD
            |--------------------------------------------------------------------------
            */
            case 'student':

                $student = Student::where('user_id', $user->id)->first();
                // $student = Student::where('user_id', $user->id)->with('schoolClass')->first();
                $exams   = Exam::all(); // list exams they can take
                // $exams = $student ? Exam::where('class_id', $student->class_id)->get() : collect();

                return view('dashboard.student', [
                    'student' => $student,
                    'exams'   => $exams
                ]);

            /*
            |--------------------------------------------------------------------------
            | PARENT DASHBOARD
            |--------------------------------------------------------------------------
            */
            case 'parent':

                $parent = ParentModel::where('user_id', $user->id)->first();
                // $children = Student::where('parent_id', optional($parent)->id)->get();
                $children = $parent ? Student::where('parent_id', $parent->id)->get() : collect();

                return view('dashboard.parent', [
                    'parent'   => $parent,
                    'children' => $children
                ]);

            /*
            |--------------------------------------------------------------------------
            | UNKNOWN ROLE
            |--------------------------------------------------------------------------
            */
            default:
                abort(403, 'Unauthorized access.');
        }







        // each of these functions can be called inside switch
        

        // $role = Auth::user()->role;

            //     $students = Student::count();
            //     $teachers = Teacher::count();
            //     $classes = SchoolClass::count();
            //     $books = Book::count();
            //     $exams = Exam::count();



            // if ($role === 'admin') {

            //     return view('dashboard.admin', compact('students', 'teachers', 'classes', 'books', 'exams'));
            // // return redirect()->route('admin.dashboard');
            // }


            // if ($role === 'teacher') {

            //     // $user = User::all();

            //     // $teacher = Teacher::where('user_id', $user->id)->first();
            //     return view('dashboard.teacher', compact('teachers'));
            // // return redirect()->route('teacher.dashboard');
            // }


            // if ($role === 'student') {
            // $student = Student::where('user_id', Auth::id())->first();
            // return view('dashboard.student', compact('student'));
            // // return view('students.index', compact('student'));
            // }


            // if ($role === 'parent') {

            //     // $parent = ParentModel::where('user_id', $user->id)->first();
            //     return view('dashboard.parent', compact('parent'));
            // // return redirect()->route('parent.dashboard');
            // }


            // abort(403);










            
        // $user = Auth::user();

        // switch ($user->role) {
        //     case 'admin':
        //         $students = Student::count();
        //         $teachers = Teacher::count();
        //         $classes = ClassModel::count();
        //         $books = Book::count();
        //         $exams = Exam::count();

        //         // return view('admin.dashboard', compact('students', 'teachers', 'classes', 'books', 'exams'));
        //         return view('dashboard.admin', compact('students', 'teachers', 'classes', 'books', 'exams'));
        //         // return view('dashboard.admin');
        //     case 'teacher':
        //         $teacher = Teacher::where('user_id', $user->id)->first();
        //         return view('dashboard.teacher', compact('teacher'));
        //     case 'student':
        //         $student = Student::where('user_id', $user->id)->first();
        //         return view('dashboard.student', compact('student'));
        //     case 'parent':
        //         $parent = ParentModel::where('user_id', $user->id)->first();
        //         return view('dashboard.parent', compact('parent'));
        //     default:
        //         abort(403, 'Unauthorized');
        // }
    }


    // each of these functions can be called inside switch
    public function adminDashboard()
    {
        return view('dashboard.admin', [
            'students' => Student::count(),
            'teachers' => Teacher::count(),
            'classes'  => SchoolClass::count(),
            'books'    => Book::count(),
            'exams'    => Exam::count(),
        ]);
    }

    public function teacherDashboard()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();
        return view('dashboard.teacher', ['teacher' => $teacher]);
    }

    public function parentDashboard()
    {
        $user = Auth::user();
        $parent = ParentModel::where('user_id', $user->id)->first();
        $children = $parent ? Student::where('parent_id', $parent->id)->get() : collect();
        return view('dashboard.parent', ['parent' => $parent, 'children' => $children]);
    }
}
