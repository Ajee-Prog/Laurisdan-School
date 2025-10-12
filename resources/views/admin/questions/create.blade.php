@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Add New Question</h2>

  <form action="{{ route('questions.store') }}" method="POST">
    @csrf

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