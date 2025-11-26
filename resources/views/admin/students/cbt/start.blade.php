@extends('layouts.student')
@section('title', 'Take Exam')

@section('content')
<h4>{{ $exam->title }} ({{ $exam->subject }})</h4>

<form action="{{ route('student.exam.submit', $exam->id) }}" method="POST">
    @csrf
    @foreach($exam->questions as $key => $question)
        <div class="card mb-3">
            <div class="card-header">
                Q{{ $key+1 }}. {{ $question->question_text }}
            </div>
            <div class="card-body">
                @foreach($question->options as $opt)
                    <div class="form-check">
                        <input type="radio" name="question_{{ $question->id }}" value="{{ $opt->id }}" class="form-check-input" required>
                        <label class="form-check-label">{{ $opt->option_text }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <button class="btn btn-success">Submit Exam</button>
</form>
@endsection