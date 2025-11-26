@extends('layouts.app')
@section('content')
<div class="col-md-12 mt-4">
<h3>{{ $exam->title }}</h3>
<div id="timer" class="mb-3">Time left: <span id="timeDisplay"></span></div>


<form method="POST" action="{{ route('student.exams.submit', $exam->id) }}">
@csrf
@foreach($questions as $idx => $q)
<div class="card mb-2">
<div class="card-body">
<p><strong>{{ $idx+1 }}.</strong> {!! $q->question_text !!}</p>
@foreach($q->options as $opt)
<div class="form-check">
<input class="form-check-input" type="radio" name="question_{{ $q->id }}" id="opt{{ $opt->id }}" value="{{ $opt->id }}">
<label class="form-check-label" for="opt{{ $opt->id }}">{!! $opt->option_text !!}</label>
</div>
@endforeach
</div>
</div>
@endforeach


<button class="btn btn-success">Submit Exam</button>
</form>
</div>


<script>
let total = `{{ $exam->duration * 60 }}`;
const display = document.getElementById('timeDisplay');
const interval = setInterval(()=>{

if (total <=0){ 
    clearInterval(interval); 
    alert('Time up!'); 
    document.querySelector('form').submit(); return; 
}
let m = Math.floor(total/60); 
let s = total%60; 
display.textContent = m+':'+(s<10?'0'+s:s); 
total--;
},1000);
</script>
@endsection