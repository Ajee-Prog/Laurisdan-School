@extends('layouts.sidebar')

@section('content')
<h1>Admin Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}</p>

    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5>Students</h5>
                    <p>Manage all students</p>
                </div>
            </div>
        </div>
        <!-- To repeat other cards later... -->
    </div>



<div class="container">
    <h1 class="mb-4"><i class="bi bi-house"></i>Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5> Total  Students</h5>
                    <p class="fs-4">{{ $students }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5>Total Teachers</h5>
                    <p class="fs-4">{{ $teachers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5>Total Classes</h5>
                    <p class="fs-4">{{ $classes }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5>Books</h5>
                    <p class="fs-4">{{ $books }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5>Exams</h5>
                    <p class="fs-4">{{ $exams }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- @endsection -->


<!-- Admin setup -->

<!-- @section('content') -->
<div class="container">
    <h1 class="mb-4">Admin Dashboard --removeUpdate later---</h1>

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
@endsection