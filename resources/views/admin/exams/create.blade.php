@extends('layouts.dashboard')

@section('content')
<h2>Add Exam</h2>
<form action="{{ route('exams.store') }}" method="POST">
  @csrf
  <div class="mb-3"><label>Title</label><input type="text" name="title" class="form-control" required></div>
  <div class="mb-3"><label>Date</label><input type="date" name="exam_date" class="form-control"></div>
  <div class="mb-3"><label>Class</label>
    <select name="class_id" class="form-control">
      @foreach($classes as $c)
        <option value="{{ $c->id }}" {{old('class_id', $exam->class_id ?? '')==$c->id ? 'selected':''}} > {{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection