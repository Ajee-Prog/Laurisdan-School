@php
    $admin   = Auth::guard('web')->user();
    $student = Auth::guard('student')->user();
@endphp

@extends('layouts.student')


<!-- New start -->
@extends('layouts.admin')




<!-- New end -->


@section('title', 'Student Dashboard')

@section('content')
<div class="container">
    <!-- <h1> Hello, {{ Auth::user()->name }} (Student) </h1> -->

    <h1>Welcome, {{ Auth::user()->name }} (Student)  thisssssssssss</h1>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">My Profile</h5>
                    <a href="{{ route('profile.show') }}" class="btn btn-info btn-sm">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">My Exams</h5>
                    <a href="{{ route('student.exams') }}" class="btn btn-success btn-sm">Take Exam</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">My Books</h5>
                    <a href="{{ route('student.books') }}" class="btn btn-warning btn-sm">View</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- <div class="row">
        <div class="col-md-6"> -->
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5> Your Profile</h5>
                    <p class="fs-3"> Email: {{ Auth::user()->email }} </p>
                    <p class="fs-3"> Class: {{ $student->class->name ?? 'N/A' }} </p>
                    <p class="fs-3"> Parent Contact: {{ $student->parent_contact ?? 'N/A' }} </p>
                    
                </div>



               
            </div>

             <div class="container">
                    <h1 class="mb-4">Welcome, {{ Auth::user()->name }}</h1>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Your Profile</h5>
                            <p>Email: {{ Auth::user()->email }}</p>
                            <p>Class: {{ Auth::user()->student->class->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

            
       
</div>
@endsection

