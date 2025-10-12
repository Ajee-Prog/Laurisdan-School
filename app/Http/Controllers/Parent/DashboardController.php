<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ClassModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $parent = Auth::user();
        $children = Student::where('parent_contact', $parent->email->get());
        $classes = ClassModel::count();

        return view('parent.dashboard', compact('parent', 'children'));
    }
}
