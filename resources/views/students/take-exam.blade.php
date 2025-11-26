@extends('layouts.app')
@section('content')
<div class="container">
<h3>{{ $exam->title }} Exam</h3>
<p>Duration: {{ $exam->duration }} minutes</p>


<div id="timer" class="alert alert-danger">Time Left: <span id="time"></span></div>


<form method="POST" action="{{ route('student.exam.submit') }}">
@csrf
@foreach($questions as $index => $q)
<div class="card mb-3">
<div class="card-body">
<h5>{{ $index + 1 }}. {{ $q->question }}</h5>


<label><input type="radio" name="answers[{{ $q->id }}]" value="A"> {{ $q->option_a }}</label><br>
<label><input type="radio" name="answers[{{ $q->id }}]" value="B"> {{ $q->option_b }}</label><br>
<label><input type="radio" name="answers[{{ $q->id }}]" value="C"> {{ $q->option_c }}</label><br>
<label><input type="radio" name="answers[{{ $q->id }}]" value="D"> {{ $q->option_d }}</label><br>
</div>
</div>
@endforeach


<button class="btn btn-success">Submit Exam</button>
</form>
</div>


<script>
let duration = `{{ $exam->duration }} * 60`;
function updateTimer(){
let minutes = Math.floor(duration / 60);
let seconds = duration % 60;
document.getElementById('time').innerText = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
duration--;
if(duration < 0){ document.forms[0].submit(); }
}
setInterval(updateTimer, 1000);
</script>
@endsection