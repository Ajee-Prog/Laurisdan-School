@extends('layouts.admin')
@section('content')
<div class="container mt-4">
  <h3>Edit Parent</h3>
  <form action="{{ url('admin/parents/update/'.$parent->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ $parent->name }}" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $parent->email }}" class="form-control" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Phone</label>
        <input type="text" name="phone" value="{{ $parent->phone }}" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Change Image</label>
        <input type="file" name="image" class="form-control">
        @if($parent->image)
          <img src="{{ asset('storage/'.$parent->image) }}" width="70" class="mt-2 rounded">
        @endif
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.parents') }}" class="btn btn-secondary">Back</a>
  </form>
</div>
@endsection