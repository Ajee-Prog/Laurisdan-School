@extends('layouts.sidebar')

@section('content')
<div class="container">
    <h1> Hello, {{ Auth::user()->name }} (Student) </h1>
    
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
       
</div>
@endsection

@section('content')
<div class="container">
    <h1>Welcome, {{ Auth::user()->name }}</h1>

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
</div>

<!-- CBT -->

<div class="container py-4">
  <h3>Welcome, {{ $student->full_name }}</h3>
  <div class="row mt-3">
    <div class="col-md-4">
      <div class="card shadow p-3">
        <h5>Profile</h5>
        <img src="{{ asset('storage/'.$student->passport) }}" width="100" class="rounded-circle mb-2">
        <p><b>Class:</b> {{ $student->class->name }}</p>
        <p><b>Phone:</b> {{ $student->phone }}</p>
      </div>
    </div>

    <div class="col-md-8">
      <div class="card shadow p-3">
        <h5>Recent Results</h5>
        <table class="table table-bordered">
          <thead><tr><th>Subject</th><th>Score</th><th>Status</th></tr></thead>
          <tbody>
            @foreach($exams as $r)
              <tr>
                <td>{{ $r->subject }}</td>
                <td>{{ $r->score }}</td>
                <td>
                  @if($r->score >= 50)
                    <span class="badge bg-success">Pass</span>
                  @else
                    <span class="badge bg-danger">Fail</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="mt-3">
          <h5>Take an Exam:</h5>
          <a href="{{ route('exam.start','Mathematics') }}" class="btn btn-primary">Mathematics</a>
          <a href="{{ route('exam.start','English') }}" class="btn btn-info">English</a>
          <a href="{{ route('exam.start','Science') }}" class="btn btn-warning">Science</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Performance Overview starts -->
 <div class="container py-4">
  <h2>Welcome, {{ $student->name }}</h2>

  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card p-3 shadow">
        <h4>Performance Overview</h4>
        <canvas id="resultsChart"></canvas>
      </div>
    </div>
  </div>
</div>

<script>
  const ctx = document.getElementById('resultsChart').getContext('2d');
  const resultsChart = new Chart(ctx, {
    type: 'bar', // can also be 'line'
    data: {
      labels: {!! json_encode($chartLabels) !!},
      datasets: [{
        label: 'Average Score',
        data: {!! json_encode($chartScores) !!},
        backgroundColor: 'rgba(54, 162, 235, 0.6)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: { beginAtZero: true, max: 100 }
      }
    }
  });
</script>
<!-- Performance overview ends -->

@endsection