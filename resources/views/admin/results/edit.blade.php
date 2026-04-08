<h3>Edit Result</h3>

<p>Student: {{ $result->student->name }}</p>
<p>Exam: {{ $result->exam->title }}</p>

<form method="POST" action="{{ route('admin.results.update', $result->id) }}">

    <label>CA Score</label>
    <input type="number" name="ca_score" value="{{ $result->ca_score }}" class="form-control">

    <label>Test Score</label>
    <input type="number" name="test_score" value="{{ $result->test_score }}" class="form-control">

    <label>Term</label>
    <select name="term_id" class="form-control">
        @foreach(\App\Models\Term::all() as $term)
            <option value="{{ $term->id }}">{{ $term->name }}</option>
        @endforeach
    </select>

    <label>Session</label>
    <select name="session_id" class="form-control">
        @foreach(\App\Models\Session::all() as $session)
            <option value="{{ $session->id }}">{{ $session->name }}</option>
        @endforeach
    </select>

    <button class="btn btn-success mt-2">Update</button>
</form>
