@extends('layouts.app')

@section('content')
<div class="container py-4" style="margin-top: 85px;">
  <h2 class="mb-3">Computer-Based Test (CBT)</h2>
  <form action="{{ route('student.exam.submit') }}" method="POST">
    @csrf

    @foreach($questions as $q)
      <div class="card mb-3">
        <div class="card-body">
          <p><strong>Q{{ $loop->iteration }}: {{ $q->question }}</strong></p>
          @foreach($q->options as $opt)
            <div class="form-check">
              <input type="radio" name="answers[{{ $q->id }}]" value="{{ $opt->id }}" class="form-check-input" id="q{{ $q->id }}opt{{ $opt->id }}">
              <label class="form-check-label" for="q{{ $q->id }}opt{{ $opt->id }}">
                {{ $opt->option_text }}
              </label>
            </div>
          @endforeach
        </div>
      </div>
    @endforeach

    <button type="submit" class="btn btn-success">Submit Exam</button>
  </form>
</div>


<!-- Exam CBT Starts here -->

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center">
    <h4>{{ strtoupper($subject) }} Exam</h4>
    <div id="timer" class="fw-bold text-danger fs-5"></div>
  </div>
  <hr>

  <form method="POST" id="examForm" action="{{ route('student.exam.submit') }}">
    @csrf
    <!-- <input type="hidden" name="subject" value="{{ $subject }}"> -->
     <input type="hidden" name="exam_id" value="{{ $exam->id }}">
    @foreach($questions as $index => $q)
      <div class="card mb-3 p-3 shadow-sm">
        <h6>{{ $index+1 }}. {{ $q->question }}</h6>
        <div class="form-check">
          <input type="radio" name="answers[{{ $q->id }}]" value="A" required> A. {{ $q->option_a }}</div>
        <div class="form-check"><input type="radio" name="answers[{{ $q->id }}]" value="B"> B. {{ $q->option_b }}</div>
        <div class="form-check"><input type="radio" name="answers[{{ $q->id }}]" value="C"> C. {{ $q->option_c }}</div>
        <div class="form-check"><input type="radio" name="answers[{{ $q->id }}]" value="D"> D. {{ $q->option_d }}</div>
      </div>
    @endforeach
    <button class="btn btn-success mt-2">Submit Exam</button>
  </form>
</div>

<script>
// 40-minute timer (from controller)
let duration = `{{ $examDuration }}`;
let timerDisplay = document.getElementById('timer');
let form = document.getElementById('examForm');

function updateTimer() {
    let minutes = Math.floor(duration / 60);
    let seconds = duration % 60;
    timerDisplay.innerHTML = `Time Left: ${minutes}:${seconds.toString().padStart(2, '0')}`;

    if (duration <= 0) {
        alert("Time is up! Submitting your exam...");
        form.submit();
    } else {
        duration--;
        setTimeout(updateTimer, 1000);
    }
}
updateTimer();
</script>

<!-- Exam CBT Ends here -->
@endsection