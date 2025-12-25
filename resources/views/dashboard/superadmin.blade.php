@extends('layouts.superadmin')

@section('content')
<div class="container">
    <h2 class="mb-3">Super Admin Dashboard</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h4>Total Students</h4>
                    <p>{{ \App\Models\Student::count() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h4>Total Teachers</h4>
                    <p>{{ \App\Models\Teacher::count() }}</p>
                </div>
            </div>
        </div>

        <!-- Add more summary cards -->
    </div>
</div>
@endsection