<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Student;
use App\Models\ExamResult;
use App\Models\SchoolClass;
use App\Models\Exam;
use App\Models\ParentModel;
use App\Models\Teacher;
use Barryvdh\DomPDF\Facade\PDF;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(){

                $students = Student::count();
                $teachers = Teacher::count();
                $classes = SchoolClass::count();
                $books = Book::count();
                $exams = Exam::count();


        return view('dashboard.admin', compact('students', 'teachers', 'classes', 'books', 'exams') );
    }

    public function dashboard(){
        // Students per class
        $studentsPerClass = SchoolClass::withCount('students')->get();
        $classLabels = $studentsPerClass->pluck('name');
        $classCounts = $studentsPerClass->pluck('students_count');

        // Average score per subject
        $resultsBySubject = ExamResult::with('subject')->get()->groupBy('subject.name');
        $subjectLabels = [];
        $subjectScores = [];
        foreach ($resultsBySubject as $subject => $res) {
            $subjectLabels[] = $subject;
            // $subjectScores[] = round($res->avg('score'), 2);
            
        }

        // Pass/Fail
        $totalResults = ExamResult::count();
        $passes = ExamResult::where('score', '>=', 50)->count();
        $fails = $totalResults - $passes;



            return view('admin.dashboard', compact(
                'classLabels','classCounts',
                'subjectLabels','subjectScores',
                'passes','fails'
            ));




        }


        // ======== TEACHERS ======== //
    public function teachers()
    {
        $teachers = Teacher::all();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function storeTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:teachers',
            'phone' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->phone = $request->phone;
        $teacher->password = Hash::make('teacher123');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('teachers', 'public');
            $teacher->image = $path;
        }

        $teacher->save();

        return redirect()->route('admin.teachers')->with('success', 'Teacher added successfully!');
    }


    public function editTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function updateTeacher(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->phone = $request->phone;

        if ($request->hasFile('image')) {
            if ($teacher->image) Storage::disk('public')->delete($teacher->image);
            $teacher->image = $request->file('image')->store('teachers', 'public');
        }

        $teacher->save();
        return redirect()->route('admin.teachers')->with('success', 'Teacher updated!');
    }

     public function deleteTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        if ($teacher->image) Storage::disk('public')->delete($teacher->image);
        $teacher->delete();
        return redirect()->back()->with('success', 'Teacher deleted.');
    }

    public function teachersPDF()
    {
        $teachers = Teacher::all();
        $pdf = PDF::loadView('admin.teachers.pdf', compact('teachers'));
        return $pdf->download('teachers-list.pdf');
    }


    // ======== STUDENTS ======== //
    public function students()
    {
        $students = Student::with('class')->get();
        return view('admin.students.index', compact('students'));
    }

    public function createStudent()
    {
        return view('admin.students.create');
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'class_id' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->class_id = $request->class_id;
        $student->password = Hash::make('student123');

        if ($request->hasFile('image')) {
            $student->image = $request->file('image')->store('students', 'public');
        }

        $student->save();
        return redirect()->route('admin.students')->with('success', 'Student added!');
    }

     public function editStudent($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    public function updateStudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->class_id = $request->class_id;

        if ($request->hasFile('image')) {
            if ($student->image) Storage::disk('public')->delete($student->image);
            $student->image = $request->file('image')->store('students', 'public');
        }

        $student->save();
        return redirect()->route('admin.students')->with('success', 'Student updated!');
    }

    public function deleteStudent($id)
    {
        $student = Student::findOrFail($id);
        if ($student->image) Storage::disk('public')->delete($student->image);
        $student->delete();
        return redirect()->back()->with('success', 'Student deleted.');
    }

    public function studentsPDF()
    {
        $students = Student::all();
        $pdf = PDF::loadView('admin.students.pdf', compact('students'));
        return $pdf->download('students-list.pdf');
    }


    // ======== PARENTS ======== //
    public function parents()
    {
        $parents = ParentModel::all();
        return view('admin.parents.index', compact('parents'));
    }

    public function createParent()
    {
        return view('admin.parents.create');
    }

    public function storeParent(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:parents',
            'phone' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $parent = new ParentModel();
        $parent->name = $request->name;
        $parent->email = $request->email;
        $parent->phone = $request->phone;
        $parent->password = Hash::make('parent123');

        if ($request->hasFile('image')) {
            $parent->image = $request->file('image')->store('parents', 'public');
        }

        $parent->save();
        return redirect()->route('admin.parents')->with('success', 'Parent added!');
    }

    public function editParent($id)
    {
        $parent = ParentModel::findOrFail($id);
        return view('admin.parents.edit', compact('parent'));
    }

    public function updateParent(Request $request, $id)
    {
        $parent = ParentModel::findOrFail($id);
        $parent->name = $request->name;
        $parent->email = $request->email;
        $parent->phone = $request->phone;

        if ($request->hasFile('image')) {
            if ($parent->image) Storage::disk('public')->delete($parent->image);
            $parent->image = $request->file('image')->store('parents', 'public');
        }

        $parent->save();
        return redirect()->route('admin.parents')->with('success', 'Parent updated!');
    }

    public function deleteParent($id)
    {
        $parent = ParentModel::findOrFail($id);
        if ($parent->image) Storage::disk('public')->delete($parent->image);
        $parent->delete();
        return redirect()->back()->with('success', 'Parent deleted.');
    }


public function parentsPDF(){
        $parents = ParentModel::all();
        $pdf = PDF::loadView('admin.parents.pdf', compact('parents'));
        return $pdf->download('parents-list.pdf');
}













    
}
