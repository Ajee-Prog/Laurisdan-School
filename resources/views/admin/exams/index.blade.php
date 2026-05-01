@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h2>Exams</h2>
  <a href="{{ route('exams.create') }}" class="btn btn-primary">Add Exam</a>
  {{-- New Questions from here --}}
  {{-- <span>Add bulk questions for students exam</span> --}}
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            @foreach($exams as $exam)
                <tr>
                    <td>{{ $exam->title }}</td>
                    <td>
                        <a href="{{ route('admin.questions.bulk.create', $exam->id) }}"
                        class="btn btn-primary btn-sm">
                        Add Questions..bulks
                        </a>
                    </td>
                </tr>
            @endforeach
        </div>
        {{--  --}}
            {{-- <span>Generate code for students exam</span> --}}
        <div class="col-6">
            @foreach($exams as $exam)
                <div class="col-md-3">

                    <a href="{{ route('admin.exams.generate.code', $exam->id) }}"
                    class="btn btn-warning w-100 mb-2">
                    Generate Code for {{ $exam->title }}
                    </a>

                    <p>Code: {{ $exam->access_code ?? 'Not generated' }}</p>

                </div>
            @endforeach
        </div>
    </div>
  </div>


    {{-- @foreach($exams as $exam)

        <tr>
            <td>{{ $exam->title }}</td>
            <td>
                <a href="{{ route('admin.questions.bulk.create', $exam->id) }}"
                class="btn btn-primary btn-sm">
                Add Questions..bulks
                </a>
            </td>
        </tr>
    @endforeach --}}

{{--  --}}
{{-- <span>Generate code for students exam</span> --}}
{{-- @foreach($exams as $exam)
<div class="col-md-3">

    <a href="{{ route('admin.exams.generate.code', $exam->id) }}"
       class="btn btn-warning w-100 mb-2">
       Generate Code for {{ $exam->title }}
    </a>

    <p>Code: {{ $exam->access_code ?? 'Not generated' }}</p>

</div>
@endforeach --}}
{{-- New ends here --}}
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>S/N</th>
      <th>Title</th>
      <th>Date</th>
      <th>Class</th>
      <th>Action</th></tr>
  </thead>
  <tbody>
    @foreach($exams as $e)
      <tr>
        <td>{{ $e->id }}</td>
        <td>{{ $e->title }}</td>
        <td>{{ $e->exam_date }}</td>
        <td>{{ $e->class->name ?? '' }}</td>
        <td>
          <a href="{{ route('admin.exams.show', $e->id) }}" class="btn btn-sm btn-info">View</a>
          <a href="{{ route('exams.edit',$e->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('exams.destroy',$e->id) }}" method="POST" style="display:inline-block;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
