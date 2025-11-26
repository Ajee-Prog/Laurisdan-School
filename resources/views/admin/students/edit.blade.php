@extends('layouts.admin')
@section('content')
<div class="container mt-4">
  <h3>Edit Student</h3>
  <form action="{{ url('admin/students/update/'.$student->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ $student->name }}" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $student->email }}" class="form-control" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Class</label>
        <select name="class_id" class="form-control">
          @foreach(App\Models\Classes::all() as $class)
            <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6 mb-3">
        <label>Change Image</label>
        <input type="file" name="image" class="form-control">
        @if($student->image)
          <img src="{{ asset('storage/'.$student->image) }}" width="70" class="mt-2 rounded">
        @endif
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.students') }}" class="btn btn-secondary">Back</a>
  </form>
</div>
@endsection