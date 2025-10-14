@extends('layouts.app')
@extends('layouts.dashboard')
@section('content')
<div class="container" style="margin-top:80px;">
  <h2>Add Teacher</h2>
  <form method="POST" action="{{ route('teachers.store') }}">
    @csrf
    <div class="mb-3">
      <label>Full Name</label>
      <input type="text" name="full_name" class="form-control">
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
      <label>Phone</label>
      <input type="text" name="phone" class="form-control">
    employee_no
    </div>
    <div class="mb-3">
      <label>Subject</label>
      <input type="text" name="subject" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">>Address</label>
      <input type="text" name="address" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">>Employee No:</label>
      <input type="text" name="employee_no" class="form-control" required>
    </div>
  <div class="mb-3">
    <label class="form-label">Upload Image</label>
    <input type="file" name="image" class="form-control" required>
  </div>
    <button class="btn btn-success">Save</button>
  </form>
</div>
@endsection