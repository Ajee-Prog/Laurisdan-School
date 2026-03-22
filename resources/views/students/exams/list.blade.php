@extends('layouts.app')
@section('content')
<div class="col-md-12 mt-4" style="padding-top: 60px;">
    <h3>Available Exams</h3>
    <div class="list-group">
        @foreach($exams as $exam)
        <a href="{{ route('student.exam.start', $exam->id) }}" class="list-group-item list-group-item-action btn btn-primary btn-sm mb-3">
        {{ $exam->title }} — Duration: {{ $exam->duration }} mins
        </a>
        @endforeach
    </div>
</div>

{{-- *************** To Choose one out of two --}}
    @foreach($exams as $exam)
        <tr>
            <td>{{ $exam->title }}</td>
            <td>{{ $exam->duration }} mins</td>
            <td>
                <a href="{{ route('student.exams.start',$exam->id) }}"
                class="btn btn-primary btn-sm">
                Start CBT
                </a>
            </td>
        </tr>
    @endforeach
{{-- *************** To choose end s here --}}
@endsection

{{-- @foreach($exams as $exam)
<tr>
    <td>{{ $exam->title }}</td>
    <td>{{ $exam->duration }} mins</td>
    <td>
        <a href="{{ route('student.exam.start',$exam->id) }}"
           class="btn btn-primary btn-sm">
           Start CBT
        </a>
    </td>
</tr>
@endforeach --}}
