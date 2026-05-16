<form action="{{ route('admin.results.test_score') }}" method="POST">
    @csrf
    <input type="hidden" name="result_id" value="{{ $result->id }}">

    <input type="number" name="test_score"
           value="{{ $result->test_score }}"
           class="form-control">

    <button class="btn btn-primary mt-2">Save</button>
</form>
