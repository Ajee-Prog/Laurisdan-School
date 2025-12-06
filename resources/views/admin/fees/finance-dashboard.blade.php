@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Finance Dashboard</h3>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Collected</h5>
                <h3>₦{{ number_format($totalCollected) }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Outstanding</h5>
                <h3>₦{{ number_format($totalOutstanding) }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Expected (Total Fees)</h5>
                <h3>₦{{ number_format($totalExpected) }}</h3>
            </div>
        </div>
    </div>

    <h5>By Term</h5>
    <table class="table">
        <thead><tr><th>Term</th><th>Collected</th><th>Outstanding</th></tr></thead>
        <tbody>
            @foreach($byTerm as $t)
            <tr>
                <td>{{ $t->term }}</td>
                <td>₦{{ number_format($t->collected) }}</td>
                <td>₦{{ number_format($t->outstanding) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    <h5>Import Bank CSV (bulk payments)</h5>
    <form action="{{ route('fees.import.csv') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group">
            <input type="file" name="csv_file" accept=".csv" class="form-control" required>
            <button class="btn btn-primary">Import CSV</button>
        </div>
    </form>

    <p class="mt-2 small">CSV columns: <code>student_email,student_name,session,term,class,amount,amount_paid,payment_date,payment_method</code></p>
</div>
@endsection