@extends('layouts.app')

@section('content')
<div class="container py-4 text-center" style="margin-top: 60px;">
    {{-- ================= PROFILE SUMMARY ================= --}}
    <div class="card shadow-sm mb-4">
        <div class="row align-center" style=" align-items: center; justify-content: center; ">
            <div class="col-4">
                <img src="{{asset('assets/images/laurisdanLogo1.jpg')}}"  style="width: 40p; height:60px; " alt="">
            </div>
            {{-- 8 section long --}}
            <div class="col-8">

                <div class="card-body">

                    <h5 class="" style="width: 100%"> LAURISDAN NURSERY AND PRIMARY SCHOOL </h5>
                    <p> ENGR. AWANBI BENSON STREET, OFFIRAN, ONOSA, IBEJU-LEKKI LGA, LAGOS.</p>
                    <p> TEL: 09034345478, 07088800744. EMAIL: laurisdannpschool@gmail.com</p>


                    @if(Route::has('student.profile'))
                        <a href="{{ route('student.profile') }}" class="btn btn-info btn-sm">View Full Profile</a>
                    @endif
                </div>

            </div>
        </div>

    </div>
    {{-- New ends here --}}
  <h2>Exam Result</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- ************* --}}
    <h2>Exam Completed</h2>
    <p><strong>{{ $exam->title ?? 'N/A'}}</strong></p>
    <h3>Your Score: {{ $score }} / {{ $total ?? 'N/A'}}</h3>

    <a href="{{ route('dashboard') }}" class="btn btn-success">
        Back to Dashboard
    </a>
  {{-- ******************* --}}

  <p class="mt-3">
    You scored <strong>{{ $score }}</strong> out of
    {{-- <strong>{{ $total }}</strong>.</p> --}}

  {{-- @if($score >= ($total/2))
    <div class="alert alert-success mt-3">Congratulations! You passed 🎉</div>
  @else
    <div class="alert alert-danger mt-3">You did not pass. Try again!</div>
  @endif --}}

  <a href="{{ route('student.exams') }}" class="btn btn-primary mt-3">Retake Exam</a>
</div>

<!-- Filter Result -->
 <form method="GET" action="{{ route('student.results') }}" class="row mb-3">
  <div class="col-md-3">
    <select name="session_id" class="form-control">
      <option value="">-- All Sessions --</option>
      {{-- @foreach($sessions as $s)
        <option value="{{ $s->id }}" {{ request('session_id') == $s->id ? 'selected' : '' }}>
          {{ $s->name }}
        </option>
      @endforeach --}}
    </select>
  </div>
  <div class="col-md-3">
    <select name="term_id" class="form-control">
      <option value="">-- All Terms --</option>
      {{-- @foreach($terms as $t)
        <option value="{{ $t->id }}" {{ request('term_id') == $t->id ? 'selected' : '' }}>
          {{ $t->name }}
        </option>
      @endforeach --}}
    </select>
  </div>
  <div class="col-md-3">
    <select name="subject_id" class="form-control">
      <option value="">-- All Subjects --</option>
      {{-- @foreach($subjects as $sub)
        <option value="{{ $sub->id }}" {{ request('subject_id') == $sub->id ? 'selected' : '' }}>
          {{ $sub->name }}
        </option>
      @endforeach --}}
    </select>
  </div>
  <div class="col-md-3">
    <button type="submit" class="btn btn-primary">Filter</button>
    {{-- <a href="{{ route('student.results.pdf', request()->all()) }}" class="btn btn-danger">Download PDF</a> --}}
</div>
</form>

{{-- Or This New Result table --}}
<form method="GET">
    <select name="term_id">
        <option value="">All Terms</option>
    </select>

    <select name="session_id">
        <option value="">All Sessions</option>
    </select>

    <button class="btn btn-info">Filter</button>
</form>

<table class="table">
    <tr>
        <th>Subject</th>
        <th>Test</th>
        <th>Exam</th>
        <th>Total</th>
        <th>%</th>
        <th>Grade</th>
    </tr>

    {{-- @foreach($results as $r)
    <tr>
        <td>{{ $r->exam->subject }}</td>
        <td>{{ $r->test_score }}</td>
        <td>{{ $r->exam_score }}</td>
        <td>{{ $r->total_score }}</td>
        <td>{{ $r->percentage }}%</td>
        <td>{{ $r->grade }}</td>
    </tr>
    @endforeach --}}
</table>
@endsection
