<ul class="nav flex-column">
  <li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link text-white">Dashboard</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('books.index') }}" class="nav-link text-white">Books</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('exams.index') }}" class="nav-link text-white">Exams</a>
  </li>
  <li class="nav-item">
    <a href="{{ route('activities.index') }}" class="nav-link text-white">Activities</a>
  </li>
  <li class="nav-item">
    <!-- <a href="{{ route('logout') }}" class="nav-link text-danger">Logout</a> -->
    <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
    
  </li>
</ul>