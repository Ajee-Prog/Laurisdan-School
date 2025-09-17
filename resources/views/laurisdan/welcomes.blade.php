<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>School Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">🏫 My School</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
        <li class="nav-item"><a href="#services" class="nav-link">Services</a></li>
        <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
        <li class="nav-item"><a href="{{ route('login') }}" class="btn btn-light ms-2">Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero -->
 <section class="bg-light text-center p-5">
  <h1>Welcome to My School</h1>
  <p>Learning Today, Leading Tomorrow</p>
  <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Enroll Now</a>
</section>

<!-- About -->
<section id="about" class="p-5">
  <div class="container">
    <h2>About Us</h2>
    <p>We are dedicated to providing quality education for Primary 1 to 6 students.</p>
  </div>
</section>

<!-- Services -->
<section id="services" class="p-5 bg-light">
  <div class="container">
    <h2>Our Services</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="card p-3">
          <h4>Modern Classes</h4>
          <p>Interactive and engaging classrooms.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3">
          <h4>Books & Exams</h4>
          <p>Digital books and computer-based exams.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3">
          <h4>Activities</h4>
          <p>Sports, arts, and other fun programs.</p>
            </div>
      </div>
    </div>
  </div>
</section>

<!-- Contact -->
<section id="contact" class="p-5">
  <div class="container">
    <h2>Contact Us</h2>
    <p>Email: info@lisschool.com | Phone: ‪+234-8141132252‬</p>
  </div>
</section>

<!-- Footer -->
<footer class="bg-primary text-white text-center p-3">
  © {{ date('Y') }} My School. All Rights Reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
