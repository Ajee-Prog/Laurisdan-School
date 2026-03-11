<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAttendanceController extends Controller
{
    public function index()
    {
        $attendance = Attendance::with('student')->latest()->get();

        return view('admin.attendance.index',compact('attendance'));
    }

    public function mark()
    {
        $students = Student::all();

        return view('admin.attendance.mark',compact('students'));
    }

    public function store(Request $request)
    {

        foreach($request->status as $student_id => $status){

            Attendance::create([
                'student_id'=>$student_id,
                'date'=>now(),
                'status'=>$status
            ]);

        }

        return back()->with('success','Attendance saved');

    }
}
