<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laurisdan School') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: #fff;
            flex-shrink: 0;
        }
        .sidebar a {
            color: #adb5bd;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #495057;
            color: #fff;
        }
        .sidebar .active {
            background: #007bff;
            color: #fff;
        }
        .content {
            flex: 1;
            padding: 20px;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="p-3">Laurisdan</h4>

        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Admin Dashboard</a>
                <a href="{{ route('students.index') }}">Students</a>
                <a href="{{ route('teachers.index') }}">Teachers</a>
                <a href="{{ route('exams.index') }}">Exams</a>
                <a href="{{ route('books.index') }}">Books</a>
                <a href="{{ route('activities.index') }}">Activities</a>
            @elseif(Auth::user()->role === 'teacher')
                <a href="{{ route('teacher.dashboard') }}">Teacher Dashboard</a>
                <a href="{{ route('teacher.classes') }}">My Classes</a>
                <a href="{{ route('teacher.exams') }}">Exams</a>
                <a href="{{ route('teacher.activities') }}">Activities</a>
            @elseif(Auth::user()->role === 'student')
                <a href="{{ route('student.dashboard') }}">Student Dashboard</a>
                <a href="{{ route('student.exams') }}">My Exams</a>
                <a href="{{ route('student.books') }}">Books</a>
            @elseif(Auth::user()->role === 'parent')
                <a href="{{ route('parent.dashboard') }}">Parent Dashboard</a>
                <a href="{{ route('parent.children') }}">My Children</a>
                <a href="{{ route('parent.results') }}">Exam Results</a>
                <a href="{{ route('parent.activities') }}">Activities</a>
            @endif

            <a href="{{ route('profile.show') }}">Profile</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endauth
    </div>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>