@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h2>Exams</h2>
  <a href="{{ route('exams.create') }}" class="btn btn-primary">Add Exam</a>
  <!-- Enable / Disable buttons -->
   {{-- @if($exams->is_active)
    <a href="{{ route('exams.toggle', $exam->id) }}" class="btn btn-danger">Disable</a>
    @else
        <a href="{{ route('exams.toggle', $exam->id) }}" class="btn btn-success">Enable</a>
   @endif --}}
<!-- Disable buttons ends here -->
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Date</th>
      <th>Class</th>
      <th>Action</th></tr>
  </thead>
  <tbody>
    @foreach($exams as $e)
      <tr>
        <td>{{ $e->id }}</td>
        <td>{{ $e->title }}</td>
        <td>{{ $e->exam_date }}</td>
        <td>{{ $e->class->name ?? '' }}</td>
        <td>
          <a href="{{ route('exams.show', $e->id) }}" class="btn btn-sm btn-info">View</a>
          <a href="{{ route('exams.edit',$e->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('exams.destroy',$e->id) }}" method="POST" style="display:inline-block;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection