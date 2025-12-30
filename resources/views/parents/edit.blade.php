@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 70px;">
  <h2>Edit Parent</h2>
  <form method="POST" action="{{ route('parents.update',$parent) }}">
    @csrf @method('PUT')

    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" value="{{ $parent->full_name }}" class="form-control">
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" value="{{ $parent->email }}" class="form-control">
    </div>

    <div class="mb-3">
      <label>Phone</label>
      <input type="text" name="phone" value="{{ $parent->phone }}" class="form-control">
    </div>

    <div class="mb-3">
      <label>Address</label>
      <input type="text" name="address" value="{{ $parent->address }}" class="form-control">
    </div>

    <select name="student_id[]" class="form-control" multiple>
      @foreach($students as $student)
          <option value="{{ $student->id }}"
              {{ in_array($student->id, $parent->student_id ?? []) ? 'selected' : '' }}>
              {{ $student->first_name }} {{ $student->last_name }}
          </option>
      @endforeach
    </select>

    <button class="btn btn-primary">Update</button>
  </form>
</div>
@endsection