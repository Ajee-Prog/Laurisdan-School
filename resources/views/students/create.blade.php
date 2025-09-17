@extends('layouts.dashboard')

@section('content')
<h2>Add Student</h2>
<form action="{{ route('students.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Full Name</label>
    <input type="text" name="full_name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Student Code</label>
    <input type="text" name="student_code" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Parent</label>
    <select name="parent_id" class="form-control">
      @foreach($parents as $p)
        <option value="{{ $p->id }}">{{ $p->full_name }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label>Class</label>
    <select name="class_id" class="form-control">
      @foreach($classes as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection