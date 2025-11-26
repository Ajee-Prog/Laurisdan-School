<!DOCTYPE html>
<html>
<head>
    <title>Parent Login - Laurisdan School</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card col-md-6 offset-md-3">
        <div class="card-header bg-info text-white text-center">
            <h4>Parent Login</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('parent.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" required>
                </div>
                <button class="btn btn-info w-100 text-white">Login</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>