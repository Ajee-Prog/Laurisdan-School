@extends('layouts.app')

@section('title', 'Add Question')

@section('content')
<div class="container mt-5">
    <h3 class="mb-3">Add Question for: <strong>{{ $exam->title }}</strong></h3>

    <form action="{{ route('exams.questions.store', $exam->id) }}" method="POST">
        @csrf


        <div class="mb-3">
            <label>Exam (optional)</label>
            <select name="exam_id" class="form-control">
                <option value="">-- Select exam --</option>
                @foreach($exams as $ex)
                    <option value="{{ $ex->id }}">{{ $ex->name }}</option>
                @endforeach
                
            </select>
        </div>
        

        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
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

        {{-- QUESTION --}}
        <div class="mb-3">
            <label class="form-label">Question</label>
            <textarea name="question_text" class="form-control" rows="3" required>{{ old('question_text') }}</textarea>
        </div>

        {{-- OPTIONS A-D --}}
        @php $letters = ['A','B','C','D']; @endphp

        @foreach($letters as $i => $letter)
            <div class="mb-3">
                <label class="form-label">Option {{ $letter }}</label>
                <input type="text" name="options[]" class="form-control" required>
            </div>
        @endforeach

        {{-- CORRECT OPTION --}}
        <div class="mb-3">
            <label class="form-label">Correct Option</label>
            <select name="correct_option" class="form-control" required>
                <option value="">-- Select Correct Answer --</option>
                <option value="0">A</option>
                <option value="1">B</option>
                <option value="2">C</option>
                <option value="3">D</option>
            </select>
        </div>

        <button class="btn btn-primary mt-2">Save Question</button>

    </form>
</div>
<!-- Not needed , but Just Testing -->
 <div class="container py-4">
  <h2>Add New Question for: <strong>{{ $exam->title }}</strong> </h2>

  <form action="{{ route('exams.questions.store', $exam->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="">Session</label>
        <select name="session_id" class="form-control" id="">
            @foreach($sessions as $s) 
                <option value="{{$s->id}}">{{$s->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="">Term</label>
        <select name="term_id" class="form-control" id="">
            @foreach($terms as $t) 
                <option value="{{$t->id}}">{{$t->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="">Subject</label>
        <select name="subject_id" class="form-control" id="">
            @foreach($subjects as $sub) 
                <option value="{{$sub->id}}">{{$sub->name}}</option>
            @endforeach
        </select>
    </div>
    <!-- selectors ends here -->

    <div class="mb-3">
      <label>Question</label>
      <textarea name="question" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
      <label>Options</label>
      @for($i=0; $i<4; $i++)
        <div class="input-group mb-2">
          <span class="input-group-text">
            <input type="radio" name="correct_option" value="{{ $i }}" required>
          </span>
          <input type="text" name="options[]" class="form-control" placeholder="Option {{ $i+1 }}" required>
        </div>
      @endfor
      <small>Select the correct option using the radio button.</small>
    </div>

    <button type="submit" class="btn btn-success">Save Question</button>
  </form>
</div>
 <!-- Just testing ends here -->
@endsection

<!-- --------------- -->

@section('content')
<div class="container py-4">
  <h2>Add New Question for: <strong>{{ $exam->title }}</strong> </h2>

  <form action="{{ route('exams.questions.store', $exam->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="">Session</label>
        <select name="session_id" class="form-control" id="">
            @foreach(\App\Models\SessionModel::all() as $s) 
                <option value="{{$s->id}}">{{$s->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="">Term</label>
        <select name="term_id" class="form-control" id="">
            @foreach(\App\Models\Term::all() as $t) 
                <option value="{{$t->id}}">{{$t->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="">Subject</label>
        <select name="subject_id" class="form-control" id="">
            @foreach(\App\Models\Subject::all() as $sub) 
                <option value="{{$sub->id}}">{{$sub->name}}</option>
            @endforeach
        </select>
    </div>
    <!-- selectors ends here -->

    <div class="mb-3">
      <label>Question</label>
      <textarea name="question" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
      <label>Options</label>
      @for($i=0; $i<4; $i++)
        <div class="input-group mb-2">
          <span class="input-group-text">
            <input type="radio" name="correct_option" value="{{ $i }}" required>
          </span>
          <input type="text" name="options[]" class="form-control" placeholder="Option {{ $i+1 }}" required>
        </div>
      @endfor
      <small>Select the correct option using the radio button.</small>
    </div>

    <button type="submit" class="btn btn-success">Save Question</button>
  </form>
</div>
@endsection

<!-- Admin set Question New Implementation Start here -->

@extends('layouts.admin')
@section('title', 'Add Question')

@section('content')
<h4>Add Question for: <strong>{{ $exam->title }}</strong> </h4>
<form action="{{ route('exams.questions.store', $exam->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Question Text</label>
        <textarea name="question_text" class="form-control" required></textarea>
    </div>

    @for($i = 0; $i < 4; $i++)
        <div class="mb-2">
            <label>Option {{ chr(65 + $i) }}</label>
            <input type="text" name="options[]" class="form-control" required>
        </div>
    @endfor

    <div class="mb-3">
        <label>Correct Option</label>
        <select name="correct_option" class="form-control" required>
            <option value="">--Select--</option>
            <option value="0">A</option>
            <option value="1">B</option>
            <option value="2">C</option>
            <option value="3">D</option>
        </select>
    </div>

    <button class="btn btn-primary">Save Question</button>
</form>

<!-- To choose any good ones -->
 <div class="container">
  <h3>Add Question</h3>

  <form action="{{ route('exams.questions.store', $exam->id) }}" method="POST">
    @csrf

    <div class="mb-3">
      <label>Exam (optional)</label>
      <select name="exam_id" class="form-control">
        <option value=""> -- Select exam -- </option>

                
                {{-- {{ @foreach($exam as $e)
                <option value="{{ $e->id }}" >{{ $e->title }}</option>
                @endforeach }} --}}
           





        
      </select>
    </div>

    <div class="mb-3">
      <label>Subject</label>
      <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
    </div>

    <div class="mb-3">
      <label>Question</label>
      <textarea name="question_text" class="form-control" rows="4" required>{{ old('question_text') }}</textarea>
    </div>

    <div class="row">
      <div class="col-md-6 mb-2">
        <label>Option A</label>
        <input type="text" name="option_a" class="form-control" value="{{ old('option_a') }}" required>
      </div>
      <div class="col-md-6 mb-2">
        <label>Option B</label>
        <input type="text" name="option_b" class="form-control" value="{{ old('option_b') }}" required>
      </div>
      <div class="col-md-6 mb-2">
        <label>Option C</label>
        <input type="text" name="option_c" class="form-control" value="{{ old('option_c') }}" required>
      </div>
      <div class="col-md-6 mb-2">
        <label>Option D</label>
        <input type="text" name="option_d" class="form-control" value="{{ old('option_d') }}" required>
      </div>
    </div>

    <div class="mb-3">
      <label>Correct Option</label>
      <select name="correct_option" class="form-control" required>
        <option value="">-- select --</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
      </select>
    </div>

    <button class="btn btn-success">Save Question</button>
  </form>
</div>
<!-- To choose ends here -->
@endsection

