<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
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
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('news'), $imageName);
        }

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('news.index')->with('success', 'News created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $news = News::findOrFail($id);
        // return view('admin.news.edit', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
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
        $news = News::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        $imageName = $news->image;
        if ($request->hasFile('image')) {
            @unlink(public_path('news/'.$news->image));
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('news'), $imageName);
        }

        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName
        ]);

        return redirect()->route('news.index')->with('success', 'News updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->image) {
            @unlink(public_path('news/'.$news->image));
        }

        $news->delete();

        return back()->with('success', 'News deleted');
    }

    public function publicNews()
    {
        $news = News::latest()->paginate(6);
        return view('frontend.news.index', compact('news'));
    }

    public function singleNews($id)
    {
        $news = News::findOrFail($id);
        return view('frontend.news.single', compact('news'));
    }
}
