<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Teacher Dashboard - Laurisdan School')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            height: 100vh;
            width: 220px;
            background-color: #28a745;
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
        .sidebar a:hover { background-color: #218838; }
        .content { margin-left: 220px; padding: 20px; }
        .navbar { position: fixed; width: 100%; z-index: 1000; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('teacher.dashboard') }}">Laurisdan Teacher Panel</a>
    <div class="d-flex">
        <span class="text-white me-3">{{ Auth::user()->name ?? 'Teacher' }}</span>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-light btn-sm">Logout</button>
        </form>
    </div>
  </div>
</nav>

<div class="sidebar">
    <a href="{{ route('teacher.dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('teacher.students') }}">👩‍🎓 My Students</a>
    <a href="{{ route('teacher.classes') }}">🏫 My Classes</a>
    <a href="{{ route('teacher.exams') }}">🧠 Exams</a>
    <a href="{{ route('teacher.activities') }}">🎯 Activities</a>
    <a href="{{ route('teacher.results') }}">📊 Results</a>
    <a href="{{ route('teacher.books') }}">📚 Materials</a>
</div>

<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>