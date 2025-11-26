@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Add New Question for </h2>

  <form action="{{ route('questions.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="">Session</label>
        <select name="session_id" class="form-control" id="">
            
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
<h4>Add Question for </h4>
<form action="{{ route('questions.store') }}" method="POST">
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
@endsection