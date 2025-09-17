@extends('layouts.dashboard')

@section('content')
<h2>Add Term</h2>
<form action="{{ route('terms.store') }}" method="POST">
  @csrf
  <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" required></div>
  <div class="mb-3"><label>Session</label>
    <select name="session_id" class="form-control">
      @foreach($sessions as $s)
        <option value="{{ $s->id }}">{{ $s->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" name="active" value="1" class="form-check-input"> Active
  </div>
  <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection