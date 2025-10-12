@extends('layouts.dashboard')

@section('content')
<h2>Add Session</h2>
<form action="{{ route('sessions.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" name="active" value="1" class="form-check-input"> Active
  </div>
  <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection