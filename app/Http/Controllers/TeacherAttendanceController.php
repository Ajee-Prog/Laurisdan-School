<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{

    public function index()
    {
        $attendances = TeacherAttendance::with('teacher')->latest()->get();
        return view('admin.teacher_attendance.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $teachers = Teacher::all();
        return view('admin.teacher_attendance.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required',
            'date' => 'required|date',
            'status' => 'required'
        ]);

        TeacherAttendance::updateOrCreate(
            [
                'teacher_id' => $request->teacher_id,
                'date' => $request->date
            ],
            ['status' => $request->status]
        );

        return redirect()->route('teacher-attendance.index')
            ->with('success', 'Attendance saved');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
