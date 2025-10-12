@extends('layouts.app')

@section('content')
<div class="container py-4 text-center">
  <h2>Exam Result</h2>
  <p class="mt-3">You scored <strong>{{ $score }}</strong> out of <strong>{{ $total }}</strong>.</p>

  @if($score >= ($total/2))
    <div class="alert alert-success mt-3">Congratulations! You passed 🎉</div>
  @else
    <div class="alert alert-danger mt-3">You did not pass. Try again!</div>
  @endif

  <a href="{{ route('student.exam') }}" class="btn btn-primary mt-3">Retake Exam</a>
</div>

<!-- Filter Result -->
 <form method="GET" action="{{ route('student.results') }}" class="row mb-3">
  <div class="col-md-3">
    <select name="session_id" class="form-control">
      <option value="">-- All Sessions --</option>
      @foreach($sessions as $s)
        <option value="{{ $s->id }}" {{ request('session_id') == $s->id ? 'selected' : '' }}>
          {{ $s->name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <select name="term_id" class="form-control">
      <option value="">-- All Terms --</option>
      @foreach($terms as $t)
        <option value="{{ $t->id }}" {{ request('term_id') == $t->id ? 'selected' : '' }}>
          {{ $t->name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <select name="subject_id" class="form-control">
      <option value="">-- All Subjects --</option>
      @foreach($subjects as $sub)
        <option value="{{ $sub->id }}" {{ request('subject_id') == $sub->id ? 'selected' : '' }}>
          {{ $sub->name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <button type="submit" class="btn btn-primary">Filter</button>
    <a href="{{ route('student.results.pdf', request()->all()) }}" class="btn btn-danger">Download PDF</a>
</div>
</form>
@endsection