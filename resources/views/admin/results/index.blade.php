@extends('layouts.app')

@section('content')


{{-- <form method="GET" action="{{ route('admin.results') }}" class="row mb-3">
  <div class="col-md-3">
    <select name="session_id" class="form-control">
      <option value="">-- All Sessions --</option>
      @foreach($sessions as $s)
        <option value="{{ $s->id }}" {{ request('session_id') == $s->id ? 'selected' : '' }}>
          {{ $s->name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <select name="term_id" class="form-control">
      <option value="">-- All Terms --</option>
      @foreach($terms as $t)
        <option value="{{ $t->id }}" {{ request('term_id') == $t->id ? 'selected' : '' }}>
          {{ $t->name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <select name="subject_id" class="form-control">
      <option value="">-- All Subjects --</option>
      @foreach($subjects as $sub)
        <option value="{{ $sub->id }}" {{ request('subject_id') == $sub->id ? 'selected' : '' }}>
          {{ $sub->name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <button type="submit" class="btn btn-primary">Filter</button>
    <a href="{{ route('admin.results.pdf', request()->all()) }}" class="btn btn-danger">Export PDF</a>
  </div>
</form> --}}

{{-- New result pattern --}}

<div class="container-fluid" style="margin-top: 90px;">
    <div class="row justify-content-between mb-3">
        <h3 class="mt-5 text-primary" >All Student Results</h3>
    <a href="{{ route('dashboard') }}">Go back to Dashboard </a>
    </div>
    {{-- <h3 class="mt-5 text-primary" >All Student Results</h3>
    <a href="{{ route('dashboard') }}">Go back to Dashboard </a> --}}

    {{-- <table class="table table-bordered">
        <tr>
            <th>Student</th>
            <th>Exam</th>
            <th>Score</th>
            <th>Action</th>
        </tr>

        @foreach($results as $result)
        <tr>
            {{-- <td>{{ $result->student->user->name }}</td> -}}
            <td>{{ $result->student->user->name }}</td>

            <td>{{ $result->exam->title }}</td>
            <td>{{ $result->exam_score }}</td>
            <td>
                <a href="{{ route('admin.results.edit', $result->id) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>
            </td>
        </tr>
        @endforeach
    </table> --}}

    {{-- New Table --}}
    <h3>Manage Student Results</h3>

<table class="table table-bordered">
    <tr>
        <th>Student</th>
        <th>Subject</th>
        <th>Exam Term</th>
        <th>Exam Score</th>
        <th>Test Score</th>
        <th>Total</th>
        <th>%</th>
        <th>Grade</th>
        <th>Affective/Psycho</th>
        <th>Teacher Comment</th>
        <th>Action</th>
    </tr>

    @foreach($results as $result)
    {{--
    form action="{{ route('admin.results.test_score') }}" method="POST">
                @csrf
                 --}}
    <tr>
        {{-- <td>{{ $result->student->first_name }}</td> --}}
        <td>{{ $result->student->user->name }}</td>
        <td>{{ $result->exam->subject }}</td>
        <td>{{ $result->exam->title }}</td>
        <td>{{ $result->exam_score }}</td>

        <td>
            <form action="{{ route('admin.results.test_score') }}" method="POST">
                @csrf
                <input type="hidden" name="result_id" value="{{ $result->id }}">

                <input type="number"
                       name="test_score"
                       value="{{ $result->test_score }}"
                       class="form-control">

        </td>

        <td>{{ $result->total }}</td>
        <td>{{ $result->percentage }}%</td>
        <td>{{ $result->grade }}</td>
        <!-- Psychomotor -->
        <td>
            <select name="psychomotor">
                <option value="1">Excellent</option>
                <option value="2">Very Good</option>
                <option value="3">Good</option>
                <option value="4">Fair</option>
                <option value="5">Poor</option>
            </select>
        </td>

        <!-- Teacher Comment -->
        <td>
            <input type="text" name="teacher_comment" value="{{ $result->teacher_comment }}">
        </td>
        {{-- Teacher comment ends here. I need form to wrap psycho and comment --}}

        <td>
                <button class="btn btn-success btn-sm">Save</button>
                {{-- New added button --}}
                <a href="{{ route('admin.results.edit', $result->id) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>
            </form>
        </td>
    </tr>
    {{-- </form> --}}
    @endforeach
</table>
</div>


{{-- New for Student result page --}}

{{-- New for Student result page Ends --}}

{{--
    Controller
    $total = $results->sum('total_score');
    $count = $results->count();

    $average = $count ? $total / $count : 0;

    $overallGrade = $this->getGrade($average);

    Pass to blade:

    return view('students.results', compact('results', 'average', 'overallGrade'));

    //For Parent - PARENT VIEW
    $results = ExamResult::whereIn('student_id', auth()->user()->children->pluck('id'))->get();
 --}}
 {{-- Coming back to this for use example--}}

    {{-- @foreach($results as $result)
    <form action="{{ route('admin.results.update', $result->id) }}" method="POST">
        @csrf

        <td>{{ $result->student->first_name }}</td>
        <td>{{ $result->subject->name }}</td>

        <td>
            <input type="number" name="ca_score" value="{{ $result->ca_score }}">
        </td>

        <td>
            <input type="number" name="test_score" value="{{ $result->test_score }}">
        </td>

        <td>
            <input type="number" name="exam_score" value="{{ $result->exam_score }}">
        </td>

        <!-- Psychomotor -->
        <td>
            <select name="psychomotor">
                <option value="1">Excellent</option>
                <option value="2">Very Good</option>
                <option value="3">Good</option>
                <option value="4">Fair</option>
                <option value="5">Poor</option>
            </select>
        </td>

        <!-- Teacher Comment -->
        <td>
            <input type="text" name="teacher_comment" value="{{ $result->teacher_comment }}">
        </td>

        <td>
            <button class="btn btn-success">Save</button>
        </td>
    </form>
    @endforeach
  --}}

@endsection
