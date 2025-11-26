@extends('layouts.teacher')

@section('content')
<div class="container mt-4">
    <h3>Create New Exam</h3>
    <form action="{{ route('exams.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Exam Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Term</label>
            <input type="text" name="term" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Session</label>
            <input type="text" name="session" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Class</label>
            <select name="class_id" class="form-control">
                @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Create Exam</button>
    </form>
</div>
@endsection