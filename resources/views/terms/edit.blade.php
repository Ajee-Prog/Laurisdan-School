@extends('layouts.dashboard')

@section('content')
<h2>Edit Term</h2>
<form action="{{ route('terms.update',$term->id) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" value="{{ $term->name }}"></div>
  <div class="mb-3"><label>Session</label>
    <select name="session_id" class="form-control">
      @foreach($sessions as $s)
        <option value="{{ $s->id }}" {{ $term->session_id==$s->id ? 'selected':'' }}>{{ $s->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" name="active" value="1" class="form-check-input" {{ $term->active ? 'checked':'' }}> Active
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection