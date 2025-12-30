@php
    $admin   = Auth::guard('web')->user();
    $student = Auth::guard('student')->user();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>School Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  @include('partials.navbar')

  @if(auth()->user()->role == 'superadmin')
  <li><a href="{{ route('superadmin.dashboard') }}" class="nav-link">Dashboard</a></li>
  <li><a href="{{ route('admins.index') }}" class="nav-link">Admins</a></li>
  <li><a href="{{ route('teachers.index') }}" class="nav-link">Teachers</a></li>
  <li><a href="{{ route('students.index') }}" class="nav-link">Students</a></li>
  <li><a href="{{ route('parents.index') }}" class="nav-link">Parents</a></li>
  <li><a href="{{ route('classes.index') }}" class="nav-link">Classes</a></li>
  <li><a href="{{ route('subjects.index') }}" class="nav-link">Subjects</a></li>
  <li><a href="{{ route('exams.index') }}" class="nav-link">Exams</a></li>
  <li><a href="{{ route('fees.index') }}" class="nav-link">School Fees</a></li>
  @endif

  <main class="py-4">
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
