@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Super Admin Dashboard</h2>

    <div class="row">

        <div class="col-md-3">
            <div class="card shadow p-3 text-center bg-primary text-white rounded">
                <h4>Total Admins</h4>
                <h2>{{ $totalAdmins }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow p-3 text-center bg-success text-white rounded">
                <h4>Total Teachers</h4>
                <h2>{{ $totalTeachers }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow p-3 text-center bg-warning text-white rounded">
                <h4>Total Students</h4>
                <h2>{{ $totalStudents }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow p-3 text-center bg-danger text-white rounded">
                <h4>Total Parents</h4>
                <h2>{{ $totalParents }}</h2>
            </div>
        </div>

    </div>

    <div class="row mt-4">

        <div class="col-md-3">
            <div class="card shadow p-3 text-center bg-info text-white rounded">
                <h4>Subjects</h4>
                <h2>{{ $totalSubjects }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow p-3 text-center bg-secondary text-white rounded">
                <h4>Classes</h4>
                <h2>{{ $classes }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow p-3 text-center bg-dark text-white rounded">
                <h4>Exams</h4>
                <h2>{{ $totalExams }}</h2>
            </div>
        </div>
        

        <div class="col-md-3">
            <div class="card shadow p-3 text-center bg-teal text-white rounded">
                <h4>Fee Structures</h4>
                <h2>{{ $fees }}</h2>
            </div>
        </div>

    </div>

</div>
@endsection