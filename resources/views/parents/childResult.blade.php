@section('content')
<div class="container" style="margin-top: 90px;">


    @foreach($students as $student)
    <h4>{{ $student->name }}</h4>

    <table class="table table-bordered">
    @foreach($student->results as $result)
    <tr>
        <td>{{ $result->exam->title }}</td>
        <td>{{ $result->score }}</td>
    </tr>
    @endforeach
    </table>
    @endforeach

</div>
@endsection