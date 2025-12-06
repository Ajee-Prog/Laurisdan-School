@extends('layouts.admin')

@section('content')
<div class="container">

    <h3>Record Fee Payment</h3>

    <form action="{{ route('fees.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control" required>
                @foreach($students as $s)
                <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->class }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Session</label>
            <input type="text" name="session" class="form-control" placeholder="2024/2025" required>
        </div>

        <div class="mb-3">
            <label>Term</label>
            <select name="term" class="form-control" required>
                <option>First Term</option>
                <option>Second Term</option>
                <option>Third Term</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Class</label>
            <input type="text" name="class" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Total Amount</label>
            <input type="number" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Amount Paid</label>
            <input type="number" name="amount_paid" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Payment Method</label>
            <select name="payment_method" class="form-control">
                <option>Cash</option>
                <option>Bank Transfer</option>
                <option>POS</option>
            </select>
        </div>

        <button class="btn btn-success">Save Payment</button>
    </form>
</div>
@endsection