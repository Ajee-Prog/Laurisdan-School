<!-- <h1>Hello index Student</h1>
@extends('layouts.admin')
@section('content')
<div class="container mt-4">
  <h3>Teachers List</h3>
  <a href="{{ url('admin/students/create') }}" class="btn btn-success mb-2">Add Student</a>
  <a href="{{ route('students.pdf') }}" class="btn btn-primary mb-2">Download PDF</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($students as $st)
      <tr>
        <td><img src="{{ asset('storage/'.$t->image) }}" width="50" class="rounded-circle"></td>
        <td>{{ $st->name }}</td>
        <td>{{ $st->email }}</td>
        <td>{{ $st->phone }}</td>
        <td>
          <a href="{{ url('admin/students/edit/'.$st->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <a href="{{ url('admin/students/delete/'.$st->id) }}" onclick="return confirm('Delete this teacher?')" class="btn btn-sm btn-danger">Delete</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection -->



@extends('layouts.admin')

@section('title', ' Student')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Students</h3>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Code</th>
                <th>Class</th>
                <th>Email</th>
                <th>Parent Phone</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->full_name }}</td>
                <td>{{ $student->student_code }}</td>
                <td>{{ $student->class }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->parent_phone }}</td>
                <td>
                    @if($student->photo)
                        <img src="{{ asset('storage/'.$student->photo) }}" width="50" height="50" class="rounded-circle">
                    @endif
                </td>
                <td>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete student?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection