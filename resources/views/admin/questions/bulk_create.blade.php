@extends('layouts.app')

@section('content')

<div class="container mt-4" style="padding-top: 60px;">

    <h3 class="mb-4">Add Bulk Questions (20)</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following:</strong>

            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="POST"
          action="{{ route('admin.questions.bulk.store', $exam->id) }}">

        @csrf


        {{-- =============================== --}}
        {{-- EXAM INFORMATION --}}
        {{-- =============================== --}}

        <div class="card mb-4">

            <div class="card-header bg-primary text-white">
                Exam Information
            </div>

            <div class="card-body">

                {{-- Subject --}}
                <div class="mb-3">

                    <label class="form-label">
                        Subject
                    </label>

                    <select name="subject_id"
                            class="form-control"
                            required>

                        <option value="">
                            -- Select Subject --
                        </option>

                        @foreach($subjects as $sub)

                            <option value="{{ $sub->id }}">
                                {{ $sub->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Exam --}}
                <div class="mb-3">

                    <label class="form-label">
                        Exam
                    </label>

                    <select name="exam_id"
                            class="form-control"
                            required>

                        <option value="">
                            -- Select Exam --
                        </option>

                        @foreach($exams as $examItem)

                            <option value="{{ $examItem->id }}"
                                {{ isset($exam) && $exam->id == $examItem->id ? 'selected' : '' }}>

                                {{ $examItem->title }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Session --}}
                <div class="mb-3">

                    <label class="form-label">
                        Session
                    </label>

                    <select name="session_id"
                            class="form-control"
                            required>

                        <option value="">
                            -- Select Session --
                        </option>

                        @foreach($sessions as $session)

                            <option value="{{ $session->id }}">
                                {{ $session->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Term --}}
                <div class="mb-3">

                    <label class="form-label">
                        Term
                    </label>

                    <select name="term_id"
                            class="form-control"
                            required>

                        <option value="">
                            -- Select Term --
                        </option>

                        @foreach($terms as $term)

                            <option value="{{ $term->id }}">
                                {{ $term->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

        </div>



        {{-- =============================== --}}
        {{-- QUESTIONS --}}
        {{-- =============================== --}}

        @for($i = 1; $i <= 20; $i++)

            <div class="card mb-4 question-card">

                <div class="card-header bg-dark text-white">

                    Question {{ $i }}

                </div>


                <div class="card-body">


                    {{-- Question --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Question
                        </label>

                        <textarea
                            name="question_text_{{ $i }}"
                            class="form-control"
                            rows="3"
                            placeholder="Enter question {{ $i }}">
                        </textarea>

                    </div>



                    {{-- QUESTION TYPE --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Question Type
                        </label>

                        <select
                            name="type_{{ $i }}"
                            class="form-control question-type"
                            data-question="{{ $i }}">

                            <option value="">
                                -- Select Question Type --
                            </option>

                            <option value="mcq">
                                Multiple Choice
                            </option>

                            <option value="fill">
                                Fill in the Gap
                            </option>

                            <option value="true_false">
                                True / False
                            </option>

                        </select>

                    </div>



                    {{-- ========================== --}}
                    {{-- MCQ OPTIONS --}}
                    {{-- ========================== --}}

                    <div
                        id="mcq_{{ $i }}"
                        class="mcq-fields"
                        style="display:none;">

                        <h6 class="text-primary">
                            Multiple Choice Options
                        </h6>


                        <div class="mb-2">

                            <label>Option A</label>

                            <input
                                type="text"
                                name="option_a_{{ $i }}"
                                class="form-control"
                                placeholder="Option A">

                        </div>


                        <div class="mb-2">

                            <label>Option B</label>

                            <input
                                type="text"
                                name="option_b_{{ $i }}"
                                class="form-control"
                                placeholder="Option B">

                        </div>


                        <div class="mb-2">

                            <label>Option C</label>

                            <input
                                type="text"
                                name="option_c_{{ $i }}"
                                class="form-control"
                                placeholder="Option C">

                        </div>


                        <div class="mb-2">

                            <label>Option D</label>

                            <input
                                type="text"
                                name="option_d_{{ $i }}"
                                class="form-control"
                                placeholder="Option D">

                        </div>


                        <div class="mb-3">

                            <label>
                                Correct Option
                            </label>

                            <select
                                name="correct_option_{{ $i }}"
                                class="form-control">

                                <option value="">
                                    -- Select Correct Option --
                                </option>

                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>

                            </select>

                        </div>

                    </div>



                    {{-- ========================== --}}
                    {{-- FILL IN THE GAP --}}
                    {{-- ========================== --}}

                    <div
                        id="fill_{{ $i }}"
                        class="fill-fields"
                        style="display:none;">

                        <h6 class="text-success">
                            Fill in the Gap Answer
                        </h6>

                        <div class="mb-3">

                            <label>
                                Correct Answer
                            </label>

                            <input
                                type="text"
                                name="correct_answer_{{ $i }}"
                                class="form-control"
                                placeholder="Enter correct answer">

                        </div>

                    </div>



                    {{-- ========================== --}}
                    {{-- TRUE / FALSE --}}
                    {{-- ========================== --}}

                    <div
                        id="true_false_{{ $i }}"
                        class="true-false-fields"
                        style="display:none;">

                        <h6 class="text-warning">
                            True / False Answer
                        </h6>

                        <div class="mb-3">

                            <label>
                                Correct Answer
                            </label>

                            <select
                                name="correct_answer_{{ $i }}"
                                class="form-control">

                                <option value="">
                                    -- Select Answer --
                                </option>

                                <option value="True">
                                    True
                                </option>

                                <option value="False">
                                    False
                                </option>

                            </select>

                        </div>

                    </div>


                </div>

            </div>

        @endfor



        {{-- SAVE --}}
        <div class="mb-5">

            <button
                type="submit"
                class="btn btn-success btn-lg">

                Save All Questions

            </button>

        </div>

    </form>

</div>



{{-- =============================== --}}
{{-- JAVASCRIPT --}}
{{-- =============================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const typeSelectors =
        document.querySelectorAll('.question-type');


    typeSelectors.forEach(function (selector) {

        selector.addEventListener('change', function () {

            const questionNumber =
                this.getAttribute('data-question');

            const mcq =
                document.getElementById(
                    'mcq_' + questionNumber
                );

            const fill =
                document.getElementById(
                    'fill_' + questionNumber
                );

            const trueFalse =
                document.getElementById(
                    'true_false_' + questionNumber
                );


            // Hide everything first
            mcq.style.display = 'none';

            fill.style.display = 'none';

            trueFalse.style.display = 'none';


            // Show selected type
            if (this.value === 'mcq') {

                mcq.style.display = 'block';

            }

            else if (this.value === 'fill') {

                fill.style.display = 'block';

            }

            else if (this.value === 'true_false') {

                trueFalse.style.display = 'block';

            }

        });

    });

});

</script>

@endsection
