@extends('layouts.app')
@section('content')
<div class="container" style="margin-top:80px;">
  <h2>Edit Teacher</h2>
  <form method="POST" action="{{ route('teachers.update',$teacher) }}">
    @csrf @method('PUT')
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="full_name" value="{{ $teacher->full_name }}" class="form-control">
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" value="{{ $teacher->email }}" class="form-control">
    </div>
    <div class="mb-3">
      <label>Phone</label>
      <input type="text" name="phone" value="{{ $teacher->phone }}" class="form-control">
    </div>
    <div class="mb-3">
      <label>Subject</label>
      <input type="text" name="subject" value="{{ $teacher->subject }}" class="form-control">
    </div>
    <button class="btn btn-primary">Update</button>
  </form>
</div>
@endsection