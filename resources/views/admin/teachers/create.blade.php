<!-- @extends('layouts.admin')
@section('content')
<div class="container mt-4">
  <h3>Add New Teacher</h3>
  <form action="{{ url('admin/teachers/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Profile Image</label>
        <input type="file" name="image" class="form-control">
      </div>
    </div>
    <button type="submit" class="btn btn-success">Save Teacher</button>
    <a href="{{ route('admin.teachers') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection -->


@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Add New Teacher</h3>

    <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mt-3">
            <div class="col-md-6">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-md-6 mt-2">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <div class="col-md-6 mt-2">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control">
            </div>

            <div class="col-md-6 mt-2">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="col-md-6 mt-2">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control">
            </div>
        </div>

        <button class="btn btn-success mt-3">Save Teacher</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
@endsection