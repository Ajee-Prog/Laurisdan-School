@php
    // $admin   = Auth::guard('web')->user();
    // $student = Auth::guard('student')->user();
    $user = auth()->user();
@endphp


@extends('layouts.dashboard')

@section('content')
<h2>Parent Dashboard</h2>
<p>Hello {{ $user->name }}!</p>
<ul>
  @foreach($children as $child)
    <li>{{ $child->full_name }} ({{ $child->class->name }})</li>
  @endforeach
</ul>

        @if ($parent)
            <p><strong>Name:</strong> {{ $parent->name }}</p>
            <p><strong>Phone:</strong> {{ $parent->phone }}</p>

            <h4 class="mt-4">Children</h4>

            @forelse ($children as $child)
                <div class="border rounded p-2 mb-2">
                    <strong>{{ $child->name }}</strong>
                    <br> Class: {{ $child->class->name ?? 'N/A' }}
                </div>
            @empty
                <p>No children linked yet.</p>
            @endforelse

        @else
            <p class="text-danger">Parent profile not found.</p>
        @endif

        <div class="container">
            <div class="row mt-4">
                <div class="col-8">
                    <h3>My Children</h3>

                    @foreach($children as $child)
                    <div class="card mb-3 p-3">
                        <h5>{{ $child->name }}</h5>

                        <a href="{{ route('parent.results', $child->id) }}" class="btn btn-primary">
                            View Results
                        </a>

                        <a href="{{ route('parent.books', $child->id) }}" class="btn btn-success">
                            View Books
                        </a>

                        <a href="{{ route('parent.result.pdf', $child->id) }}" class="btn btn-danger">
                            Download Result PDF
                        </a>
                    </div>
                    @endforeach
                </div>


                <div class="col-4">
                    {{-- <h3>{{ $student->name }} - Books</h3> --}}

                    <table class="table table-bordered">
                        <tr>
                            <th>Title</th>
                            <th>Download</th>
                        </tr>

                        {{-- @foreach($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>
                                <a href="{{ asset('storage/'.$book->file) }}" class="btn btn-primary">
                                    Download
                                </a>
                            </td>
                        </tr>
                        @endforeach --}}
                    </table>
                </div>
            </div>
        </div>
@endsection
