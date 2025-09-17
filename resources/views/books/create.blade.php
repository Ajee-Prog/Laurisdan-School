@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Add Book</h3>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ old('author') }}">
            @error('author') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>ISBN</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}">
            @error('isbn') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="quantity" min="0" class="form-control" value="{{ old('quantity', 1) }}">
            @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" rows="3" class="form-control">{{ old('notes') }}</textarea>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection


<!-- 
@extends('layouts.dashboard')

@section('content')
<h2>Add Book</h2>
<form action="{{ route('books.store') }}" method="POST">
  @csrf
  <div class="mb-3"><label>Title</label><input type="text" name="title" class="form-control" required></div>
  <div class="mb-3"><label>Author</label><input type="text" name="author" class="form-control"></div>
  <div class="mb-3"><label>Subject</label><input type="text" name="subject" class="form-control"></div>
  <div class="mb-3"><label>Class</label>
    <select name="class_id" class="form-control">
      @foreach($classes as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
 -->