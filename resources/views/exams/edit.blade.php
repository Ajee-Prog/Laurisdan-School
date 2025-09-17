@extends('layouts.dashboard')

@section('content')
<h2>Edit Exam</h2>
<form action="{{ route('exams.update',$exam->id) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3"><label>Title</label><input type="text" name="title" class="form-control" value="{{ $exam->title }}"></div>
  <div class="mb-3"><label>Date</label><input type="date" name="exam_date" class="form-control" value="{{ $exam->exam_date }}"></div>
  <div class="mb-3"><label>Class</label>
    <select name="class_id" class="form-control">
      @foreach($classes as $c)
        <option value="{{ $c->id }}" {{ $exam->class_id==$c->id ? 'selected':'' }}>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection