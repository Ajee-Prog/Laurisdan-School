


<!-- Admin Dashboard 2 blade -->

@extends('layouts.app')

@extends('layouts.dashboard')
@section('content')
<div class="container" style="margin-top:90px;">
  <h1 class="mb-4"><i class="bi bi-house"></i>Admin Dashboard Updated.....</h1>

  <div class="row">
  <div class="col-md-3"><div class="card p-3">Students<br><h3>{{ $students }}</h3></div></div>
  <div class="col-md-3"><div class="card p-3">Teachers<br><h3>{{ $teachers }}</h3></div></div>
  <div class="col-md-3"><div class="card p-3">Classes<br><h3>{{ $classes }}</h3></div></div>
  <div class="col-md-3"><div class="card p-3">Books<br><h3>{{ $books }}</h3></div></div>
</div>
<div class="mt-3">Exams: {{ $exams }}</div>


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
                        <h4>{{ $students }}</h4>

                        <h5 class="card-title">Students</h5>
                        <p class="card-text">Manage all students</p>
                        <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h4>{{ $teachers }}</h4>
                        <h5 class="card-title">Teachers</h5>
                        <p class="card-text">Manage teachers</p>
                        <a href="{{ route('teachers.index') }}" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h4>{{ $exams }}</h4>
                        <h5 class="card-title">Exams</h5>
                        <p class="card-text">Setup and print exams</p>
                        <a href="{{ route('exams.index') }}" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h4>{{ $books }}</h4>
                        <h5 class="card-title">Books</h5>
                        <p class="card-text">Manage library</p>
                        <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>

                <li class="nav-item">
    <a href="{{ route('questions.create') }}" class="nav-link">
        ➕ Add CBT Question
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('questions.index') }}" class="nav-link">
        📚 Manage Questions
    </a>
</li>
            </div>
        </div>
    </div>


   

</div>
@endsection

