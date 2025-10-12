@extends('layouts.sidebar')

@section('content')
<div class="container mt-5" style="margin-top:90px;">
    <h1 style="margin-top:80px;"> Welcome, {{ $teacher->name }} (Teacher) </h1>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5> Your Students</h5>
                    <p class="fs-3"> {{ $students }} </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5> Total Classes</h5>
                    <p class="fs-3"> {{ $classes }} </p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <h1>Welcome Teacher, {{ Auth::user()->name }}</h1>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">My Classes</h5>
                    <a href="{{ route('teacher.classes') }}" class="btn btn-primary btn-sm">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Exams</h5>
                    <a href="{{ route('teacher.exams') }}" class="btn btn-success btn-sm">Manage</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Activities</h5>
                    <a href="{{ route('teacher.activities') }}" class="btn btn-info btn-sm">Track</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Books</h5>
                    <a href="{{ route('teacher.books') }}" class="btn btn-warning btn-sm">Assign</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection