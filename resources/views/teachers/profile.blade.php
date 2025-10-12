@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>My Profile</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('teacher.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $teacher->name) }}">
    </div>

    <div class="mb-3">
      <label>Subject</label>
      <input type="text" name="subject" class="form-control" value="{{ old('subject', $teacher->subject) }}">
    </div>

    <div class="mb-3">
      <label>Profile Photo</label><br>
      @if($teacher->image)
        <img src="{{ asset($teacher->image) }}" width="80" class="rounded mb-2">
      @endif
      <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update Profile</button>
  </form>
</div>
@endsection