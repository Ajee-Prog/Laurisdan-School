@extends('layouts.app')

@section('content')

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
    {{-- New ends here --}}
    {{-- Student details Start here --}}
    {{-- New Result page design start here --}}
    <section class="mt-4 mx-2">
        <div class="row">
            <div class="col-9">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <h3 class="bordered" style="border: 1px solid black">FIRST TERM</h3>
                        <tr>
                            <th>NAMES</th>
                            <th>OKONKWO AMALACHUKWU</th>
                            <th>TERM</th>
                            <th>THIRD</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>CLASS</b></td>
                            <td>PRIMARY 4</td>
                            <td></td>
                            <td><b> TIME SCHOOL OPENED</b></td>
                            <td>110</td>
                        </tr>
                        <tr>
                            <td><b>DATE OF BIRTH</b></td>
                            <td>15TH MARCH 2011</td>
                            <td></td>
                            <td><b> TIME PRESENT</b></td>
                            <td>110</td>
                        </tr>
                        <tr>
                            <td><b>GENDER</b></td>
                            <td>FEMALE</td>
                            <td><b> WEIGHT</b></td>
                            <td>54KG</td>
                            <td>TIME ABSENT</td>
                        </tr>
                        <tr>
                            <td><b>SESSION</b></td>
                            <td>2024/2025</td>
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
                        <h3 class="bordered" style="border: 1px solid black">SECOND TERM</h3>
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
    {{-- New Result page design Ends here --}}
    {{-- Student details ends here --}}
<div class="container py-4 text-center" style="margin-top: 60px;">
    {{-- New Result page design start here --}}
    <section class="mt-4">
        <div class="row">
            <div class="col-6">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <h3 class="bordered" style="border: 1px solid black">FIRST TERM</h3>
                        <tr>
                            <th>SUBJECTS</th>
                            <th>1st Term C/A(40)</th>
                            <th>1st Term Exam (60)</th>
                            <th>% Marks obtain</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                </table>
            </div>
            {{-- Second Table start here --}}
            <div class="col-4">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <h3 class="bordered" style="border: 1px solid black">SECOND TERM</h3>
                        <tr>
                            <th>SUBJECTS</th>
                            <th>1st Term C/A(40)</th>
                            <th>1st Term Exam (60)</th>
                            <th>% Marks obtain</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($subjects as $key => $subject) --}}

                        <tr>
                            <td>subject</td>
                            <td>ca_score</td>
                            <td>exam_score</td>
                            <td>score</td>
                            <td>
                                Grading

                            </td>
                        </tr>
                        <tr>
                            <td>Computer</td>
                            <td>40</td>
                            <td>50</td>
                            <td>90</td>
                            <td>
                                A

                            </td>
                        </tr>
                        <tr>
                            <td>Maths</td>
                            <td>40</td>
                            <td>50</td>
                            <td>90</td>
                            <td>
                                A

                            </td>
                        </tr>
                        <tr>
                            <td>Maths</td>
                            <td>40</td>
                            <td>49</td>
                            <td>89</td>
                            <td>
                                B

                            </td>
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
    {{-- New Result page design Ends here --}}
    {{-- ================= PROFILE SUMMARY ================= --}}

  <h2>Exam Result</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- ************* --}}
    <h2>Exam Completed</h2>
    <p><strong>{{ $exam->title ?? 'N/A'}}</strong></p>
    {{-- <h3>Your Score: {{ $score }} / {{ $total ?? 'N/A'}}</h3> --}}
    <h3>Your Score: {{ $results }} / {{ $total ?? 'N/A'}}</h3>

    <a href="{{ route('dashboard') }}" class="btn btn-success">
        Back to Dashboard
    </a>
  {{-- ******************* --}}

  <p class="mt-3">
    {{-- You scored <strong>{{ $score }}</strong> out of --}}
    You scored <strong>{{ $results }}</strong> out of
    <strong>{{ $total }}</strong>.</p>

  {{-- @if($score >= ($total/2))
    <div class="alert alert-success mt-3">Congratulations! You passed 🎉</div>
  @else
    <div class="alert alert-danger mt-3">You did not pass. Try again!</div>
  @endif --}}

  <a href="{{ route('student.exams') }}" class="btn btn-primary mt-3">Retake Exam</a>
