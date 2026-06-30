<!DOCTYPE html>
<html>
<head>
    <title>Student Result</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  {{-- <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" type="text/css"> --}}


    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 90%; margin: auto; }

        h2, h4 { text-align: center; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        .no-border td {
            border: none;
            text-align: left;
        }

        .print-btn { margin: 10px; }

        @media print {
            .print-btn { display: none; }
        }
    </style>
</head>

<body>

<div class=" container-fluid container-fluid">

<button onclick="window.print()" class="print-btn">Print</button>

<h2>LAURISDAN NURSERY & PRIMARY SCHOOL</h2>
<h4>STUDENT REPORT SHEET</h4>

{{-- STUDENT DETAILS --}}
@forelse($groupedResults as $termId => $termResults)
<table class="no-border">
    <tr>
        <td><strong>Name:</strong> {{ $student->first_name }}</td>
        <td><strong>Class:</strong> {{ $student->class->name }}</td>
    </tr>

    <tr>
        <td><strong>Date of Birth:</strong> {{ $student->date_of_birth }}</td>
        <td><strong>Gender:</strong> {{ $student->gender }}</td>
    </tr>

    <tr>
         <td><strong>Session:{{--</strong> {{ $session->name }}   --}}</td>

         <td><strong>Term: {{-- </strong> {{ $term->name }}   --}}</td>
    </tr>
</table>

{{-- SUBJECT RESULTS --}}
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Subject</th>
            <th>Score</th>
            <th>Grade</th>
        </tr>
    </thead>

    <tbody>
        {{-- @foreach($subjects as $key => $subject) --}}
        @foreach($termResults as $result)
        <tr>
            {{-- <td>{{ $key + 1 }}</td> --}}
            <td>{{ $result->subject->name }}</td>
            <td>{{ $result->score }}</td>
            <td>
                @if($result->total >= 70) A
                @elseif($result->total >= 60) B
                @elseif($result->total >= 50) C
                @elseif($result->total >= 45) D
                @elseif($result->total >= 40) E
                @else F
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- SUMMARY --}}
<table>
    {{-- @forelse($groupedResults as $termId => $termResults) --}}
    @foreach($termResults as $result)
    <tr>
        <td><strong>Total Score:</strong> {{ $result->total }}</td>
        <td><strong>Percentage:</strong> {{ $result->percentage }}%</td>
    </tr>

    <tr>
        <td><strong>Marks Obtained:</strong> {{ $result->marks_obtained }}</td>
        <td><strong>Grade:</strong> {{ $result->grade }}</td>
    </tr>

    <tr>
        <td><strong>Overall Grade:</strong> {{ $result->overall_grade }}</td>
        <td><strong>Time Present:</strong> {{ $result->time_present }}</td>
    </tr>

    <tr>
        <td><strong>Time Absent:</strong> {{ $result->time_absent }}</td>
        <td></td>
    </tr>
    @endforeach
    @empty
    @endforelse
</table>

{{-- AFFECTIVE & PSYCHOMOTOR --}}
<table>
    <thead>
        <tr>
            <th>Affective</th>
            <th>Psychomotor</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ $result->affective }}</td>
            <td>{{ $result->psychomotor }}</td>
        </tr>
    </tbody>
</table>

{{-- TEACHER COMMENT --}}
<table>
    <tr>
        <td><strong>Class Teacher Comment:</strong></td>
    </tr>
    <tr>
        <td>{{ $result->teacher_comment }}</td>
    </tr>
</table>

<br><br>

{{-- SIGNATURE --}}
<table class="no-border">
    <tr>
        <td><strong>Class Teacher:</strong> ______</td>
        <td><strong>Principal:</strong> ______</td>
    </tr>
</table>

</div>

</body>
</html>


{{-- Another new one --}}
    <!DOCTYPE html>
