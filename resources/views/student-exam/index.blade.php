<h2>Your Exams</h2>

@foreach($exams as $exam)
    <a href="{{ route('student.exam.view', $exam->id) }}">
        {{ $exam->title }}
    </a>
    <br>
@endforeach