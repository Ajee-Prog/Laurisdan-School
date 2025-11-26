@extends('layouts.app')

@section('content')
<div class="container t-5" style="margin-top: 90px;">

    <h2>{{ $exam->title }}</h2>
    <p>{{ $exam->description }}</p>

    <h3>Time Remaining: <span id="timer"></span></h3>

    <form action="{{ route('exam.submit') }}" method="POST">
        @csrf

        

        <input type="hidden" name="exam_id" value="{{ $exam->id }}">

    @foreach($exam->questions as $q)
        <div class="question-block">
            <p><strong>{{ $q->question }}</strong></p>

            <label>
                <input type="radio" name="answers[{{ $q->id }}]" value="A">
                A. {{ $q->option_a }}
            </label><br>

            <label>
                <input type="radio" name="answers[{{ $q->id }}]" value="B">
                B. {{ $q->option_b }}
            </label><br>

            <label>
                <input type="radio" name="answers[{{ $q->id }}]" value="C">
                C. {{ $q->option_c }}
            </label><br>

            <label>
                <input type="radio" name="answers[{{ $q->id }}]}" value="D">
                D. {{ $q->option_d }}
            </label><br><br>
        </div>
    @endforeach

        <button type="submit" class="btn btn-primary">Submit Exam</button>
    </form>







    <!-- Second testing -->
     h2>{{ $exam->title }} — CBT Exam</h2>
    <p><strong>Duration:</strong> {{ $exam->duration }} minutes</p>

    <div id="timer" class="alert alert-warning fw-bold fs-5"></div>

    <form action="{{ route('exam.submit') }}" method="POST" id="examForm">
        @csrf

        <input type="hidden" name="exam_id" value="{{ $exam->id }}">

        @foreach ($exam->questions as $question)
            <div class="card shadow-sm mb-3">
                <div class="card-body">

                    <h5>Q{{ $loop->iteration }}. {{ $question->question }}</h5>

                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                               name="answers[{{ $question->id }}]" value="A">
                        <label class="form-check-label">A. {{ $question->option_a }}</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                               name="answers[{{ $question->id }}]" value="B">
                        <label class="form-check-label">B. {{ $question->option_b }}</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                               name="answers[{{ $question->id }}]" value="C">
                        <label class="form-check-label">C. {{ $question->option_c }}</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                               name="answers[{{ $question->id }}]" value="D">
                        <label class="form-check-label">D. {{ $question->option_d }}</label>
                    </div>

                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-success btn-lg">Submit Exam</button>

    </form>
</div>

<!-- <script>
// 40 minute exam
let remaining = 40 * 60;

setInterval(function () {
    remaining--;
    let min = Math.floor(remaining / 60);
    let sec = remaining % 60;
    document.getElementById("timer").innerHTML =
        min + "m " + (sec < 10 ? "0" : "") + sec + "s";

    if (remaining <= 0) {
        document.forms[0].submit();
    }
}, 1000);
</script> -->




{{-- =========================
     TIMER SCRIPT
========================= --}}
<script>
let duration = {{ $exam->duration * 60 }};
let timerDisplay = document.getElementById('timer');
let form = document.getElementById('examForm');

function updateTimer() {
    let minutes = Math.floor(duration / 60);
    let seconds = duration % 60;

    timerDisplay.innerHTML = `Time Left: ${minutes}:${seconds.toString().padStart(2, '0')}`;

    if (duration <= 0) {
        alert("Time is up! Submitting exam...");
        form.submit();
    } else {
        duration--;
        setTimeout(updateTimer, 1000);
    }
}

updateTimer();
</script>

@endsection