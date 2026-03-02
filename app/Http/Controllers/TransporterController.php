<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransporterController extends Controller
{
    public function index()
    {
        $transporters = Transporter::with('students')->get();
        return view('admin.transporters.index', compact('transporters'));
    }

    public function create()
    {
        $students = Student::all();
        return view('admin.transporters.create', compact('students'));
    }

    public function store(Request $request)
    {
        $transporter = Transporter::create($request->all());

        if ($request->students) {
            $transporter->students()->sync($request->students);
        }

        return redirect()->route('transporters.index')
            ->with('success', 'Transporter saved');
    }
}
