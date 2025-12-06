@extends('layouts.admin')

@section('content')
<div class="container">

    <h3 class="text-center">SCHOOL FEE RECEIPT</h3>
    <hr>

    <strong>Student:</strong> {{ $fee->student->name }} <br>
    <strong>Class:</strong> {{ $fee->class }} <br>
    <strong>Session:</strong> {{ $fee->session }} <br>
    <strong>Term:</strong> {{ $fee->term }} <br><br>

    <table class="table table-bordered">
        <tr>
            <th>Total Amount</th>
            <td>₦{{ number_format($fee->amount) }}</td>
        </tr>
        <tr>
            <th>Amount Paid</th>
            <td>₦{{ number_format($fee->amount_paid) }}</td>
        </tr>
        <tr>
            <th>Balance</th>
            <td>₦{{ number_format($fee->balance) }}</td>
        </tr>
        <tr>
            <th>Payment Method</th>
            <td>{{ $fee->payment_method }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $fee->payment_date }}</td>
        </tr>
    </table>

    <a href="{{ route('fee.receipt.pdf', $fee->id) }}" class="btn btn-danger">Download PDF</a>

</div>
@endsection