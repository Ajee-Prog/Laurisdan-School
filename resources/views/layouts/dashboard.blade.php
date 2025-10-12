<!DOCTYPE html>
<html>
<head>
  <title>Dashboard - {{ ucfirst(Auth::user()->role) }}</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="d-flex">
  <!-- Sidebar -->
  <div class="bg-dark text-white p-3" style="width:220px;min-height:100vh;">
    <h4>{{ ucfirst(Auth::user()->role) }} Panel</h4>
    <hr>
    @include('layouts.sidebar.' . Auth::user()->role)
  </div>
  
  <!-- Main -->
  <div class="flex-grow-1 p-4">
    @yield('content')
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>