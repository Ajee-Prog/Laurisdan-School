<!DOCTYPE html>
<html>
<head>
    <title>Student Result</title>

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

<div class="container">

<button onclick="window.print()" class="print-btn">Print</button>

<h2>LAURISDAN NURSERY & PRIMARY SCHOOL</h2>
<h4>STUDENT REPORT SHEET</h4>

{{-- STUDENT DETAILS --}}
<table class="no-border">
    <tr>
        <td><strong>Name:</strong> {{ $student->name }}</td>
        <td><strong>Class:</strong> {{ $student->class->name }}</td>
    </tr>

    <tr>
        <td><strong>Date of Birth:</strong> {{ $student->dob }}</td>
        <td><strong>Gender:</strong> {{ $student->gender }}</td>
    </tr>

    <tr>
        <td><strong>Session:</strong> {{ $session->name }}</td>
        <td><strong>Term:</strong> {{ $term->name }}</td>
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
        @foreach($subjects as $key => $subject)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $subject->name }}</td>
            <td>{{ $subject->score }}</td>
            <td>
                @if($subject->score >= 70) A
                @elseif($subject->score >= 60) B
                @elseif($subject->score >= 50) C
                @elseif($subject->score >= 45) D
                @elseif($subject->score >= 40) E
                @else F
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- SUMMARY --}}
<table>
    <tr>
        <td><strong>Total Score:</strong> {{ $total_score }}</td>
        <td><strong>Percentage:</strong> {{ $percentage }}%</td>
    </tr>

    <tr>
        <td><strong>Marks Obtained:</strong> {{ $marks_obtained }}</td>
        <td><strong>Grade:</strong> {{ $grade }}</td>
    </tr>

    <tr>
        <td><strong>Overall Grade:</strong> {{ $overall_grade }}</td>
        <td><strong>Time Present:</strong> {{ $time_present }}</td>
    </tr>

    <tr>
        <td><strong>Time Absent:</strong> {{ $time_absent }}</td>
        <td></td>
    </tr>
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
            <td>{{ $affective }}</td>
            <td>{{ $psychomotor }}</td>
        </tr>
    </tbody>
</table>

{{-- TEACHER COMMENT --}}
<table>
    <tr>
        <td><strong>Class Teacher Comment:</strong></td>
    </tr>
    <tr>
        <td>{{ $teacher_comment }}</td>
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
