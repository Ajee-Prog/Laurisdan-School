@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Edit Subject</h3>

    <form method="POST" action="{{ route('subjects.update', $subject->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input name="name" value="{{ $subject->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Code</label>
            <input value="{{ $subject->code }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label>Class</label>
            <select name="class" class="form-control" required>
                @for($i=1;$i<=6;$i++)
                <option value="{{ $i }}" @if($subject->class==$i) selected @endif>
                    Primary {{ $i }}
                </option>
                @endfor
            </select>
        </div>

        <button class="btn btn-success">Update</button>
    </form>

</div>
@endsection