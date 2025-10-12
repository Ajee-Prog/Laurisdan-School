@extends('layouts.sidebar')

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

@endsection