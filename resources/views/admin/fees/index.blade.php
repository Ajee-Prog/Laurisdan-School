@extends('layouts.admin')

@section('content')
<div class="container">

    <h3>Fee Payments</h3>
    <a href="{{ route('fees.create') }}" class="btn btn-primary mb-3">Add Payment</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Session</th>
                <th>Term</th>
                <th>Class</th>
                <th>Amount</th>
                <th>Paid</th>
                <th>Balance</th>
                <th>Receipt</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fees as $fee)
            <tr>
                <td>{{ $fee->student->name }}</td>
                <td>{{ $fee->session }}</td>
                <td>{{ $fee->term }}</td>
                <td>{{ $fee->class }}</td>
                <td>₦{{ number_format($fee->amount) }}</td>
                <td>₦{{ number_format($fee->amount_paid) }}</td>
                <td>₦{{ number_format($fee->balance) }}</td>
                <td>
                    <a href="{{ route('fee.receipt', $fee->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('fee.receipt.pdf', $fee->id) }}" class="btn btn-danger btn-sm">PDF</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $fees->links() }}
</div>
@endsection