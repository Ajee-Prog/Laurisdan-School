@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Super Admin – Manage Administrators</h3>

    <a href="{{ route('superadmin.create') }}" class="btn btn-success mb-3">Add New Admin</a>

    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th width="180">Actions</th>
        </tr>

        @foreach($admins as $admin)
        <tr>
            <td>{{ $admin->name }}</td>
            <td>{{ $admin->email }}</td>
            <td>{{ strtoupper($admin->role) }}</td>

            <td>
                <a href="{{ route('superadmin.edit', $admin->id) }}" class="btn btn-primary btn-sm">Edit</a>

                <form action="{{ route('superadmin.delete', $admin->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection