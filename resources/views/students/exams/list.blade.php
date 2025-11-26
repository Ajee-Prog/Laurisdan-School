@extends('layouts.app')
@section('content')
<div class="col-md-12 mt-4">
<h3>Available Exams</h3>
<div class="list-group">
@foreach($exams as $exam)
<a href="{{ route('student.exams.start', $exam->id) }}" class="list-group-item list-group-item-action">
{{ $exam->title }} — Duration: {{ $exam->duration }} mins
</a>
@endforeach
</div>
</div>
@endsection