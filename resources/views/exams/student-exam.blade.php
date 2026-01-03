@extends('layouts.dashboard')

@section('content')

<h2>{{ $exam->title }}</h2>
<p>Duration: {{ $exam->duration }} minutes</p>
<a href="{{ url()->previous() }}">Back</a>

<hr>

@foreach ($exam->questions as $q)
    <div class="mb-4 p-3 border rounded">
        <strong>Q{{ $loop->index + 1 }}. {{ $q->question }}</strong>

        <div class="mt-2">
            <label>
                <input type="radio" name="answer[{{ $q->id }}]" value="A"> {{ $q->option_a }}
            </label><br>
            <label>
                <input type="radio" name="answer[{{ $q->id }}]" value="B"> {{ $q->option_b }}
            </label><br>
            <label>
                <input type="radio" name="answer[{{ $q->id }}]" value="C"> {{ $q->option_c }}
            </label><br>
            <label>
                <input type="radio" name="answer[{{ $q->id }}]" value="D"> {{ $q->option_d }}
            </label>
            
        </div>

        
    </div>
@endforeach

@endsection