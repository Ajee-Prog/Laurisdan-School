@extends('layouts.admin')
@section('content')
<div class="container mt-4">
  <h3>Manage Users</h3>
  <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">Add New User</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Relation</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ ucfirst($user->role) }}</td>
        <td>
            @if($user->role === 'student')
                Class: {{ $user->student->class->name ?? 'N/A' }} <br>
                Parent: {{ $user->student->parent->name ?? 'N/A' }}
            @else
                —
            @endif
        </td>
        <td>
          <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $users->links() }}
</div>
@endsection