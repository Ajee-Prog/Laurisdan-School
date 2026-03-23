@extends('layouts.app')
@section('content')
    <div class="col-md-12 mt-4" style="margin-top: 160px; padding-top: 60px">
        <h3>{{ $exam->title }}</h3>
        <div id="timer" class="mb-3">Time left: <span id="timeDisplay"></span></div>

        {{-- ************* Correct and clean th Question file --}}
        <form method="POST" action="{{ route('student.exams.submit') }}">
            @csrf

            <input type="hidden" name="exam_id" value="{{ $exam->id }}">

            @if($questions->count() > 0)
                    @foreach($questions as $index => $q)
            <div class="card mb-3">
                <div class="card-body">

                    <p><strong>{{ $index + 1 }}.</strong> {{ $q->question_text }}</p>

                    <label>
                        <input type="radio" name="question_{{ $q->id }}" value="A">
                        {{ $q->option_a }}
                    </label><br>

                    <label>
                        <input type="radio" name="question_{{ $q->id }}" value="B">
                        {{ $q->option_b }}
                    </label><br>

                    <label>
                        <input type="radio" name="question_{{ $q->id }}" value="C">
                        {{ $q->option_c }}
                    </label><br>

                    <label>
                        <input type="radio" name="question_{{ $q->id }}" value="D">
                        {{ $q->option_d }}
                    </label>

                </div>
            </div>
        @endforeach

    @else
        <p class="text-danger">No questions available for this exam.</p>
    @endif

    <button class="btn btn-success">Submit Exam</button>
</form>
        {{-- *************** Correct and clean ends here --}}

        {{-- <form method="POST" action="{{ route('student.exams.submit', $exam->id) }}">
        @csrf
        @foreach($questions as $idx => $q)
        <div class="card mb-2">
        <div class="card-body">
        <p><strong>{{ $idx+1 }}.</strong> {!! $q->question_text !!}</p>
        @foreach($q->options as $opt)
        <div class="form-check">
        <input class="form-check-input" type="radio" name="question_{{ $q->id }}" id="opt{{ $opt->id }}" value="{{ $opt->id }}">
        <label class="form-check-label" for="opt{{ $opt->id }}">{!! $opt->option_text !!}</label>
        </div>
        @endforeach
        </div>
        </div>
        @endforeach


        <button class="btn btn-success">Submit Exam</button>
        </form>


        {{-- </div> --}}

            {{-- New cbt Start here -}}
        @if($questions->count() > 0)
            @foreach($questions as $index => $question)
                <div class="mb-3">
                    <p><strong>{{ $index + 1 }}. {{ $question->question }}</strong></p>

                    @foreach($question->options as $option)
                        <div>
                            <input type="radio"
                                name="answers[{{ $question->id }}]"
                                value="{{ $option->id }}">
                            {{ $option->option }}
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <p class="text-danger">No questions available for this exam.</p>
        @endif --}}

        {{-- New cbt ends here --}}

        {{-- @foreach($questions as $index => $q)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $index + 1 }}. {{ $q->question_text }}</h5>

                <label>
                    <input type="radio" name="answers[{{ $q->id }}]" value="A">
                    {{ $q->option_a }}
                </label><br>

                <label>
                    <input type="radio" name="answers[{{ $q->id }}]" value="B">
                    {{ $q->option_b }}
                </label><br>

                <label>
                    <input type="radio" name="answers[{{ $q->id }}]" value="C">
                    {{ $q->option_c }}
                </label><br>

                <label>
                    <input type="radio" name="answers[{{ $q->id }}]" value="D">
                    {{ $q->option_d }}
                </label>
            </div>
        </div>
        @endforeach --}}

    </div>
    <script>
    let total = `{{ $exam->duration * 60 }}`;
    const display = document.getElementById('timeDisplay');
    const interval = setInterval(()=>{

    if (total <=0){
        clearInterval(interval);
        alert('Time up!');
        document.querySelector('form').submit(); return;
    }
    let m = Math.floor(total/60);
    let s = total%60;
    display.textContent = m+':'+(s<10?'0'+s:s);
    total--;
    },1000);
    </script>
@endsection
