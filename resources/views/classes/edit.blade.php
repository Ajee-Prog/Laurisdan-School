@extends('layouts.app')
@section('content')
<div class="container">
  <h2>Edit Class</h2>
  <form method="POST" action="{{ route('classes.update',$class) }}">
    @csrf @method('PUT')
    <div class="mb-3"><label>Class Name</label><input type="text" name="name" value="{{ $class->name }}" class="form-control"></div>
    <button class="btn btn-primary">Update</button>
  </form>
</div>
@endsection