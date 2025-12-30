@php
    $admin   = Auth::guard('web')->user();
    $student = Auth::guard('student')->user();
@endphp


@extends('layouts.dashboard')

@section('content')
<h2>Parent Dashboard</h2>
<p>Hello {{ Auth::user()->name }}!</p>
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
@endsection