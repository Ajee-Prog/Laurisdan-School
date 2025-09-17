@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Book Details</h3>

    <div class="card">
        <div class="card-body">
            <h5>{{ $book->title }}</h5>
            <p><strong>Author:</strong> {{ $book->author ?? '—' }}</p>
            <p><strong>ISBN:</strong> {{ $book->isbn ?? '—' }}</p>
            <p><strong>Quantity:</strong> {{ $book->quantity }}</p>
            <p><strong>Notes:</strong><br>{{ $book->notes ?? '—' }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection