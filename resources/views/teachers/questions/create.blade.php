@extends('layouts.teacher')

@section('content')
<div class="container mt-4">
    <h3>Add Question to: {{ $exam->title }}</h3>
    <form action="{{ route('teacher.exams.questions.store', $exam->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Question</label>
            <textarea name="question_text" class="form-control" required></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Option A</label>
                <input type="text" name="option_a" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Option B</label>
                <input type="text" name="option_b" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Option C</label>
                <input type="text" name="option_c" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Option D</label>
                <input type="text" name="option_d" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label>Correct Option</label>
            <select name="correct_option" class="form-control" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>
        <button class="btn btn-success">Add Question</button>
    </form>
</div>
@endsection