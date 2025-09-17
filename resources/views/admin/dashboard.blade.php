@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Total Students</h5>
                    <p class="fs-4">{{ $students }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Total Teachers</h5>
                    <p class="fs-4">{{ $teachers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Total Classes</h5>
                    <p class="fs-4">{{ $classes }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection