@php
    $admin   = Auth::guard('web')->user();
    $student = Auth::guard('student')->user();
@endphp
<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laurisdan School') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ ucfirst(Auth::user()->role) }} Dashboard - Laurisdan School</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      width: 250px;
      height: 100vh;
      position: fixed;
      top: 0; left: 0;
      background-color: #343a40;
      padding-top: 20px;
    }
    .sidebar a {
      color: #fff;
      display: block;
      padding: 10px 20px;
      text-decoration: none;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #495057;
    }
    .content {
      margin-left: 260px;
      padding: 20px;
    }
    .topbar {
      background-color: #fff;
      padding: 10px 20px;
      border-bottom: 1px solid #dee2e6;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h4 class="text-center text-light mb-4">
      
    {{-- @if($p->image)
                        <img src="{{ asset('storage/'.$p->image) }}" width="60" height="60" style="border-radius:50%;">
                    @else
                        <span>No Image</span>
                    @endif --}}
                    

      @if($admin) 
      {{ ucfirst($admin->role) }} 
      @elseif($student) <img src="{{ asset('storage/'.$student->image) }}" width="60" height="60" style="border-radius:50%;">
      {{ ucfirst($student->middle_name) }} 
      @endif Panel
      
    </h4>


    @if($admin == 'admin')
      <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
      <a href="{{ route('students.index') }}">Students</a>
      <a href="{{ route('teachers.index') }}">Teachers</a>
      <a href="{{ route('parents.index') }}">Parents</a>
      <a href="{{ route('classes.index') }}">Classes</a>
      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    @elseif($admin == 'teacher')
      <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
      <a href="#">My Classes</a>
      <a href="#">Exams</a>
      <a href="#">Students</a>
      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    @elseif($student)
      <a href="{{ route('dashboard') }}" class="active">Dashboard</a>

      <a href="{{ route('profile.show') }}">👤 My Profile</a>
    <a href="{{ route('student.exams') }}">🧠 Take Exam (CBT)</a>
    <a href="{{ route('student.results') }}">📊 My Results</a>
    <a href="{{ route('student.books') }}">📚 Study Materials</a>
    <a href="#">🎯 Activities</a>
    <a href="#">🔔 Notifications</a>
      
      <a href="{{ route('student.exams') }}">My Exams</a>
      <a href="{{ route('student.books') }}">Books</a>
      <a href="#">My Subjects</a>
      <a href="#">Results</a>
      <a href="#">Assignments</a>
      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
      <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    @elseif($admin == 'parent')
      <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
      <a href="#">My Children</a>
      <a href="#">Reports</a>
      <a href="#">Payments</a>
      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    @endif
  </div>

  <!-- Main Content -->

  <div class="content">
    <div class="topbar">
      @if($admin)
        <h5>Welcome, {{ $admin->name }}</h5>
        <span class="badge bg-primary text-capitalize">{{ $admin->role }}</span>
      @elseif($student)
        <h5>Welcome {{ $student->first_name }}</h5>
        <span class="badge bg-primary text-capitalize">{{ $student->admission_no }}</span>
      @endif
    </div>

    <div class="mt-4">
      @yield('content')
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>