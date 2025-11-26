<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class ParentController extends Controller
{
    public function index()
    {
        $parents = User::where('role', 'parent')->get();
        return view('admin.parents.index', compact('parents'));
    }

    public function create()
    {
        return view('admin.parents.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'parent';

        User::create($data);
        return redirect()->route('admin.parents.index')->with('success', 'Parent registered successfully!');
    }


public function destroy($id){
    User::findOrFail($id)->delete();
        return back()->with('success', 'Parent deleted!');
}

}
