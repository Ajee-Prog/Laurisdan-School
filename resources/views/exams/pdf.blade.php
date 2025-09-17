<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Exams</title>
        <style>
            body{font-family:DejaVu Sans, sans-serif}
            table{width:100%;border-collapse:collapse}
            th,td{border:1px solid #ddd;padding:6px}
        </style>
    </head>
<body>
<h2>Exams</h2>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Class</th>
            <th>Term</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($exams as $i=>$e)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $e->title }}</td>
                <td>{{ $e->class->name ?? '-' }}</td>
                <td>{{ $e->term->name ?? '-' }}</td>
                <td>{{ $e->exam_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>