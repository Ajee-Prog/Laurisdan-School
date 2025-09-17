@extends('layouts.dashboard')

@section('content')
<h2>Student Dashboard</h2>
<p>Hello {{ Auth::user()->name }}!</p>
<ul>
  <li>Your Class: {{ $student->class->name }}</li>
  <li>Exams this term: {{ $exams->count() }}</li>
</ul>
@endsection