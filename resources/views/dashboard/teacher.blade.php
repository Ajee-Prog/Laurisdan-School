@extends('layouts.dashboard')

@section('content')
<h2>Teacher Dashboard</h2>
<p>Welcome, {{ Auth::user()->name }}!</p>
<ul>
  <li>Assigned Classes: {{ $myClasses->count() }}</li>
  <li>Upcoming Exams: {{ $upcomingExams->count() }}</li>
</ul>
@endsection
