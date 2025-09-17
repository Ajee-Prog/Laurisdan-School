@extends('layouts.app')
@section('content')
<div class="container">
  <h2>Add Parent</h2>
  <form method="POST" action="{{ route('parents.store') }}">
    @csrf
    <div class="mb-3"><label>Name</label><input type="text" name="full_name" class="form-control"></div>
    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control"></div>
    <div class="mb-3"><label>Phone</label><input type="text" name="phone" class="form-control"></div>
    <div class="mb-3"><label>Address</label><input type="text" name="address" class="form-control"></div>
    <button class="btn btn-success">Save</button>
  </form>
</div>
@endsection