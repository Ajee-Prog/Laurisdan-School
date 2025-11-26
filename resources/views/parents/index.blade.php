
@extends('layouts.app')
@extends('layouts.dashboard')

@section('content')
<div class="container" style="margin-top: 70px;">
  <h2>Parents</h2>
  <a href="{{ route('parents.create') }}" class="btn btn-success mb-3">Add Parent</a>
  <table class="table table-bordered">
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Actions</th></tr>
    @foreach($parents as $p)
    <tr>
      <td>{{ $p->id }}</td>
      <td>{{ $p->full_name }}</td>
      <td>{{ $p->email }}</td>
      <td>{{ $p->phone }}</td>
      <td>{{ $p->address }}</td>
      <td>
        <a href="{{ route('parents.edit',$p) }}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('parents.destroy',$p) }}" method="POST" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-danger btn-sm">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection