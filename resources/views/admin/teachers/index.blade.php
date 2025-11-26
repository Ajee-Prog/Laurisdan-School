<!-- @extends('layouts.admin')
@section('content')
<div class="container mt-4">
  <h3>Teachers List</h3>
  <a href="{{ url('admin/teachers/create') }}" class="btn btn-success mb-2">Add Teacher</a>
  <a href="{{ route('teachers.pdf') }}" class="btn btn-primary mb-2">Download PDF</a>
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
      @foreach($teachers as $t)
      <tr>
        <td><img src="{{ asset('storage/'.$t->image) }}" width="50" class="rounded-circle"></td>
        <td>{{ $t->name }}</td>
        <td>{{ $t->email }}</td>
        <td>{{ $t->phone }}</td>
        <td>
          <a href="{{ url('admin/teachers/edit/'.$t->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <a href="{{ url('admin/teachers/delete/'.$t->id) }}" onclick="return confirm('Delete this teacher?')" class="btn btn-sm btn-danger">Delete</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection -->

@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Teachers</h3>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary">Add Teacher</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($teachers as $teacher)
            <tr>
                <td>{{ $teacher->id }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->email }}</td>
                <td>{{ $teacher->subject }}</td>
                <td>
                    @if($teacher->photo)
                        <img src="{{ asset('storage/'.$teacher->photo) }}" width="50" height="50" class="rounded-circle">
                    @endif
                </td>
                <td>
                    <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete teacher?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
