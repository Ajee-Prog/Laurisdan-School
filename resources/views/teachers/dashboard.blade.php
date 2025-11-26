@extends('layouts.sidebar')

@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Welcome, {{ auth('teacher')->user()->name }}</h3>
    <p>Subject: {{ auth('teacher')->user()->subject }}</p>
    <a href="{{ route('teacher.logout') }}" class="btn btn-danger">Logout</a>
</div>
@endsection





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



<h1>New teaher ennin</h1>

<div class="container mt-4">
    <h2>Welcome, {{ $teacher->name }}</h2>
    <p class="text-muted">Class: {{ $class->name ?? 'Not Assigned' }}</p>

    @if($class)
        <div class="card mb-4 shadow-sm">
            <div class="card-header">Students in {{ $class->name }}</div>
            <div class="card-body">
                @if($students->isEmpty())
                    <p>No students yet in this class.</p>
                @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Exams Taken</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->examResults->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header">Your Exams</div>
        <div class="card-body">
            @if($exams->isEmpty())
                <p>No exams created yet.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Exam Title</th>
                            <th>Subject</th>
                            <th>Class</th>
                            <th>Term</th>
                            <th>Session</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exams as $exam)
                        <tr>
                            <td>{{ $exam->title }}</td>
                            <td>{{ $exam->subject }}</td>
                            <td>{{ $exam->class->name ?? 'N/A' }}</td>
                            <td>{{ $exam->term }}</td>
                            <td>{{ $exam->session }}</td>
                            <td>{{ $exam->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

@endsection