@extends('layouts.dashboard')

@section('content')
<h2>Add Exam</h2>
<form action="{{ route('exams.store') }}" method="POST">
  @csrf
  <div class="mb-3"><label>Title</label><input type="text" name="title" class="form-control" required></div>
  <div class="mb-3">
    <label>Date</label>
    <input type="date" name="exam_date" class="form-control">
  </div>

  <div class="form-group mb-3">
    <label>Subject</label>
    <input type="text" name="subject" class="form-control" required>
</div>

{{-- New add --}}
    <div class="mb-3">
        <label>Subject</label>
        <select name="subject_id" class="form-control" required>
            <option value="">Select Subject</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Term select list --}}
    <div class="mb-3">
        <label>Term</label>
        <select name="term_id" class="form-control" required>
            @foreach($terms as $term)
                <option value="{{ $term->id }}">{{ $term->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Session select list --}}
    <div class="mb-3">
    <label>Session</label>
    <select name="session_id" class="form-control" required>
        @foreach($sessions as $session)
            <option value="{{ $session->id }}">{{ $session->name }}</option>
        @endforeach
    </select>
    </div>
{{-- New Add ends --}}

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
