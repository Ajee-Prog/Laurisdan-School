@extends('layouts.student')

@section('title', 'CBT Exam')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">🧠 Computer Based Test (CBT)</h3>
    <p>Read each question carefully and choose the correct option.</p>

    <div id="timer" class="alert alert-info text-center fw-bold">
        Time Left: <span id="time">10:00</span>
    </div>

    <form action="{{ route('student.cbt.submit') }}" method="POST">
        @csrf

        @foreach ($questions as $index => $question)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $index + 1 }}. {{ $question->question_text }}</h5>
                    @foreach (['a', 'b', 'c', 'd'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                   name="answers[{{ $question->id }}]"
                                   value="{{ $option }}" id="q{{ $question->id }}_{{ $option }}">
                            <label class="form-check-label" for="q{{ $question->id }}_{{ $option }}">
                                {{ strtoupper($option) }}. {{ $question->{'option_'.$option} }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">Submit Exam</button>
        </div>
    </form>
</div>

<script>
    // 10-minute timer
    let totalTime = 10 * 60;
    const timerDisplay = document.getElementById("time");
    const timerInterval = setInterval(() => {
        const minutes = Math.floor(totalTime / 60);
        const seconds = totalTime % 60;
        timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        totalTime--;
        if (totalTime < 0) {
            clearInterval(timerInterval);
            alert("Time's up! Your exam will be submitted automatically.");
            document.querySelector("form").submit();
        }
    }, 1000);
</script>
@endsection