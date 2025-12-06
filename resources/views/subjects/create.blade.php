@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Add Subject</h3>

    <form method="POST" action="{{ route('subjects.store') }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Code</label>
            <input name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Class</label>
            <select name="class" class="form-control" required>
                <option value="">Select class</option>
                @for($i=1;$i<=6;$i++)
                <option value="{{ $i }}">Primary {{ $i }}</option>
                @endfor
            </select>
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection