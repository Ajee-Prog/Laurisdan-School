<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laurisdan Nursery & Primary School</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" type="text/css">


    <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .navbar {
      background-color: #003366;
    }
    .navbar-brand, .nav-link {
      color: #fff !important;
      font-weight: 500;
    }
    .carousel-item {
      height: 90vh;
      min-height: 400px;
      background-size: cover;
      background-position: center;
    }
    .carousel-caption {
      background: rgba(0, 0, 0, 0.5);
      border-radius: 10px;
      padding: 20px;
    }
    .carousel-caption h1 {
      font-size: 3rem;
      font-weight: bold;
    }
    .section-title {
      font-weight: 700;
      color: #003366;
      margin-bottom: 20px;
    }
    .btn-custom {
      background-color: #f0ad4e;
      color: white;
      border-radius: 25px;
      padding: 10px 25px;
    }
    .btn-custom:hover {
      background-color: #ec971f;
    }
    .footer {
      background-color: #003366;
      color: white;
      padding: 40px 0;
    }
    h2 {
      color: navy;
    }
    .carousel-bg {
    height: 90vh;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-image: url( "/public/assets/images/laurisdan3.jpg" );
}
  </style>



    
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark  b-primary shadow-sm" style="background-color:navy; height:80px; color:white; text-transform:upper;">
    <div class="container">
      <a href="{{ route('home') }}" class="logo rounded">
                    <img src= "{{ asset('assets/images/laurisdanLogo1.jpg') }}" class="rounded mr-5"  alt="" width="50">
                </a>
      <a class="navbar-brand fw-bold mx-3" href="{{ route('home') }}">Laurisdan School</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="classesDropdown" role="button" data-bs-toggle="dropdown">Classes</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('classes.index') }}">All Classes</a></li>
              <li><a class="dropdown-item" href="{{ route('classes.show', 1) }}">Primary 1</a></li>
              <li><a class="dropdown-item" href="{{ route('classes.show', 2) }}">Primary 2</a></li>
              <li><a class="dropdown-item" href="{{ route('classes.show', 3) }}">Primary 3</a></li>
              <li><a class="dropdown-item" href="{{ route('classes.show', 4) }}">Primary 4</a></li>
              <li><a class="dropdown-item" href="{{ route('classes.show', 5) }}">Primary 5</a></li>
              <li><a class="dropdown-item" href="{{ route('classes.show', 6) }}">Primary 6</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">Books</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('activities.index') }}">Activities</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('teachers.index') }}">Teachers</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('parents.index') }}">Parents</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('students.index') }}">Students</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('exams.index') }}">Exams</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('sessions.index') }}">Sessions</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('terms.index') }}">Terms</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
          @guest
            <li class="nav-item"><a class="nav-link btn btn-light text-primary ms-2" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link btn btn-warning text-dark ms-2" href="{{ route('register') }}">Register</a></li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="bg-ligh py-5 text-center" style=" height:500px;color:#203082; background-color:#efefef;">
    <div class="container">
      <div class="row">
        <div class="col-sm-8">
          <h1 class="display-4 fw-bold text-rimary" style="color:#203082;">Welcome to Laurisdan Nursery & Primary School</h1>
          <p class="lead">Building a foundation for lifelong learning and excellence.</p>
          <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Enroll Now</a>
        </div>
        <div class="col-sm-4">
          <a href="{{ route('home') }}" class="logo rounded">
                    <img src= "{{ asset('assets/images/laurisdanLogo1.jpg') }}" class="rounded mr-5"  alt="" widt="50">
                </a>
        </div>
      </div>
    </div>
  </section>
  <!-- 2 copied -->
   <!-- Carousel new section start -->
  <section class="p5">
    



      <!-- HERO CAROUSEL -->
    <section id="home" class="mb-5">
      <div id="schoolCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

          <div class="carousel-item active" style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c');">
            <div class="carousel-caption">
              <h1>Welcome to Laurisdan School</h1>
              <p>Building Bright Futures Through Learning and Care.</p>
              <a href="#about" class="btn btn-custom mt-2">Discover More</a>
            </div>
          </div>

          <div class="carousel-item" style="background-image: url({{ asset('assets/images/laurisdan3.jpg') }});">
          <!-- <div class="carousel-item" > -->
            
            <div class="carousel-caption">
              <h1>Quality Education for Every Child</h1>
              <p>Empowering students with creativity, knowledge, and discipline.</p>
              <a href="#classes" class="btn btn-custom mt-2">Our Classes</a>
            </div>
          </div>

          <div class="carousel-item" style="background-image: url({{ asset('assets/images/laurisdan3.jpg') }});">
            <div class="carousel-caption">
              <h1>Inspiring Teachers, Amazing Students</h1>
              <p>Learn from the best in a supportive environment.</p>
              <a href="#teachers" class="btn btn-custom mt-2">Meet Teachers</a>
            </div>
          </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#schoolCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#schoolCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </section>

    <!-- Heuro Carousel end -->

    <!-- TEACHERS SECTION -->
    <section id="teachers" class="py-5">
      <div class="container text-center">
        <h2 class="section-title">Meet Our Teachers</h2>
        <div class="row g-4 mt-4">
          <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
              <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle mx-auto" width="100">
              <h5 class="mt-3">Mrs. Irriferigoma Johnson</h5>
              <p class="text-muted mb-0">Head Teacher</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
              <img src="https://randomuser.me/api/portraits/men/35.jpg" class="rounded-circle mx-auto" width="100">
              <h5 class="mt-3">Mr. Emmanuel Okoro</h5>
              <p class="text-muted mb-0">Mathematics</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
              <img src="https://randomuser.me/api/portraits/women/65.jpg" class="rounded-circle mx-auto" width="100">
              <h5 class="mt-3">Mrs. Kemi Oyebanjo</h5>
              <p class="text-muted mb-0">Science</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
              <img src="https://randomuser.me/api/portraits/men/50.jpg" class="rounded-circle mx-auto" width="100">
              <h5 class="mt-3">Mr. Yusuf Kareem</h5>
              <p class="text-muted mb-0">ICT Instructor</p>
            </div>
          </div>
        </div>
      </div>
    </section>
      <!-- Teachers 2nd ends -->


      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-4">
            <img class="rounded-circle mx-auto" src="{{ asset('assets/images/laurisdan5.jpg') }}" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="{{ asset('assets/images/laurisdan6.jpg') }}" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="{{ asset('assets/images/laurisdan7.jpg') }}" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="{{ asset('assets/images/laurisdan9.jpg') }}" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <img class="featurette-image img-fluid mx-auto" src="{{ asset('assets/images/laurisdan10.jpg') }}" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="{{ asset('assets/images/laurisdan8.jpg') }}" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

      </div><!-- /.container -->
  </section>
   <!-- Carousel new section ends -->
    <!-- CLASSES SECTION -->
  <section id="classes" class="py-5 bg-light">
    <div class="container text-center">
      <h2 class="section-title">Our Classes</h2>
      <div class="row g-4 mt-4">
        <div class="col-md-4">
          <div class="card border-0 shadow-sm">
            <img src="https://images.unsplash.com/photo-1600880292089-90a7e086ee0c" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Nursery</h5>
              <p class="card-text">Fun, creativity, and early development in a playful learning environment.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 shadow-sm">
            <img src="https://images.unsplash.com/photo-1600353061113-9ecdc501f5c6" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Primary 1-3</h5>
              <p class="card-text">Fostering curiosity and teamwork through exciting lessons and projects.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border-0 shadow-sm">
            <img src="https://images.unsplash.com/photo-1596495577886-d920f1fb7238" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Primary 4-6</h5>
              <p class="card-text">Preparing students for future success with leadership and excellence.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5 bg-light">
    <div class="container text-center">
      <h2 class="section-title">Latest News</h2>
      <div class="row g-4 mt-4">
        <!-- <div class="col-md-3"> -->

        <h3 class="mt-5 text-center">Latest Activities</h3>
        <div class="row">
        @foreach($activities as $act)
            <div class="col-md-4">
                <div class="card shadow mb-3">
                    <img src="{{ asset('uploads/activities/'.$act->image) }}" class="card-img-top">
                    <div class="card-body">
                        <h5>{{ $act->title }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
        </div>

        <h3 class="mt-5">News & Announcements</h3>
        {{-- <ul>
        @foreach($news as $n)
            <li>{{ $n->title }}</li>
        @endforeach
        </ul> --}}


        </div>
      </div>
    </div>
  </section>


   <!-- TEACHERS SECTION -->
  <section id="teachers" class="py-5">
    <div class="container text-center">
      <h2 class="section-title">Meet Our Teachers</h2>
      <div class="row g-4 mt-4">
        <div class="col-md-3">
          <div class="card border-0 shadow-sm p-3">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle mx-auto" width="100">
            <h5 class="mt-3">Mrs. Adeola Johnson</h5>
            <p class="text-muted mb-0">Head Teacher</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card border-0 shadow-sm p-3">
            <img src="https://randomuser.me/api/portraits/men/35.jpg" class="rounded-circle mx-auto" width="100">
            <h5 class="mt-3">Mr. Emmanuel Okoro</h5>
            <p class="text-muted mb-0">Mathematics</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card border-0 shadow-sm p-3">
            <img src="https://randomuser.me/api/portraits/women/65.jpg" class="rounded-circle mx-auto" width="100">
            <h5 class="mt-3">Mrs. Kemi Balogun</h5>
            <p class="text-muted mb-0">Science</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card border-0 shadow-sm p-3">
            <img src="{{ asset('assets/images/Yusuf-Passport.jpg') }}" class="rounded-circle mx-auto" width="100">
            <h5 class="mt-3">Mr. Yusuf Kareem</h5>
            <p class="text-muted mb-0">ICT Instructor</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Teachers end -->
   <!-- Services -->
<section id="services" class="p-5 bg-light" style="color:navy; ">
  <div class="container" style="color:navy; ">
    <h2>Our Services</h2>
    <div class="row" style="color:navy; ">
      <div class="col-md-4">
        <div class="card p-3">
          <span class="p-2"> <i class="fas fa-cloud"></i> </span>
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

<!-- CONTACT SECTION -->
  <section id="contact" class="py-5 bg-light">
    <div class="container text-center">
      <h2 class="section-title">Contact Us</h2>
      <p class="mb-4">We’d love to hear from you. Get in touch for admissions or inquiries.</p>
      <form class="row g-3 justify-content-center">
        <div class="col-md-4">
          <input type="text" class="form-control" placeholder="Full Name" required>
        </div>
        <div class="col-md-4">
          <input type="email" class="form-control" placeholder="Email Address" required>
        </div>
        <div class="col-md-8">
          <textarea class="form-control" rows="4" placeholder="Your Message" required></textarea>
        </div>
        <div class="col-md-8">
          <button type="submit" class="btn btn-custom">Send Message</button>
        </div>
      </form>
    </div>
  </section>
<!-- CONTACT SECTION ENDS -->

<!-- Contact -->
<section id="contact" class="p-5">
  <div class="container">
    <h2>Contact Us</h2>
    <p>Email: info@lisschool.com | Phone: +234-8141132252</p>
  </div>
</section>
   <!-- 2 copied ends here -->

  <!-- About Section -->
  <section class="py-5" style="color:navy; ">
    <div class="container">
      <h2 class="text-center mb-4">About Us</h2>
      <p class="text-center">Laurisdan Nursery & Primary School provides quality education from Nursery to Primary 6, fostering growth, discipline, and academic success.</p>
    </div>
  </section>

  <!-- Footer -->
   <section class="bg-primary text-light">
    <div class="container ">
    <h2>Quick Links</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="card p-3" style="color:navy; ">
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
  
    <!-- first footer ends here -->
  <footer class="bg-dark text-light py-3 mt-5">
    <div class="container text-center">
      <marquee><small> powered by <a href=""> YusTech</a> : &copy; {{ date('Y') }} Laurisdan Nursery & Primary School. All Rights Reserved.</small> </marquee>
    </div>
  </footer>
  </section>


<!-- FOOTER -->
  <footer class="footer text-center">
    <div class="container">
      <p>powered by <a href=""> YusTech</a> : &copy; 2025 - {{ date('Y') }} Laurisdan Nursery & Primary School. All Rights Reserved.</p>
      <div>
        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>