@extends('layouts.app')
@section('content')
<div class="container">
    <h3>My Fee Payments</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Receipt</th>
                <th>Session</th>
                <th>Term</th>
                <th>Amount</th>
                <th>Paid</th>
                <th>Balance</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fees as $f)
            <tr>
                <td>#{{ $f->id }}</td>
                <td>{{ $f->session }}</td>
                <td>{{ $f->term }}</td>
                <td>₦{{ number_format($f->amount) }}</td>
                <td>₦{{ number_format($f->amount_paid) }}</td>
                <td>₦{{ number_format($f->balance) }}</td>
                <td>{{ \Carbon\Carbon::parse($f->payment_date)->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('fee.receipt', $f->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('fee.receipt.pdf', $f->id) }}" class="btn btn-sm btn-danger">PDF</a>
                </td>
            </tr>
            @endforeach
            @if($fees->isEmpty())
            <tr><td colspan="8">No payments yet.</td></tr>
            @endif
        </tbody>
    </table>
</div>
@endsection