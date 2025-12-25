@extends('frontend.layout')

@section('content')
<h2>{{ $news->title }}</h2>

@if($news->image)
<img src="{{ asset('news/'.$news->image) }}" class="img-fluid mb-3">
@endif

<p>{!! nl2br(e($news->content)) !!}</p>

<a href="{{ route('news.public') }}" class="btn btn-secondary mt-3">Back to News</a>
@endsection