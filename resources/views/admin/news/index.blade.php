@extends('layouts.admin')

@section('content')
<h3>News List</h3>

<a href="{{ route('news.create') }}" class="btn btn-primary mb-3">Add News</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Image</th>
            <th>Posted By</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($news as $item)
        <tr>
            <td>{{ $item->title }}</td>
            <td>
                @if($item->image)
                <img src="{{ asset('news/'.$item->image) }}" width="60">
                @endif
            </td>
            <td>{{ $item->author->name }}</td>
            <td>{{ $item->created_at->format('d M Y') }}</td>
            <td>
                <a href="{{ route('news.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger"
                        onclick="return confirm('Delete this news?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $news->links() }}

@endsection