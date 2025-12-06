<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        .box { border: 1px solid #222; padding:20px; }
    </style>
</head>
<body>

<div class="box">
    <h2>Laurisdan Nursery & Primary School</h2>
    <h4>School Fee Receipt</h4>

    <p><strong>Student:</strong> {{ $fee->student->name }}</p>
    <p><strong>Term:</strong> {{ $fee->term }}</p>
    <p><strong>Session:</strong> {{ $fee->session }}</p>
    <p><strong>Amount Paid:</strong> ₦{{ number_format($fee->amount) }}</p>

    <hr>
    <p>Generated on: {{ date('d M, Y') }}</p>
</div>



<table class="table table-bordered">
    <tr>
        <th>Term</th><th>Session</th><th>Amount</th><th>Receipt</th>
    </tr>

    @foreach($fees as $f)
    <tr>
        <td>{{ $f->term }}</td>
        <td>{{ $f->session }}</td>
        <td>₦{{ number_format($f->amount) }}</td>
        <td><a href="{{ route('fee.receipt', $f->id) }}" class="btn btn-sm btn-primary">Download</a></td>
    </tr>
    @endforeach
</table>

</body>
</html>