<html>
<head>
    <title>Student Result</title>
    <style>
        body { font-family: Arial; }
        .container { width: 90%; margin: auto; }
        h2, h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: center; }
        .summary { margin-top: 10px; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">

    <h2>YUSTECH COMPUTER SCHOOL</h2>
    <h3>STUDENT RESULT SHEET</h3>

    <p><strong>Name:</strong> {{ $student->user->name }}</p>
    <p><strong>Class:</strong> {{ $student->class->name ?? 'N/A' }}</p>

    @forelse($groupedResults as $termId => $termResults)

        <h3>
            {{ strtoupper(optional($termResults->first()->term)->name ?? 'TERM') }} RESULT
        </h3>

        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>CA</th>
                    <th>Test</th>
                    <th>Exam</th>
                    <th>Total</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach($termResults as $result)
                    <tr>
                        <td>{{ $result->subject->name ?? 'N/A' }}</td>
                        <td>{{ $result->ca_score }}</td>
                        <td>{{ $result->test_score }}</td>
                        <td>{{ $result->exam_score }}</td>
                        <td>{{ $result->total }}</td>
                        <td>{{ $result->grade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
             Total Score: {{-- {{ $termSummaries[$termId]['total'] }} --}}<br>

             Average Score: {{-- {{ $termSummaries[$termId]['average'] }} --}}

        </div>

        <hr>

    @empty
        <p>No results available.</p>
    @endforelse

</div>

{{-- Test the Original Result --}}
    <div class="card shadow-sm mb-4">
        <div class="row align-center" style=" align-items: center; justify-content: center; ">
            <div class="col-4">
                <img src="{{asset('assets/images/laurisdanLogo1.jpg')}}"  style="width: 40p; height:60px; " alt="">
            </div>
            {{-- 8 section long --}}
            <div class="col-8">

                <div class="card-body">

                    <h5 class="" style="width: 100%"> LAURISDAN NURSERY AND PRIMARY SCHOOL </h5>
                    <p> ENGR. AWANBI BENSON STREET, OFFIRAN, ONOSA, IBEJU-LEKKI LGA, LAGOS.</p>
                    <p> TEL: 09034345478, 07088800744. EMAIL: laurisdannpschool@gmail.com</p>


                    @if(Route::has('student.profile'))
                        <a href="{{ route('student.profile') }}" class="btn btn-info btn-sm">View Full Profile</a>
                    @endif
                </div>

            </div>
        </div>

</div>

<section class="mt-4 mx-2">
        <div class="row">
            <div class="col-9">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        {{--<h3 class="bordered" style="border: 1px solid black">FIRST TERM</h3>--}}
                        <tr>
                            <th>NAMES</th>
                            <th> {{ strtoupper($student->last_name) ?? '-' }} {{ strtoupper($student->first_name) ?? '-' }}  {{ strtoupper($student->middle_name) ?? '-' }}</th>
                            <th>TERM</th>
                            <th>THIRD</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>CLASS</b></td>
                            <td>{{ $student->class->name ?? '-' }}</td>
                            <td></td>
                            <td><b> TIME SCHOOL OPENED</b></td>
                            <td>110</td>
                        </tr>
                        <tr>
                            <td><b>DATE OF BIRTH</b></td>
                            <td>{{ $student->date_of_birth ?? '-' }}</td>
                            <td></td>
                            <td><b> TIME PRESENT</b></td>
                            <td>110</td>
                        </tr>
                        <tr>
                            <td><b>GENDER</b></td>
                            <td>{{ strtoupper($student->gender) ?? '-' }}</td>
                            <td><b> WEIGHT</b></td>
                            <td>54KG</td>
                            <td>TIME ABSENT</td>
                        </tr>
                        <tr>
                            <td><b>SESSION</b></td>
                            <td>2024/2025 {{ $student->session->name ?? '-' }}</td>
                            <td><b> HEIGHT</b></td>
                            <td>5FT 3 INCH</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="bordered text-center" style="border: 1px solid black; font-weight:bold; justify-content:center; margin-left: 30%; margin-top:0%">END OF TERM REPORT</h3>
            </div>
            {{-- Second Table start here --}}
            <div class="col-3">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        {{--<h3 class="bordered" style="border: 1px solid black">SECOND TERM</h3>--}}
                        <tr>
                            <th>MARKS OBTAINABLE</th>
                            <th>5100</th>
                            {{-- <th>1st Term Exam (60)</th>
                            <th>% Marks obtain</th>
                            <th>Grade</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($subjects as $key => $subject) --}}

                        <tr>
                            <td>MARKS OBTAINABLE</td>
                            <td>5100</td>
                            {{-- <td>exam_score</td>
                            <td>score</td>
                            <td>
                                Grading

                            </td> --}}
                        </tr>
                        <tr>
                            <td>MARKS OBTAINED</td>
                            <td>3318</td>
                            {{-- <td>50</td>
                            <td>90</td>
                            <td>
                                A

                            </td> --}}
                        </tr>
                        <tr>
                            <td>PERCENTAGE</td>
                            <td>65%</td>
                            {{-- <td>50</td>
                            <td>90</td>
                            <td>
                                A

                            </td> --}}
                        </tr>
                        <tr>
                            <td>OVERALL GRADE</td>
                            <td>C</td>
                            {{-- <td>49</td>
                            <td>89</td>
                            <td>
                                B

                            </td> --}}
                        </tr>

                        {{-- @endforeach --}}
                    </tbody>
                    <tbody>
                        {{-- @foreach ($subjects as $key => $subject)

                        <tr>
                            <td>$subject->subject</td>
                            <td>$subject->ca_score</td>
                            <td>$subject->exam_score</td>
                            <td>$subject->score</td>
                            <td>
                                @if ($subject->score >= 90 ?? )
                                A
                                @elseif ($subject->score >= 70 ?? )
                                B
                                @elseif ($subject->score >= 60 ?? )
                                C
                                @elseif ($subject->score >= 50 ?? )
                                D

                                @else
                                NI

                                @endif
                            </td>
                        </tr>

                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    {{-- New ends here --}}
    {{-- New result design for new controller starts --}}
        <section class="mt-4">
            @forelse($groupedResults as $termId => $termResults)
            {{-- @if($term && ($term->name === 'First Term' || $term->name === 'Second Term')) --}}
            {{ strtoupper(optional($termResults->first()->term)->name) ?? 'No Term Name' }}

            {{-- <h4>{{ $term->name }} Result</h4> --}}

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Test</th>
                        <th>Exam</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse($groupedResults as $result) --}}
                    @foreach($termResults as $result)
                    <tr>
                        <td>{{ $result->subject->name }}</td>
                        <td>{{ $result->test_score }}</td>
                        <td>{{ $result->exam_score }}</td>
                        <td>{{ $result->total }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-center text-danger">No Result</td>
                    </tr>
                    {{-- @endforelse --}}
                </tbody>
            </table>
            @empty
                <p>No results available.</p>
            @endforelse

{{-- -----------------End of Working fine well-------------- --}}


<section class="mt-4">
    @forelse($groupedResults as $termId => $termResults)
            {{-- @if($term && ($term->name === 'First Term' || $term->name === 'Second Term')) --}}
           {{-- <h3 class="bordered" style="border: 1px solid black">=+ {{ optional($termResults->first()->term)->name ?? 'No Term Name' }}</h3> --}}


        <div class="row">
            @if ($termResults->first()->term->name === 'First term')

            {{-- @else --}}

            {{-- @endif --}}
            <div class="col-6">

                {{-- <h4>{{ $termResults->first()->term->name ?? 'Term' }}</h4> --}}
                <table class="table table-bordered">

                    <thead class="table-dark">

                        {{-- <h3 class="bordered" style="border: 1px solid black">FIRST TERM</h3> --}}
                        <h3 class="bordered text-center" style="border: 1px solid black">{{ strtoupper(optional($termResults->first()->term)->name) ?? 'No Term Name' }}</h3>
                        <tr>
                            <th>SUBJECTS</th>
                            <th>1st Term C/A(40)</th>
                            <th>1st Term Exam (60)</th>
                            <th>% Marks obtain</th>
                            <th>Grade</th>
                        </tr>


                    </thead>
                    <tbody>

                        {{-- @forelse($groupedResults as $termId => $termResults) --}}
                        {{-- <h4>{{ $termResults->first()->term->name ?? 'Term' }} Result</h4> --}}


                        {{-- @foreach($results as $result) --}}
                        @foreach($termResults as $result)
                        <tr>
                            <td>{{ $result->subject->name ?? '-' }}</td>
                            <td>{{ $result->test_score }}</td>
                            <td>{{ $result->exam_score }}</td>
                            <td><strong>{{ $result->total }}</strong></td>
                            <td>
                               {{ $result->grade }}

                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
            {{-- Second Table start here --}}

            <div class="col-6">
                @elseif ($termResults->first()->term->name === 'Second Term')
                <table class="table table-bordered">
                    <thead class="table-dark">
                        {{-- <h3 class="bordered" style="border: 1px solid black">SECOND TERM</h3> --}}
                        <h3 class="bordered text-center" style="border: 1px solid black">{{ strtoupper(optional($termResults->first()->term)->name) ?? 'No Term Name' }}</h3>


                        <tr>
                            <th>SUBJECTS</th>
                            <th>2nd Term C/A(40)</th>
                            <th>2nd Term Exam (60)</th>
                            <th>% Marks obtain</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($results as $result) --}}
                        @foreach($termResults as $result)
                        <tr>
                            <td>{{ $result->subject->name ?? '-' }}</td>
                            <td>{{ $result->test_score }}</td>
                            <td>{{ $result->exam_score }}</td>
                            <td><strong>{{ $result->total }}</strong></td>
                            <td>
                               {{ $result->grade }}

                            </td>
                        </tr>
                        @endforeach

                        {{-- @endforeach --}}
                    </tbody>

                </table>
            </div>
            @else
            <tr>
                            <td colspan="5" class="text-danger text-center">
                                No results found
                            </td>
                        </tr>
            @endif
            @empty
            <tr>
                            <td colspan="5" class="text-danger text-center">
                                No results found
                            </td>
                        </tr>
        </div>
        @endforelse
    </section>
    {{-- Third Term result section --}}
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row">
            <div class="col-12">
                @forelse($groupedResults as $termId => $termResults)
                @if ($termResults->first()->term->name === 'Third Term')
                    <table class="table table-bordered">
                    <thead class="table-dark">

                        {{--<h3 class="bordered" style="border: 1px solid black">---THIRD TERM</h3>--}}
                        <h3 class="bordered text-center" style="border: 1px solid black">{{ strtoupper(optional($termResults->first()->term)->name) ?? 'No Term Name' }}</h3>

                        <tr>
                            <th>SUBJECTS</th>
                            <th>1st Term C/A(40)</th>
                            <th>1st Term Exam (60)</th>
                            <th>% Marks obtain</th>
                            <th>Grade</th>

                            <th>2nd Term C/A(40)</th>
                            <th>2nd Term Exam (60)</th>
                            <th>% Marks obtain</th>
                            <th>Grade</th>

                            <th>3rd Term C/A(40)</th>
                            <th>3rd Term Exam (60)</th>
                            <th>% Marks obtain</th>
                            <th>Total Score</th>
                            <th>Ave. Score</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php
                            $totalScore = 0;
                        @endphp --}}

                        {{--<h4>--=={{ $termResults->first()->term->name ?? 'Term' }}</h4>--}}
                    {{-- @forelse($results as $subject_id => $records) --}}
                @php
                    $first = $termResults->where('term.name', 'First Term')->first();
                    $second = $termResults->where('term.name', 'Second Term')->first();
                    $third = $termResults->where('term.name', 'Third Term')->first();

                    $alltotal =
                        ($first->total ?? 0) +
                        ($second->total ?? 0) +
                        ($third->total ?? 0);

                    $average = $alltotal / 3;
                @endphp

                        {{-- @forelse($results as $result) --}}
                        @foreach($termResults as $result)

                        <tr>


                            <td>{{ $termResults->first()->subject->name ?? '-' }}</td>
                            <td>{{ $result->test_score ?? '-' }}</td>
                            <td>{{ $first->exam_score ?? '-' }}</td>
                            <td>{{ $first->total ?? '-' }}</td>
                            <td>{{ $first->grade ?? 'NI' }}</td>

                            <td>{{ $second->test_score ?? '-' }}</td>
                            <td>{{ $second->exam_score ?? '-' }}</td>
                            <td>{{ $second->total ?? '-' }}</td>
                            <td>{{ $second->grade ?? 'NI' }}</td>

                            <td>{{ $third->test_score ?? '-' }}</td>
                            <td>{{ $third->exam_score ?? '-' }}</td>
                            <td>{{ $third->total ?? '-' }}</td>
                            <td>{{ $alltotal ?? '-' }}</td>
                            {{-- <td>{{ $third->grade ?? '-' }}</td> --}}

                            {{-- <td>{{ $total }}</td> --}}
                            {{-- <td>{{ $alltotal }}</td> --}}
                            <td>{{ number_format($average, 2) }}</td>
                            <td>{{ $third->grade ?? 'NI' }}</td>



                            {{-- <td>{{ $result->test_score }}</td>
                            <td>{{ $result->exam_score }}</td>
                            <td><strong>{{ $result->total }}</strong></td>
                            <td>
                               {{ $result->grade }}

                            </td> --}}
                        </tr>
                        @endforeach




                    {{-- @endforelse --}}
                    </tbody>
                </table>
                @endif
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-danger">
                            No results found
                        </td>
                    </tr>
                @endforelse
            </div>
        </div>
        </div>
    </section>
    {{-- AFFECTIVE & PSYCHOMOTOR GRADE KEY/ GRADING SYSTEM --}}
    <section>

        {{-- AFFECTIVE & PSYCHOMOTOR --}}
        <table>
            <thead>
                <tr>
                    <th>Affective</th>
                    <th>Psychomotor</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{{ $result->affective }}</td>
                    <td>{{ $result->psychomotor }}</td>
                </tr>
            </tbody>
        </table>

        {{-- TEACHER COMMENT --}}
        <table>
            <tr>
                <td><strong>Class Teacher Comment:</strong></td>
            </tr>
            <tr>
                <td>{{ $result->teacher_comment }}</td>
            </tr>
        </table>

        <br><br>

        {{-- SIGNATURE --}}
        <table class="no-border">
            <tr>
                <td><strong>Class Teacher:</strong> ______________</td>
                <td><strong>Principal:</strong> __________________</td>
            </tr>
        </table>

    </section>
    {{-- Third Term result secti ends here --}}
{{-- Testing Original ends here --}}

</body>
</html>
{{-- Another new one ends --}}
