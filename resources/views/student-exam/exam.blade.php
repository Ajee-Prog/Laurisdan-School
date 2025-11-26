<h1>{{ $exam->title }}</h1>

<p>{{ $exam->instructions }}</p>

<a href="{{ url()->previous() }}">Back</a>