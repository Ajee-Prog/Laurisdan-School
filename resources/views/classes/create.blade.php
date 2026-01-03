@extends('layouts.app')
@section('content')
<div class="container"style="margin-top:80px;">
  <h2>Add Class</h2>
  <form method="POST" action="{{ route('classes.store') }}">
    @csrf
    <div class="mb-3">
      <label>Class Name</label>
      <input type="text" name="name" class="form-control">
    </div>

    <div class="mb-3">
      <label>Class Slug</label>
      <input type="text" name="slug" class="form-control">
    </div>
    <div class="row mb-3">
      <div class="col">
      <label>Parent</label>
      <select name="parent_id" class="form-control">
        @foreach(App\Models\Teacher::all() as $teacher)
          <option value="{{ $teacher->id }}">{{ $teacher->name ?? ''}}</option>
          <option value="{{ $c->id }}" {{old('class_id', $exam->class_id ?? '')==$c->id ? 'selected':''}} > {{ $c->name }}</option>
        @endforeach
    </select>
    </div>
    </div>

    <div class="mb-3">
      <label>Class Description</label>
      <input type="text" name="description" class="form-control">
    </div>
    <button class="btn btn-success">Save</button>
  </form>
</div>
@endsection