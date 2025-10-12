@extends('layouts.app')

@section('content')
<div class="container " style="margin-top:70px" >
    <h3 class="my-5 mt-4">Edit Book</h3>

    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" required value="{{ old('title', $book->title) }}">
            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}">
            @error('author') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>ISBN</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}">
            @error('isbn') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="quantity" min="0" class="form-control" value="{{ old('quantity', $book->quantity) }}">
            @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" rows="3" class="form-control">{{ old('notes', $book->notes) }}</textarea>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection





