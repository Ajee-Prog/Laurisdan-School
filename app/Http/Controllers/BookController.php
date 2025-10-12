<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{


     public function __construct()
    {
        $this->middleware('auth'); // restrict to authenticated users (adjust middleware as needed)
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('title')->paginate(10);
        return view('books.index', compact('books'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:100',
            'quantity' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:100',
            'quantity' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted.');

    }

    public function exportPdf(){
        $books = Book::all();
        $pdf = PDF::loadView('books.pdf', compact('books'))->setPaper('a4', 'portrait');

        return $pdf->download('books.pdf');
    }

    // Optional: stream to browser instead of download
//     public function streamPdf()
//     {
//         $books = Book::orderBy('title')->get();
//         $pdf = PDF::loadView('books.pdf', compact('books'))->setPaper('a4', 'portrait');
//         return $pdf->stream('laurisdanschool-books.pdf');
//     }

}
