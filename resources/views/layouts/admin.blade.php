<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laurisdan Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #343a40;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 60px;
            color: #fff;
            overflow: auto;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #ccc;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .navbar {
            position: fixed;
            width: 100%;
            z-index: 1000;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Laurisdan School Admin</a>
    <div class="d-flex">
        <span class="text-white me-3">{{ Auth::user()->name ?? 'Admin' }}</span>
        <form action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <button class="btn btn-outline-light btn-sm">Logout</button>
        </form>
    </div>
  </div>
</nav>

<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('students.index') }}">🎓 Students</a>
    <a href="{{ route('teachers.index') }}">👩‍🏫 Teachers</a>
    <a href="{{ route('parents.index') }}">👨‍👩‍👧 Parents</a>
    <a href="{{ route('classes.index') }}">🏫 Classes</a>
    <a href="{{ route('exams.index') }}">🧠 Exams</a>
    <a href="{{ route('activities.index') }}">🎯 Activities</a>
    <a href="{{ route('books.index') }}">📚 Books</a>
    <a href="{{ route('terms.index') }}">📆 Terms</a>
    <a href="{{ route('sessions.index') }}">🗓 Sessions</a>
    <a href="{{ route('exams.index') }}">💻 CBT</a>
    <li class="nav-item">
    <a href="{{ route('fees.index') }}" class="nav-link text-white">Manage Fees</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('fees.create') }}">Record Payment</a>
  </li>

  <li class="nav-item">
    <!-- <a href="{{ route('logout') }}" class="nav-link text-danger">Logout</a> -->
     <hr>
    <a href="#" class="text-danger d-block px-3 py-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        🚪 Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
  </li>

</div>

<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>