</div>

<!-- Filter Result -->
 <form method="GET" action="{{ route('student.results') }}" class="row mb-3">
  <div class="col-md-3">
    <select name="session_id" class="form-control">
      <option value="">-- All Sessions --</option>
      @foreach($sessions as $s)
        <option value="{{ $s->id }}" {{ request('session_id') == $s->id ? 'selected' : '' }}>
          {{ $s->name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <select name="term_id" class="form-control">
      <option value="">-- All Terms --</option>
      @foreach($terms as $t)
        <option value="{{ $t->id }}" {{ request('term_id') == $t->id ? 'selected' : '' }}>
          {{ $t->name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <select name="subject_id" class="form-control">
      <option value="">-- All Subjects --</option>
      @foreach($subjects as $sub)
        <option value="{{ $sub->id }}" {{ request('subject_id') == $sub->id ? 'selected' : '' }}>
          {{ $sub->name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <button type="submit" class="btn btn-primary">Filter</button>
    {{-- <a href="{{ route('student.results.pdf', request()->all()) }}" class="btn btn-danger">Download PDF</a> --}}
</div>
</form>

{{-- Or This New Result table --}}
<form method="GET">
    <select name="term_id">
        <option value="">All Terms</option>
    </select>

    <select name="session_id">
        <option value="">All Sessions</option>
    </select>

    <button class="btn btn-info">Filter</button>
</form>

<table class="table">
    <tr>
        <th>Subject</th>
        <th>Test</th>
        <th>Exam</th>
        <th>Total</th>
        <th>%</th>
        <th>Grade</th>
    </tr>

    {{-- @foreach($results as $r)
    <tr>
        <td>{{ $r->exam->subject }}</td>
        <td>{{ $r->test_score }}</td>
        <td>{{ $r->exam_score }}</td>
        <td>{{ $r->total_score }}</td>
        <td>{{ $r->percentage }}%</td>
        <td>{{ $r->grade }}</td>
    </tr>
    @endforeach --}}
</table>

{{-- New correct but testing for latest design start here --}}
<table class="table table-bordered">
<thead>
<tr>
    <th>Subject</th>
    <th>Test</th>
    <th>Exam</th>
    <th>Total</th>
    <th>%</th>
    <th>Grade</th>
</tr>
</thead>

<tbody>
@foreach($results as $result)
<tr>
    <td>{{ $result->exam->subject->name ?? '' }}</td>
    <td>{{ $result->test_score }}</td>
    <td>{{ $result->exam_score }}</td>
    <td>{{ $result->total_score }}</td>
    <td>{{ $result->percentage }}%</td>
    <td>{{ $result->grade }}</td>
</tr>
@endforeach
</tbody>
</table>
{{-- New correct but testing for latest design ends here --}}

<!-- Just Testing Tbe table flow example-->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Subject</th>
            <th>Session</th>
            <th>Term</th>
            <th>Test Score</th>
            <th>Exam Score</th>
            <th>Total</th>
            <th>Grade</th>
            <th>Psychomotor</th>
            <th>Teacher Comment</th>
        </tr>
    </thead>

    <tbody>
        @forelse($results as $res)
        <tr>
            <td>{{ $res->subject->name ?? '-' }}</td>
            <td>{{ $res->session->name ?? '-' }}</td>
            <td>{{ $res->term->name ?? '-' }}</td>
            <td>{{ $res->test_score }}</td>
            <td>{{ $res->exam_score }}</td>
            <td><strong>{{ $res->total }}</strong></td>
            <td>{{ $res->grade }}</td>
            <td>{{ $res->psychomotor }}</td>
            <td>{{ $res->teacher_comment }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="9" class="text-center text-danger">
                No results found
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Just Testing Ends here-->

@endsection
