@extends('layouts.dashboard')

@section('content')
<h2>Parent Dashboard</h2>
<p>Hello {{ Auth::user()->name }}!</p>
<ul>
  @foreach($children as $child)
    <li>{{ $child->full_name }} ({{ $child->class->name }})</li>
  @endforeach
</ul>
@endsection