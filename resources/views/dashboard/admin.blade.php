@extends('layouts.dashboard')

@section('content')
<h2>Admin Dashboard</h2>
<p>Welcome, {{ Auth::user()->name }}!</p>
<div class="row">
  <div class="col-md-3"><div class="card p-3">Students: {{ $studentsCount }}</div></div>
  <div class="col-md-3"><div class="card p-3">Teachers: {{ $teachersCount }}</div></div>
  <div class="col-md-3"><div class="card p-3">Parents: {{ $parentsCount }}</div></div>
  <div class="col-md-3"><div class="card p-3">Classes: {{ $classesCount }}</div></div>
</div>
@endsection


<!-- Admin Dashboard 2 blade -->

@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Admin Dashboard</h1>
  <div class="row">
    <div class="col-md-3"><a href="{{ route('students.index') }}" class="btn btn-primary w-100 mb-2">Manage Students</a></div>
    <div class="col-md-3"><a href="{{ route('teachers.index') }}" class="btn btn-secondary w-100 mb-2">Manage Teachers</a></div>
    <div class="col-md-3"><a href="{{ route('parents.index') }}" class="btn btn-success w-100 mb-2">Manage Parents</a></div>
    <div class="col-md-3"><a href="{{ route('classes.index') }}" class="btn btn-warning w-100 mb-2">Manage Classes</a></div>
    <div class="col-md-3"><a href="{{ route('books.index') }}" class="btn btn-info w-100 mb-2">Manage Books</a></div>
    <div class="col-md-3"><a href="{{ route('exams.index') }}" class="btn btn-dark w-100 mb-2">Manage Exams</a></div>
    <div class="col-md-3"><a href="{{ route('activities.index') }}" class="btn btn-primary w-100 mb-2">Manage Activities</a></div>
    <div class="col-md-3"><a href="{{ route('sessions.index') }}" class="btn btn-secondary w-100 mb-2">Manage Sessions</a></div>
    <div class="col-md-3"><a href="{{ route('terms.index') }}" class="btn btn-success w-100 mb-2">Manage Terms</a></div>
  </div>
</div>
@endsection