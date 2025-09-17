@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h2>Sessions</h2>
  <a href="{{ route('sessions.create') }}" class="btn btn-primary">Add Session</a>
</div>

<table class="table table-bordered">
  <thead>
    <tr><th>ID</th><th>Name</th><th>Active</th><th>Action</th></tr>
  </thead>
  <tbody>
    @foreach($sessions as $s)
      <tr>
        <td>{{ $s->id }}</td>
        <td>{{ $s->name }}</td>
        <td>{{ $s->active ? 'Yes' : 'No' }}</td>
        <td>
          <a href="{{ route('sessions.edit',$s->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('sessions.destroy',$s->id) }}" method="POST" style="display:inline-block;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection