@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Message from {{ $contact->name }}</h2>
  <p><strong>Email:</strong> {{ $contact->email }}</p>
  <p><strong>Message:</strong></p>
  <div class="alert alert-light">{{ $contact->message }}</div>
  <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection