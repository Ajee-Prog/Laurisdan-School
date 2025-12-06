


<!-- Admin Dashboard 2 blade -->

@extends('layouts.app')

@extends('layouts.dashboard')
@section('content')
<div class="container" style="margin-top:90px;">
  <h1 class="mb-4"><i class="bi bi-house"></i>Admin Dashboard Updated.....</h1>

  <!-- Just want to check what it contains -->
   <div class="container py-4">
        <h2>Admin Dashboard</h2>

        <div class="row mt-3">
            <div class="col-md-3">
            <div class="card p-3">
                <h5>Students</h5>
                <p class="display-4">{{ $students ?? \App\Models\Student::count() }}</p>
                <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-primary">Manage</a>
            </div>
            </div>
            <div class="col-md-3">
            <div class="card p-3">
                <h5>Teachers</h5>
                <p class="display-4">{{ $teachers ?? \App\Models\Teacher::count() }}</p>
                <a href="{{ route('teachers.index') }}" class="btn btn-sm btn-outline-primary">Manage</a>
            </div>
            </div>
            <div class="col-md-3">
            <div class="card p-3">
                <h5>Exams</h5>
                <p class="display-4">{{ \App\Models\Exam::count() }}</p>
                <a href="{{ route('exams.index') }}" class="btn btn-sm btn-outline-primary">Manage</a>
            </div>
            </div>
            <div class="col-md-3">
            <div class="card p-3">
                <h5>Questions</h5>
                <p class="display-4">{{ \App\Models\Question::count() }}</p>
                <a href="{{ route('questions.index') }}" class="btn btn-sm btn-outline-primary">Manage</a>
            </div>
            </div>
        </div>

  <hr>
  <h4 class="mt-4">Exams</h4>
  <div class="list-group">
        @foreach(\App\Models\Exam::latest()->take(10)->get() as $exam)
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $exam->title }}</strong><br>
                <small>{{ $exam->duration }} minutes | Questions: {{ $exam->questions()->count() }}</small>
            </div>

            <div>
                <a href="{{ route('exams.questions.create', $exam->id) }}" class="btn btn-primary btn-sm">Add Question</a>
                <a href="{{ route('exams.show', $exam->id) }}" class="btn btn-outline-secondary btn-sm">View</a>
            </div>
        </div>
        @endforeach
  </div>
</div>
   <!-- What its contains ends here -->

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
                        <h4>{{ $examCnt }}</h4>
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
                    @foreach($exams as $exam)
                    <a href="{{ route('exams.questions.create', $exam->id) }}" class="nav-link">
                        ➕ Add CBT Question to {{ \Illuminate\Support\Str::limit($exam->title, 30) }}
                    </a>

                    
                    <!-- <a href="{{ route('exams.questions.create', $exam->id) }}" class="nav-link">
                        Add Question to {{ \Illuminate\Support\Str::limit($exam->title, 30) }}
                    </a> -->
                    @endforeach
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

