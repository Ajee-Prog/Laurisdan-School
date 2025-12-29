<!-- @extends('layouts.app') -->
@extends('layouts.dashboard')
@section('content')
<div class="container" style="margin-top: 90px;">
  <h2>Add Parent</h2>
  <form method="POST" action="{{ route('parents.store') }}"  enctype="multipart/form-data" >
    @csrf
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" placeholder="Parent Full Name">
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" placeholder="Email Address">
    </div>

    <div class="mb-3">
    <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Phone</label>
      <input type="text" name="phone" class="form-control" placeholder="Parent Phone line">
    </div>

    
    <div class="mb-3">
      <label>Address</label>
      <input type="text" name="address" class="form-control" placeholder="Home Address">
    </div>

    

    <div class="mb-3">
      <label>Relation</label>
      <input type="text" name="relation" class="form-control" placeholder="Relationship with Student" >
    </div>

    <div class="mb-3">
    <label class="form-label">Upload Passport</label>
      <input type="file" name="image" class="form-control-file" required>
  </div>

    <button class="btn btn-success">Save</button>
  </form>
</div>
@endsection