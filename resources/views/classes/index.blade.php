@extends('layouts.app')
@extends('layouts.dashboard')
@section('content')
<div class="container" style="margin-top:80px;">
  <h2>Classes</h2>
  <a href="{{ route('classes.create') }}" class="btn btn-success mb-3">Add Class</a>
  <table class="table table-bordered">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Actions</th>
    </tr>
    @foreach($classes as $c)
    <tr>
      <td>{{ $c->id }}</td>
      <td>{{ $c->name }}</td>
      <td>
        <a href="{{ route('classes.edit',$c) }}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('classes.destroy',$c) }}" method="POST" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-danger btn-sm">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection