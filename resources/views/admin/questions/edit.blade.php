@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Edit Question</h2>

  <form action="{{ route('questions.update', $question) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label for="">Session</label>
        <select name="session_id" class="form-control" id="">
            @foreach(\App\Models\Session::all() as $s) 
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
      <textarea name="question" class="form-control" required>{{ $question->question }}</textarea>
    </div>

    <div class="mb-3">
      <label>Options</label>
      @foreach($question->options as $index => $opt)
        <div class="input-group mb-2">
          <span class="input-group-text">
            <input type="radio" name="correct_option" value="{{ $index }}" 
                   {{ $opt->is_correct ? 'checked' : '' }}>
          </span>
          <input type="text" name="options[]" class="form-control" value="{{ $opt->option_text }}" required>
        </div>
      @endforeach
    </div>

    <button type="submit" class="btn btn-success">Update Question</button>
  </form>
</div>
@endsection