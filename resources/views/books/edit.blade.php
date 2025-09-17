@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Book</h3>

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




<!-- @extends('layouts.dashboard')

@section('content')
<h2>Edit Book</h2>
<form action="{{ route('books.update',$book->id) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3"><label>Title</label><input type="text" name="title" class="form-control" value="{{ $book->title }}"></div>
  <div class="mb-3"><label>Author</label><input type="text" name="author" class="form-control" value="{{ $book->author }}"></div>
  <div class="mb-3"><label>Subject</label><input type="text" name="subject" class="form-control" value="{{ $book->subject }}"></div>
  <div class="mb-3"><label>Class</label>
    <select name="class_id" class="form-control">
      @foreach($classes as $c)
        <option value="{{ $c->id }}" {{ $book->class_id==$c->id ? 'selected':'' }}>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection -->
