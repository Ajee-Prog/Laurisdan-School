@extends('layouts.sidebar')

<!-- New starts -->

@extends('layouts.admin')

@extends('layouts.parent')

@section('content')
<div class="container mt-4">
    <h3>Welcome, {{ auth('parent')->user()->name }}</h3>
    <p>Phone: {{ auth('parent')->user()->phone }}</p>
    <a href="{{ route('parent.logout') }}" class="btn btn-danger">Logout</a>
</div>
@endsection

<!-- New ends -->

@section('content')
<div class="container" style="margin-top: 70px;">
    <h1> Welcome, {{ $parent->name }} (Parent) </h1>
    
    <!-- <div class="row">
        <div class="col-md-6"> -->
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5> Your Children</h5>
                    @if($children->count())
                    <ul class="list-group">
                        @foreach($children as $child)
                        <li class="list-group-item">
                            {{ $child->user->name }} - {{ $child->class->name ?? 'N/A' }}
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="fs-3"> No student records linked yet. </p>

                    @endif
                                       
                </div>
            </div>
       
</div>

<div class="container">
    <h1>Welcome Parent, {{ Auth::user()->name }}</h1>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">My Children</h5>
                    <a href="{{ route('parent.children') }}" class="btn btn-primary btn-sm">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Exam Results</h5>
                    <a href="{{ route('parent.results') }}" class="btn btn-success btn-sm">Check</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Books</h5>
                    <a href="{{ route('parent.books') }}" class="btn btn-info btn-sm">Library</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Activities</h5>
                    <a href="{{ route('parent.activities') }}" class="btn btn-warning btn-sm">View</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New dashboard  -->

<div class="container mt-4">
    <h2>Welcome, {{ $parent->name }}</h2>
    <p class="text-muted">Here are your children and their academic details:</p>

    @foreach($students as $student)
    <div class="card mb-3 shadow-sm p-3">
        <h4>{{ $student->name }}</h4>
        <p><strong>Class:</strong> {{ $student->class->name ?? 'N/A' }}</p>

        <h5 class="mt-3">Exam Results</h5>
        @if($student->examResults->isEmpty())
            <p>No exam results yet.</p>
        @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Score</th>
                    <th>Total</th>
                    <th>Term</th>
                    <th>Session</th>
                </tr>
            </thead>
            <tbody>
                @foreach($student->examResults as $result)
                <tr>
                    <td>{{ $result->subject }}</td>
                    <td>{{ $result->score }}</td>
                    <td>{{ $result->total }}</td>
                    <td>{{ $result->term }}</td>
                    <td>{{ $result->session }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    @endforeach
</div>

 <!-- New dashboard ends -->

@endsection