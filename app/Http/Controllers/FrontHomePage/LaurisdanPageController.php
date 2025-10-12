<?php

namespace App\Http\Controllers\FrontHomePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaurisdanPageController extends Controller
{
    public function index(){
        // return view('laurisdan.index');
        // return view('laurisdan.welcomes');
        return view('pages.welcome');
    }

    public function about(){
        return view('pages.about');
        // return view('laurisdan.welcomes');
    }
    public function contact(){
        return view('pages.contact');
        // return view('laurisdan.welcomes');
    }

    public function sendContact(Request $request){
        $request->validate([
            'name' => 'required | string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:5',
        ]);

        Mail::raw($request->message, function($msg) use ($request){
            $msg->to('admin@laurisdanschool.com')->subject('New Contact Message from'.$request->name)->replyTo($request->mail);
        });

        return back()->with('success', 'Thank you for contacting us! We will reply soon');
    }
}
