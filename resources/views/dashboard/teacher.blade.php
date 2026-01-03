@php
    $admin   = Auth::guard('web')->user();
    $student = Auth::guard('student')->user();
@endphp

<!--  -->
@extends('layouts.dashboard')

@section('content')
<h2>Teacher Dashboard</h2>
<p>Welcome, {{ Auth::user()->name }}!</p>
<ul>
  {{-- <li>Assigned Classes: {{ $myClasses->count() }}</li>
  <li>Upcoming Exams: {{ $upcomingExams->count() }}</li> --}}

   @if(isset($teacher))
  <h2>Welcome, {{ $teacher->name }}</h2>
@else
  <h2>Welcome, {{ Auth::user()->name }}</h2>
  <p>Your Teacher profile is not linked yet.</p>
@endif
</ul>



@if ($teacher)
    <p><strong>Name:</strong> {{ $teacher->name ?? '—' }}</p>
    <p><strong>Class Assigned:</strong> {{ $teacher->class->name ?? 'None' }}</p>
    <!-- <p>Assigned class: {{ optional($teacher->class)->name ?? 'None' }}</p> -->
@else
    <p class="text-danger">Teacher profile not found.</p>
@endif
@endsection
