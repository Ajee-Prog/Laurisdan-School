@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Books</h3>
        <div>
            <a href="{{ route('books.create') }}" class="btn btn-primary">Add Book</a>
            <a href="{{ route('books.export.pdf') }}" class="btn btn-outline-secondary">Download PDF</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Quantity</th>
                        <th>Notes</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    <tr>
                        <td>{{ $loop->iteration + ($books->currentPage()-1)*$books->perPage() }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->quantity }}</td>
                        <td>{{ Str::limit($book->notes, 60) }}</td>
                        <td class="text-right">
                            <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this book?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-3">No books found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $books->links() }}
    </div>
</div>
@endsection


<!-- @extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h2>Books</h2>
  <a href="{{ route('books.create') }}" class="btn btn-primary">Add Book</a>
</div>

<table class="table table-bordered">
  <thead>
    <tr><th>ID</th><th>Title</th><th>Author</th><th>Subject</th><th>Class</th><th>Action</th></tr>
  </thead>
  <tbody>
    @foreach($books as $b)
      <tr>
        <td>{{ $b->id }}</td>
        <td>{{ $b->title }}</td>
        <td>{{ $b->author }}</td>
        <td>{{ $b->subject }}</td>
        <td>{{ $b->class->name }}</td>
        <td>
          <a href="{{ route('books.edit',$b->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('books.destroy',$b->id) }}" method="POST" style="display:inline-block;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
</table>
@endsection -->
