<!-- @extends('layouts.app') -->
@extends('layouts.dashboard')

@section('title', 'Exam Details')

@section('content')
<div class="container mt-4">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Exam Info --}}
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">{{ $exam->title }}</h3>
            <p><strong>Subject:</strong> {{ $exam->subject ?? 'N/A' }}</p>
            <p><strong>Session:</strong> {{ optional($exam->session)->name }}</p>
            <p><strong>Term:</strong> {{ optional($exam->term)->name }}</p>

            <a href="{{ route('exams.questions.create', $exam->id) }}" class="btn btn-primary btn-sm">
                + Add Question
            </a>
        </div>
    </div>

    {{-- Questions --}}
    <div class="card">
        <div class="card-header">
            <h5>Questions</h5>
        </div>

        <div class="card-body">
            @if($exam->questions->count() > 0)
                @foreach($exam->questions as $index => $question)
                    <div class="mb-4">
                        <h6>
                            {{ $index + 1 }}. {{ $question->question_text }}
                        </h6>

                        <ul class="list-group mt-2">
                            <li class="list-group-item">
                                A. {{ $question->option_a }}
                            </li>
                            <li class="list-group-item">
                                B. {{ $question->option_b }}
                            </li>
                            <li class="list-group-item">
                                C. {{ $question->option_c }}
                            </li>
                            <li class="list-group-item">
                                D. {{ $question->option_d }}
                            </li>
                        </ul>

                        <p class="mt-2">
                            <strong>Correct Answer:</strong>
                            {{ $question->correct_option }}
                        </p>
                    </div>
                    <hr>
                @endforeach
            @else
                <p class="text-muted">No questions added yet.</p>
            @endif
        </div>
    </div>

</div>
@endsection