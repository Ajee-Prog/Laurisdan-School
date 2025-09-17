@extends('layouts.dashboard')

@section('content')
<h2>Add Activity</h2>
<form action="{{ route('activities.store') }}" method="POST">
  @csrf
  <div class="mb-3"><label>Title</label><input type="text" name="title" class="form-control" required></div>
  <div class="mb-3"><label>Description</label><textarea name="description" class="form-control"></textarea></div>
  <div class="mb-3"><label>Date</label><input type="date" name="activity_date" class="form-control"></div>
  <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection