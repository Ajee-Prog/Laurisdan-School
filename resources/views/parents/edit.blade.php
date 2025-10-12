@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 70px;">
  <h2>Edit Parent</h2>
  <form method="POST" action="{{ route('parents.update',$parent) }}">
    @csrf @method('PUT')
    <div class="mb-3"><label>Name</label><input type="text" name="full_name" value="{{ $parent->full_name }}" class="form-control"></div>
    <div class="mb-3"><label>Email</label><input type="email" name="email" value="{{ $parent->email }}" class="form-control"></div>
    <div class="mb-3"><label>Phone</label><input type="text" name="phone" value="{{ $parent->phone }}" class="form-control"></div>
    <div class="mb-3"><label>Address</label><input type="text" name="address" value="{{ $parent->address }}" class="form-control"></div>
    <button class="btn btn-primary">Update</button>
  </form>
</div>
@endsection