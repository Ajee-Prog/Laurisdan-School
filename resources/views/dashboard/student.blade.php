@extends('layouts.dashboard')

@section('content')
<div class="container py-4" style="margin-top: 20px;">

  <h2>Student Dashboard</h2>

  @if(auth()->check())
    <p>Hello {{ auth()->user()->name }}!</p>
  @endif

  @if(isset($student))
    <h3>Welcome, {{ $student->name }}</h3>
  @else
    <h3>Welcome, {{ auth()->user()->name ?? 'Student' }}</h3>
    <p>Your student profile is not linked yet.</p>
  @endif

  @if(session('success'))
    <div class="alert alert-success mt-2">{{ session('success') }}</div>
  @endif

  <div class="row mt-4">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">My Profile</h5>
          @if(Route::has('profile.show'))
            <a href="{{ route('profile.show') }}" class="btn btn-info btn-sm">View</a>
          @endif
        </div>
      </div>
    </div>




     {{-- ================== MY EXAMS ================== --}}
        
                        

    <div class="col-md-4 mb-3">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">My Exams</h5>

          @if(isset($exams) && $exams->count())
            @foreach($exams as $exam)
              <div class="border p-2 mb-2 rounded">
                <!-- <span>{{ $exam->title }} ({{ $exam->duration }} min)</span> -->
                <strong>{{ $exam->title }} </strong> <br>
                 Duration: ({{ $exam->duration }} min)<br>
                @if(Route::has('student.exam'))
                  <a href="{{ route('student.exam', $exam->id) }}" class="btn btn-success btn-sm">Take Exam</a> <br><br><br>
                  <!-- testing the second method -->
                   <div>
                        <a href="{{ route('student.exam.view', $exam->id) }}" class="btn btn-outline-primary btn-sm">View</a>
                        <a href="{{ route('student.exam.start', $exam->id) }}" class="btn btn-success btn-sm">Start</a>
                    </div>
                    <!-- testing the second method ends here and remove if any error -->
                @else
                  <a href="#" class="btn btn-success btn-sm disabled" title="Route student.exam not defined">Take Exam</a>
                @endif
              </div>
            @endforeach
          @else
            <p class="text-muted">No exams available.</p>
            {{-- If you have an exams list route, show it --}}
            @if(Route::has('student.exams') || Route::has('student.exams.list'))
              <a href="{{ Route::has('student.exams') ? route('student.exams') : route('student.exams.list') }}" class="btn btn-outline-primary btn-sm">View Exams</a>
            @endif
          @endif

        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">My Books</h5>
          @if(Route::has('student.books'))
            <a href="{{ route('student.books') }}" class="btn btn-warning btn-sm">View</a>
          @else
            <a href="#" class="btn btn-warning btn-sm disabled" title="Route student.books not defined">View</a>
          @endif
        </div>
      </div>
    </div>

    <div class="col-md-4 mt-3">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">My Results</h5>
          @if(Route::has('student.results'))
            <a href="{{ route('student.results') }}" class="btn btn-info btn-sm">View Results</a>
          @else
            <a href="#" class="btn btn-info btn-sm disabled" title="Route student.results not defined">View Results</a>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mt-4">
    <div class="card-body">
      <h5>Your Profile</h5>
      <p class="mb-1"><strong>Email:</strong> {{ auth()->user()->email ?? 'N/A' }}</p> <br>
      <p class="mb-1"><strong>Class:</strong> {{ $student->schoolClass->name ?? ($student->class->name ?? 'N/A') }}</p> <br>
      <p class="mb-0"><strong>Parent Contact:</strong> {{ $student->parent_contact ?? 'N/A' }}</p>
    </div>
  </div>










  <!-- Not used -->
    {{-- ================== PROFILE CARD ================== --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h5>Your Profile</h5>

            <p>Email: {{ Auth::user()->email }}</p>
            <p>Class: {{ $student->class->name ?? 'N/A' }}</p>
            <p>Parent Contact: {{ $student->parent_contact ?? 'N/A' }}</p>

            <a href="" class="btn btn-info btn-sm">View Profile</a>
        </div>
    </div>


    <div class="row">

        {{-- ================== MY EXAMS ================== --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">My Exams</h5>

                    @forelse ($exams as $exam)
                        <div class="border p-2 mb-2 rounded">
                            <strong>{{ $exam->title }}</strong> <br>
                            Duration: {{ $exam->duration }} min <br>
                            <a href="{{ route('student.exam', $exam->id) }}" class="btn btn-success btn-sm mt-2">
                                Take Exam
                            </a>
                        </div>
                    @empty
                        <p class="text-muted">No exams available.</p>
                    @endforelse

                </div>
            </div>
        </div>

        {{-- ================== START EXAM ================== --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Attempt Exams</h5>
                    <a href="{{ route('exam.start', $exam->id) }}" class="btn btn-primary btn-sm">Start Exam</a>
                </div>
            </div>
        </div>

        {{-- ================== MY BOOKS ================== --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">My Books</h5>
                    <a href="" class="btn btn-warning btn-sm">View Books</a>
                </div>
            </div>
        </div>

        {{-- ================== MY RESULTS ================== --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">My Results</h5>
                    <a href="{{ route('student.results') }}" class="btn btn-dark btn-sm">View Results</a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection