
@extends('layouts.app')
@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h3>Subject List</h3>
    <a href="{{ route('subjects.create') }}" class="btn btn-primary mb-3">Add Subject</a>

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Code</th>
            <th>Class</th>
            <th>Action</th>
        </tr>

        @foreach($subjects as $subject)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $subject->name }}</td>
            <td>{{ $subject->code }}</td>
            <td>Primary {{ $subject->class }}</td>
            <td>
                <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning">Edit</a>

                <form method="POST" action="{{ route('subjects.destroy', $subject->id) }}" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete subject?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
</div>
@endsection