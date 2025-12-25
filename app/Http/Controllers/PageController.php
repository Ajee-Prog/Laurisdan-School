<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;


// use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('welcome', [
        'activities' => Activity::latest()->take(6)->get(),
        // 'news'       => News::latest()->take(5)->get(),
    ] );
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }



public function sendContact(Request $request){
    $request->validate([
             'name'    => 'required|string|max:255',
             'email'   => 'required|email',
             'message' => 'required|string|min:5',
         ]);

        //  Save to DB
        Contact::create($request->only('name', 'email', 'message'));

        // Send email (requires MAIL setup in .env)
        Mail::raw($request->message, function ($msg) use ($request) {
            $msg->to('admin@laurisdanschool.com')
                ->subject('New Contact Message from ' . $request->name)
                ->replyTo($request->email);
        });

        return back()->with('success', 'Your message has been sent and stored!');
}


}

