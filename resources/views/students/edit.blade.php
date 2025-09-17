@extends('layouts.dashboard')

@section('content')
<h2>Edit Student</h2>
<form action="{{ route('students.update',$student->id) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3">
    <label>Full Name</label>
    <input type="text" name="full_name" class="form-control" value="{{ $student->full_name }}">
  </div>
  <div class="mb-3">
    <label>Student Code</label>
    <input type="text" name="student_code" class="form-control" value="{{ $student->student_code }}">
  </div>
  <div class="mb-3">
    <label>Parent</label>
    <select name="parent_id" class="form-control">
      @foreach($parents as $p)
        <option value="{{ $p->id }}" {{ $student->parent_id==$p->id ? 'selected':'' }}>{{ $p->full_name }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label>Class</label>
    <select name="class_id" class="form-control">
      @foreach($classes as $c)
        <option value="{{ $c->id }}" {{ $student->class_id==$c->id ? 'selected':'' }}>{{ $c->name }}</option>
      @endforeach
    </select>
    </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
