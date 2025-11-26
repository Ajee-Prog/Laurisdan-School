<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/">🏫 School Portal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item"><a href="/dashboard" class="nav-link">Dashboard</a></li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">@csrf
              <button class="btn btn-danger btn-sm">Logout</button>
            </form>
          </li>
        @else
          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
          <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
        @endauth
      </ul>
    </div>
</div>
</nav>