@extends('layouts.app')

@section('content')
<div class="container mt-4" style="padding-top: 60px;">

<h3>Add 20 Questions (Bulk)</h3>

@if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

<form method="POST" action="{{ route('admin.questions.bulk.store', $exam->id) }}">
@csrf

        {{-- New added --}}
        <div class="mb-3">
            <label>Exam (optional)</label>
            <select name="exam_id" class="form-control">
                <option value="">-- Select exam --</option>
                @foreach($exams as $exam)
                    <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                @endforeach

            </select>
        </div>
        {{-- SESSION --}}
        <div class="mb-3">
            <label class="form-label">Session</label>
            <select name="session_id" class="form-control" required>
                <option value="">-- Select Session --</option>
                @foreach($sessions as $session)
                    <option value="{{ $session->id }}">{{ $session->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- TERM --}}
        <div class="mb-3">
            <label class="form-label">Term</label>
            <select name="term_id" class="form-control" required>
                <option value="">-- Select Term --</option>
                @foreach($terms as $term)
                    <option value="{{ $term->id }}">{{ $term->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- SUBJECT --}}
        <div class="mb-3">
            <label class="form-label">Subject</label>
            <select name="subject_id" class="form-control" required>
                <option value="">-- Select Subject --</option>
                @foreach($subjects as $sub)
                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                @endforeach
            </select>
        </div>
{{-- New added ends --}}
<div class="mb-3">
    <label>Subject</label>
    <input type="text" name="subject" class="form-control" required>
</div>

{{-- Qquestion type either fillable or not --}}
    <select name="type" class="form-control mb-3">
        <option value="mcq">Multiple Choice</option>
        <option value="fill">Fill in the Gap</option>
    </select>
{{-- Qquestion type either fillable or not ends here--}}

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
        {{-- New added testing correct answer --}}
        <div id="fillAnswer" style="display:none;">
            <label>Correct Answer</label>
            {{-- <input type="text" name="correct_answer" class="form-control"> --}}
            <input type="text" name="correct_answer_{{ $i }}" class="form-control" placeholder="Correct Answer (for fill)">
        </div>
        {{-- New added testing correct answer ends --}}

    </div>
</div>
@endfor

<button class="btn btn-success">Save All Questions</button>

</form>
</div>

{{-- Function for correct fill answer display --}}
<script>
document.querySelector('[name="type"]').addEventListener('change', function () {
    document.getElementById('fillAnswer').style.display =
        this.value === 'fill' ? 'block' : 'none';
});
</script>
@endsection
