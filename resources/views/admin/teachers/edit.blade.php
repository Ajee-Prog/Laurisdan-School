@extends('layouts.admin')
@section('content')
<div class="container mt-4">
  <h3>Edit Teacher</h3>
  <form action="{{ url('admin/teachers/update/'.$teacher->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ $teacher->name }}" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $teacher->email }}" class="form-control" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Phone</label>
        <input type="text" name="phone" value="{{ $teacher->phone }}" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Change Profile Image</label>
        <input type="file" name="image" class="form-control">
        @if($teacher->image)
          <img src="{{ asset('storage/'.$teacher->image) }}" width="70" class="mt-2 rounded">
        @endif
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.teachers') }}" class="btn btn-secondary">Back</a>
  </form>
</div>
@endsection