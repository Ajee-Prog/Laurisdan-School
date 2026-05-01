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

<div class="container" style="margin-top: 90px;">
    <h3 class="mt-5" >All Student Results</h3>
    <a href="{{ route('dashboard') }}">Go back to Dashboard </a>

    <table class="table table-bordered">
        <tr>
            <th>Student</th>
            <th>Exam</th>
            <th>Score</th>
            <th>Action</th>
        </tr>

        @foreach($results as $result)
        <tr>
            {{-- <td>{{ $result->student->user->name }}</td> --}}
            <td>{{ $result->student->user->name }}</td>

            <td>{{ $result->exam->title }}</td>
            <td>{{ $result->score }}</td>
            <td>
                <a href="{{ route('admin.results.edit', $result->id) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>
            </td>
        </tr>
        @endforeach
    </table>

    {{-- New Table --}}
    <h3>Manage Student Results</h3>

<table class="table table-bordered">
    <tr>
        <th>Student</th>
        <th>Subject</th>
        <th>Exam Score</th>
        <th>Test Score</th>
        <th>Total</th>
        <th>Action</th>
    </tr>

    @foreach($results as $result)
    <tr>
        <td>{{ $result->student->name }}</td>
        <td>{{ $result->exam->subject }}</td>
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

        <td>{{ $result->total_score }}</td>

        <td>
                <button class="btn btn-success btn-sm">Save</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
</div>

@endsection
