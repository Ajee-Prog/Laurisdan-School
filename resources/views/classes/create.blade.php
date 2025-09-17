@extends('layouts.app')
@section('content')
<div class="container">
  <h2>Add Class</h2>
  <form method="POST" action="{{ route('classes.store') }}">
    @csrf
    <div class="mb-3"><label>Class Name</label><input type="text" name="name" class="form-control"></div>
    <button class="btn btn-success">Save</button>
  </form>
</div>
@endsection