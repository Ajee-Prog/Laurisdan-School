@extends('layouts.apps')

@section('content')
<div class="container mt-5">
    <h3>Enter Exam Access Code</h3>

    <form method="POST" action="{{ route('student.exams.verify') }}">
        @csrf

        <input type="hidden" name="exam_id" value="{{ $exam->id }}">

        <div class="form-group">
            <input type="text" name="access_code" class="form-control" placeholder="Enter Code" required>
        </div>

        <button class="btn btn-primary mt-2">Start Exam</button>
    </form>
</div>
@endsection
