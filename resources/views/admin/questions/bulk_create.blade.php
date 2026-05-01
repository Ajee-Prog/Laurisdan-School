@extends('layouts.app')

@section('content')
<div class="container mt-4" style="padding-top: 60px;">

<h3>Add 20 Questions (Bulk)</h3>

@if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

<form method="POST" action="{{ route('admin.questions.bulk.store', $exam->id) }}">
@csrf

<div class="mb-3">
    <label>Subject</label>
    <input type="text" name="subject" class="form-control" required>
</div>

@for($i = 1; $i <= 20; $i++)
<div class="card mb-3">
    <div class="card-body">

        <h5>Question {{ $i }}</h5>

        <textarea name="question_text_{{ $i }}" class="form-control mb-2" placeholder="Enter question"></textarea>

        <input type="text" name="option_a_{{ $i }}" class="form-control mb-1" placeholder="Option A">
        <input type="text" name="option_b_{{ $i }}" class="form-control mb-1" placeholder="Option B">
        <input type="text" name="option_c_{{ $i }}" class="form-control mb-1" placeholder="Option C">
        <input type="text" name="option_d_{{ $i }}" class="form-control mb-1" placeholder="Option D">

        <select name="correct_option_{{ $i }}" class="form-control">
            <option value="">Select Correct Answer</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select>

    </div>
</div>
@endfor

<button class="btn btn-success">Save All Questions</button>

</form>
</div>
@endsection
