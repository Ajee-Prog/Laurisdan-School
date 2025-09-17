@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h2>Activities</h2>
  <a href="{{ route('activities.create') }}" class="btn btn-primary">Add Activity</a>
</div>

<table class="table table-bordered">
  <thead>
    <tr><th>ID</th><th>Title</th><th>Description</th><th>Date</th><th>Action</th></tr>
  </thead>
  <tbody>
    @foreach($activities as $a)
      <tr>
        <td>{{ $a->id }}</td>
        <td>{{ $a->title }}</td>
        <td>{{ $a->description }}</td>
        <td>{{ $a->activity_date }}</td>
        <td>
          <a href="{{ route('activities.edit',$a->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('activities.destroy',$a->id) }}" method="POST" style="display:inline-block;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
  </table>
@endsection
