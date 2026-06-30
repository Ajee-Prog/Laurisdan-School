<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use App\Models\ParentModel;
use App\Models\Student;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['auth', 'role:admin,teacher']);
        $this->middleware(['auth', 'role:parent,admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $parents = ParentModel::with('students')->latest()->paginate(10);
        // return view('students.index', compact('students'));
        return view('parents.index', compact('parents'));
        // return view('admin.parents.index', compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        // $classes = ClassModel::all();
        // $classes = Classroom::all();
        // return view('students.create', compact('parents','classes'));
        // return view('admin.parents.create', compact('students'));
        return view('parents.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:parents',

            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|min:6',
            'relation' => 'required',
            // 'student_id' => 'nullable|array',
            // 'parent_id' => 'nullable|exists:parent_models,id',
            // 'address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

          /**  Check if user already exists */
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        // Create user only if not exists
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'parent',
        ]);
    }
        // ----------------
        // Upload image if exists
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('parents', 'public');
        }

        // Ends_-----------------


        // Student::create($validated);
       $parent = ParentModel::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'relation' => $request->relation,
            // 'class_id' => $request->class_id,
            // 'parent_id' => $request->parent_id,
            'image' => $imagePath,
            'password' => Hash::make($request->password)
        ]);

        if ($request->student_id) {
            $parent->students()->sync($request->student_id);
        }

        return redirect()->route('parents.index')->with('success', 'Parent added successfully.');




        // return redirect()->route('admin.parents.index')->with('success', 'Parent Registered successfully!');


    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $parent = ParentModel::findOrFail($id);
        $students = Student::all();
        // return view('admin.parents.edit', compact('parent', 'students'));
        return view('parents.edit', compact('parent', 'students'));

    }


    public function update(Request $request, $id)
    {
        $parent = ParentModel::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:parent_models,email,'.$parent->id,
            'phone'     => 'required',
            'address'   => 'required',
            'student_id' => 'nullable|array',
        ]);

        $parent->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'student_id' => $request->student_id
                            ? json_encode($request->student_id)
                            : null,
        ]);

        $parent->students()->sync($request->student_id ?? []);

        return redirect()->route('parents.index')->with('success', 'Parent updated successfully.');

    }





    public function destroy($id)
    {
        $parent = ParentModel::findOrFail($id);
        $parent->students()->detach();
        $parent->delete();
        return back()->with('success', 'Parent deleted successfully.');

    }

    public function exportPDF(){
        $parents = ParentModel::with('students')->get();
        $pdf = Pdf::loadView('admin.parents.pdf', compact('parents'));
        return $pdf->download('parents-list.pdf');

    }


    public function childResults()
    {
        // $parent = auth()->user();
         $student = auth()->user()->student;
        $parent = ParentModel::all();

        $students = $parent->students()->with('results.exam')->get();

        return view('parents.results', compact('students'));
    }

    public function parentResult()
    {
        $student = Student::where('parent_id', auth()->id())->first();

        $results = ExamResult::where('student_id', $student->id)->get();

        return view('parents.result', compact('results'));
    }

    // New function implementation for result
    public function viewResults(Request $request, $id)
    {
        $student = \App\Models\Student::findOrFail($id);

        $results = \App\Models\ExamResult::with(['exam','term','session'])
            ->where('student_id', $student->id)
            ->where('term_id', $request->term_id)
            ->where('session_id', $request->session_id)
            ->get();

        return view('parent.results', compact('student','results'));
    }

    // Lets compare the New from old up
    // public function viewResults($childId)
    // {
    //     $parent = auth()->user();

    //     $student = $parent->children()->findOrFail($childId);

    //     $results = ExamResult::where('student_id', $student->id)->get();

    //     return view('parent.results', compact('student','results'));
    // }
    // Compare ends

    public function books(Request $request, $id)
    {
        $student = \App\Models\Student::findOrFail($id);

        $books = \App\Models\Book::where('class_id', $student->class_id)
            ->where('term_id', $request->term_id)
            ->where('session_id', $request->session_id)
            ->get();

        return view('parent.books', compact('books','student'));
    }

    public function downloadPdf($id)
    {
        $student = \App\Models\Student::findOrFail($id);

        $results = \App\Models\ExamResult::where('student_id', $id)->get();

        $pdf = Pdf::loadView('parent.result_pdf', compact('student','results'));

        return $pdf->download($student->name.'_result.pdf');
    }
}
