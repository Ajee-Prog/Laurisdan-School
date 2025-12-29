@extends('layouts.app')
@extends('layouts.dashboard')
@section('content')
<div class="container-fluid mt-5" style="margin-top:80px;">
  <div class="d-flex justify-content-between mb-3">
  <h2>Teachers</h2>
  <a href="{{ route('teachers.create') }}" class="btn btn-primary mb-3">Add Teacher 11</a>
  </div>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif




  <table class="table table-bordered table-striped table-bordered">
    <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Photo</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Subject</th>
      <th>Class</th>
      <th>Address</th>
      <th>Actions</th>
    </tr>
  </thead >
  <tbody>
    @foreach($teachers as $t)
    <tr>
      <td>{{ $t->id }}</td>
      <td>{{ $t->name }}</td>
      <td>
        @if($t->image)
                        <img src="{{ asset('storage/'.$t->image) }}" width="50" height="50" class="rounded-circle">
          @endif
      </td>
      <td>{{ $t->email }}</td>
      <td>{{ $t->phone }}</td>
      <td>{{ $t->subject }}</td>
      <td>{{ $t->class->name ?? 'N/A' }}</td>
      <td>{{ $t->address }}</td>
      <td>
        <!-- <a href="{{ route('teachers.edit',$t) }}" class="btn btn-warning btn-sm">Edit</a> -->
        <a href="{{ route('teachers.edit',$t->id) }}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('teachers.destroy',$t) }}" method="POST" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-danger btn-sm" style="background-color: red; color:white;  text-align:center; padding:5px; ">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
  </table>
</div>






<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Teachers</h3>
        <a href="{{ route('teachers.create') }}" class="btn btn-success">Add Teacher</a>
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
                        <button class="btn btn-danger btn-sm" style="background-color: red;" onclick="return confirm('Delete teacher?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection


