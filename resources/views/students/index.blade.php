@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h2>Students</h2>
  <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
</div>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th><th>Name</th><th>Class</th><th>Parent</th><th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($students as $student)
      <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->full_name }}</td>
        <td>{{ $student->class->name }}</td>
        <td>{{ $student->parentModel->full_name }}</td>
        <td>
          <a href="{{ route('students.edit',$student->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('students.destroy',$student->id) }}" method="POST" style="display:inline-block;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
  </tbody>
</table>
@endsection
