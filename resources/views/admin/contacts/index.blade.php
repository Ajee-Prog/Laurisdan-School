@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-4">Contact Messages</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered table-striped">
    <thead class="table-primary">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($contacts as $contact)
      <tr>
        <td>{{ $contact->id }}</td>
        <td>{{ $contact->name }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ Str::limit($contact->message, 50) }}</td>
        <td>{{ $contact->created_at->format('d M Y') }}</td>
        <td>
          <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-info">View</a>
          <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete message?')">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $contacts->links() }}
</div>
@endsection