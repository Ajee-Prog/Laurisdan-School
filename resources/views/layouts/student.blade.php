<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laurisdan Student Dashboard')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            width: 220px;
            background-color: #007bff;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 70px;
            color: white;
        }
        .sidebar a {
            display: block;
            color: #fff;
            padding: 12px 18px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #0056b3;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
        .navbar {
            position: fixed;
            width: 100%;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('student.dashboard') }}">Laurisdan Student Portal</a>
    <div class="d-flex">
        <span class="text-white me-3">{{ Auth::user()->name ?? 'Student' }}</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-light btn-sm">Logout</button>
        </form>
    </div>
  </div>
</nav>

<div class="sidebar">
    <a href="{{ route('student.dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('student.profile') }}">👤 My Profile</a>
    <a href="{{ route('student.cbt.index') }}">🧠 Take Exam (CBT)</a>
    <a href="{{ route('student.results') }}">📊 My Results</a>
    <a href="{{ route('student.books') }}">📚 Study Materials</a>
    <a href="{{ route('student.activities') }}">🎯 Activities</a>
    <a href="{{ route('student.notifications') }}">🔔 Notifications</a>
</div>

<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>