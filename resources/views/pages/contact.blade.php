@extends('layouts.app')

@section('content')
<div class="container py-5" style="color:navy; margin-top:80px;">
  <h1 class="text-center text-rimary mb-4">Contact Us</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('contact.send') }}" method="POST" class="col-md-8 mx-auto">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Full Name</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
      <label for="message" class="form-label">Message</label>
      <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Send Message</button>
    </div>
  </form>
</div>
@endsection