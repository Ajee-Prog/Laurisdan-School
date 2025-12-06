<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt #{{ $fee->id }}</title>
    <style>
        body{ font-family: DejaVu Sans, Arial, sans-serif; font-size:14px; color:#222 }
        .header{ text-align:center; margin-bottom:10px }
        .logo{ width:80px; height:auto; }
        .meta{ margin-top:12px; }
        table { width:100%; border-collapse: collapse; margin-top:15px;}
        th, td { border: 1px solid #ddd; padding: 8px; text-align:left; }
        .right{ text-align:right }
        .small { font-size:12px; color:#666 }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/school-logo.png') }}" class="logo" alt="logo">
        <h2>Laurisdan Nursery & Primary School</h2>
        <div class="small">School Address Line • Phone: 0800-XXX-XXXX • Email: info@example.com</div>
    </div>

    <h3 style="margin-top:5px">FEE RECEIPT</h3>

    <div class="meta">
        <strong>Receipt No:</strong> {{ $fee->id }} <br>
        <strong>Date:</strong> {{ \Carbon\Carbon::parse($fee->payment_date)->format('d M Y') }} <br>
        <strong>Student:</strong> {{ $fee->student->name }} <br>
        <strong>Class:</strong> {{ $fee->class }} <br>
        <strong>Session / Term:</strong> {{ $fee->session }} / {{ $fee->term }}
    </div>

    <table>
        <tr>
            <th>Description</th>
            <th class="right">Amount</th>
        </tr>
        <tr>
            <td>Total Fee</td>
            <td class="right">₦{{ number_format($fee->amount) }}</td>
        </tr>
        <tr>
            <td>Amount Paid</td>
            <td class="right">₦{{ number_format($fee->amount_paid) }}</td>
        </tr>
        <tr>
            <td>Balance</td>
            <td class="right">₦{{ number_format($fee->balance) }}</td>
        </tr>
        <tr>
            <td>Payment Method</td>
            <td class="right">{{ $fee->payment_method }}</td>
        </tr>
    </table>

    <p class="small">This is a computer generated receipt and does not require a signature.</p>
</body>
</html>