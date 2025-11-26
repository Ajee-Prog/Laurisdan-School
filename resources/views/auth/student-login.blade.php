<!DOCTYPE html>
<html>
<head>
    <title>Student Login - Laurisdan School</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
    @extends('layouts.app')
    @section('title', 'Student Login')
    @section('content')
<div class="container mt-5">
    <div class="card col-md-6 offset-md-3" style="margin-top: 62px;">
        <div class="card-header bg-success text-white text-center">
            <h4>Student Login</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('student.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label>Student Code</label>
                    <input name="student_code" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" required>
                </div>
                <button class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html> -->