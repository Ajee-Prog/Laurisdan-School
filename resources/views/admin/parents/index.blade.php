@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Parents</h3>
        <a href="{{ route('parents.create') }}" class="btn btn-primary">Add Parent</a>
        
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($parents as $parent)
            <tr>
                <td>{{ $parent->id }}</td>
                <td>{{ $parent->name }}</td>
                <td>{{ $parent->email }}</td>
                <td>{{ $parent->phone }}</td>
                <td>{{ $parent->address }}</td>
                <td>
                    <form action="{{ route('parents.destroy', $parent->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete parent?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection