@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h2>Terms</h2>
  <a href="{{ route('terms.create') }}" class="btn btn-primary">Add Term</a>
</div>

<table class="table table-bordered">
  <thead>
    <tr><th>ID</th><th>Name</th><th>Session</th><th>Active</th><th>Action</th></tr>
  </thead>
  <tbody>
    @foreach($terms as $t)
      <tr>
        <td>{{ $t->id }}</td>
        <td>{{ $t->name }}</td>
        <td>{{ $t->session->name }}</td>
        <td>{{ $t->active ? 'Yes' : 'No' }}</td>
        <td>
          <a href="{{ route('terms.edit',$t->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('terms.destroy',$t->id) }}" method="POST" style="display:inline-block;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection