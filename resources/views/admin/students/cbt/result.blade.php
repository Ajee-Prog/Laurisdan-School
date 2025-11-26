@extends('layouts.student')
@section('title', 'Exam Result')

@section('content')
<div class="card">
    <div class="card-header bg-success text-white">Exam Result</div>
    <div class="card-body">
        <p><strong>Exam:</strong> {{ $exam->title }}</p>
        <p><strong>Total Questions:</strong> {{ $total }}</p>
        <p><strong>Correct Answers:</strong> {{ $score }}</p>
        <p><strong>Percentage:</strong> {{ $percentage }}%</p>

        @if($percentage >= 50)
            <div class="alert alert-success">Congratulations! You passed this exam 🎉</div>
        @else
            <div class="alert alert-danger">You did not pass this time. Try again.</div>
        @endif
    </div>
</div>
@endsection