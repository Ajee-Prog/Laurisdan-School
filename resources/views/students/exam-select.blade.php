@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Select Exam</h2>
  <form action="{{ route('student.exam') }}" method="GET">
    <div class="mb-3">
      <label>Session</label>
      <select name="session_id" class="form-control" required>
        @foreach(\App\Models\Session::all() as $s)
          <option value="{{ $s->id }}">{{ $s->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label>Term</label>
      <select name="term_id" class="form-control" required>
        @foreach(\App\Models\Term::all() as $t)
          <option value="{{ $t->id }}">{{ $t->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label>Subject</label>
      <select name="subject_id" class="form-control" required>
        @foreach(\App\Models\Subject::all() as $sub)
          <option value="{{ $sub->id }}">{{ $sub->name }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-success">Start Exam</button>
  </form>
</div>
@endsection