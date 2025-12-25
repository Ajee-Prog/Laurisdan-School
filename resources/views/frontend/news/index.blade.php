@extends('frontend.layout')

@section('content')
<h2 class="mb-4">School News</h2>

<div class="row">
    @foreach($news as $item)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($item->image)
                <img src="{{ asset('news/'.$item->image) }}" class="card-img-top">
                @endif
                <div class="card-body">
                    <h5>{{ $item->title }}</h5>
                    <p>{{ Str::limit($item->content, 120) }}</p>
                    <a href="{{ route('news.single', $item->id) }}" class="btn btn-primary btn-sm">Read More</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{ $news->links() }}

@endsection