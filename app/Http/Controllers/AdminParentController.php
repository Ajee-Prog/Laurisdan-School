<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentModel;
use Illuminate\Support\Facades\Hash;


class AdminParentController extends Controller
{
   public function index() {
        $parents = ParentModel::all();
        return view('admin.parents.index', compact('parents'));
    }

    public function create() {
        return view('admin.parents.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:parents',
            'phone'=>'required',
            'password'=>'required|min:6'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        ParentModel::create($data);
        return redirect()->route('admin.parents.index')->with('success', 'Parent added successfully');
    }


public function destroy($id){
     ParentModel::findOrFail($id)->delete();
        return back()->with('success', 'Parent deleted');
}


}
