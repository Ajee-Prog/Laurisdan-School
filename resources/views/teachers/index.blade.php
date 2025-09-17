@extends('layouts.app')
@section('content')
<div class="container">
  <h2>Teachers</h2>
  <a href="{{ route('teachers.create') }}" class="btn btn-success mb-3">Add Teacher</a>
  <table class="table table-bordered">
    <tr>
      <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Subject</th><th>Actions</th>
    </tr>
    @foreach($teachers as $t)
    <tr>
      <td>{{ $t->id }}</td>
      <td>{{ $t->full_name }}</td>
      <td>{{ $t->email }}</td>
      <td>{{ $t->phone }}</td>
      <td>{{ $t->subject }}</td>
      <td>
        <a href="{{ route('teachers.edit',$t) }}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('teachers.destroy',$t) }}" method="POST" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-danger btn-sm">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection