<?php

namespace App\Http\Controllers;

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
        $this->middleware(['auth', 'role:parent']);
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
        return view('admin.parents.index', compact('parents'));
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
        return view('admin.parents.create', compact('students'));
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
            'email' => 'required|email|unique:parent_models',
            
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|min:6',
            'student_id' => 'nullable|array',
            // 'parent_id' => 'nullable|exists:parent_models,id',
            // 'address' => 'nullable|string',
            // 'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'parent'
                ]);

        // if ($request->hasFile('passport')) {
        //     $validated['passport'] = $request->file('passport')->store('students', 'public');
        // }

        $imagePath = $request->file('image') ? 
        $request->file('image')->store('parent', 'public') : null;

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parent = ParentModel::findOrFail($id);
        $students = Student::all();
        return view('admin.parents.edit', compact('parent', 'students'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        ]);

        $parent->students()->sync($request->student_id ?? []);

        return redirect()->route('parents.index')->with('success', 'Parent updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
