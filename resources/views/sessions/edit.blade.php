@extends('layouts.dashboard')

@section('content')
<h2>Edit Session</h2>
<form action="{{ route('sessions.update',$session->id) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" value="{{ $session->name }}"></div>
  <div class="mb-3 form-check">
    <input type="checkbox" name="active" value="1" class="form-check-input" {{ $session->active ? 'checked':'' }}> Active
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection