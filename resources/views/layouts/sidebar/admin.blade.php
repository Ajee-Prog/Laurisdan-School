<ul class="nav flex-column">
  <li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link text-white">Dashboard</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('students.index') }}" class="nav-link text-white">Students</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('teachers.index') }}" class="nav-link text-white">Teachers</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('parents.index') }}" class="nav-link text-white">Parents</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('classes.index') }}" class="nav-link text-white">Classes</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('books.index') }}" class="nav-link text-white">Books</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('exams.index') }}" class="nav-link text-white">Exams</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('subjects.index') }}" class="nav-link text-white">Subjects</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('activities.index') }}" class="nav-link text-white">Activities</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('sessions.index') }}" class="nav-link text-white">Sessions</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('terms.index') }}" class="nav-link text-white">Terms</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('fees.index') }}" class="nav-link text-white">Manage Fees</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('fees.create') }}">Record Payment</a>
  </li>
  <!-- <li class="nav-item">
    <a href="{{ route('fee.receipt') }}" class="nav-link text-white">Generate Receipt</a>
  </li> -->
  
  
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
</ul>








