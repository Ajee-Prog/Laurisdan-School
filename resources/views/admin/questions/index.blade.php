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
                @if($opt->is_correct) ✅ @endif
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

  {{ $questions->links() }}
</div>
@endsection