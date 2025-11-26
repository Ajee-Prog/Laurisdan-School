@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Exam Completed</h2>
    <p><strong>{{ $exam->title }}</strong></p>
    <h3>Your Score: {{ $score }} / {{ $total }}</h3>

    <a href="{{ route('student.dashboard') }}" class="btn btn-success">
        Back to Dashboard
    </a>
</div>
@endsection