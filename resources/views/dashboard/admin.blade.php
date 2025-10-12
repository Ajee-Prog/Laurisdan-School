


<!-- Admin Dashboard 2 blade -->

@extends('layouts.app')
@extends('layouts.dashboard')
@section('content')
<div class="container" style="margin-top:90px;">
  <h1 class="mb-4">Admin Dashboard</h1>
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

  <div class="row">
        <!-- Cards -->
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Students</h5>
                    <p class="card-text">Manage all students</p>
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">View</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Teachers</h5>
                    <p class="card-text">Manage teachers</p>
                    <a href="{{ route('teachers.index') }}" class="btn btn-primary btn-sm">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Exams</h5>
                    <p class="card-text">Setup and print exams</p>
                    <a href="{{ route('exams.index') }}" class="btn btn-primary btn-sm">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Books</h5>
                    <p class="card-text">Manage library</p>
                    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">View</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

<!-- @section('content') -->
<!-- <div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row">
        Cards -->
        <!-- <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Students</h5>
                    <p class="card-text">Manage all students</p>
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">View</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Teachers</h5>
                    <p class="card-text">Manage teachers</p>
                    <a href="{{ route('teachers.index') }}" class="btn btn-primary btn-sm">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Exams</h5>
                    <p class="card-text">Setup and print exams</p>
                    <a href="{{ route('exams.index') }}" class="btn btn-primary btn-sm">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Books</h5>
                    <p class="card-text">Manage library</p>
                    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">View</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->

