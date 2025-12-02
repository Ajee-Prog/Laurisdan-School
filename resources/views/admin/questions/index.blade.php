@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-3">Manage Questions</h2>
  <a href="{{ route('questions.create') }}" class="btn btn-primary mb-3">Add Question</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Question</th>
        <th>Options</th>
        <th>Correct</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($questions as $q)
        <tr>
          <td>{{ $q->id }}</td>
          <td>{{ $q->question }}</td>
          <td>
            @foreach($q->options as $opt)
              <div>{{ $opt->option_text }} 
                @if($opt->is_correct) @endif
              </div>
            @endforeach
          </td>
          <td>
            {{ $q->options->where('is_correct', true)->first()->option_text ?? 'N/A' }}
          </td>
          <td>
            <a href="{{ route('questions.edit', $q) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('questions.destroy', $q) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Delete question?')">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="mt-3">  {{ $questions->links() }}   </div>
</div>

<!-- To Choose either of these two -->
 <div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Question Bank</h3>
    <div>
      <a class="btn btn-success" href="{{ route('exams.questions.create', '') }}">+ Add Question</a>
      <a class="btn btn-secondary" href="{{ route('admin.questions.export.csv', request()->query()) }}">Export CSV</a>
    </div>
  </div>

  <form class="mb-3" method="GET" action="{{ route('admin.questions.index') }}">
    <div class="row g-2">
      <div class="col-md-4">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search question or option...">
      </div>
      <div class="col-md-3">
        <select name="exam_id" class="form-control">
          <option value="">-- All exams --</option>
          @foreach($exams as $e)
            <option value="{{ $e->id }}" {{ request('exam_id') == $e->id ? 'selected':'' }}>{{ $e->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-primary">Filter</button>
      </div>
    </div>
  </form>

  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

  <table class="table table-striped">
    <thead><tr>
      <th>#</th><th>Exam</th><th>Question</th><th>Correct</th><th>Actions</th>
    </tr></thead>
    <tbody>
      @foreach($questions as $question)
        <tr>
          <td>{{ $question->id }}</td>
          <td>{{ optional($question->exam)->title ?? '-' }}</td>
          <td>{!! \Illuminate\Support\Str::limit($question->question_text, 120) !!}</td>
          <td>{{ $question->correct_option }}</td>
          <td>
            <a href="{{ route('admin.questions.show', $question->id) }}" class="btn btn-sm btn-info">View</a>
            <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display:inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Delete question?')">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $questions->links() }}
</div>
 <!-- To choose ends here -->
@endsection