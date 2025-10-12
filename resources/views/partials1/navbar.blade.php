 <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laurisdan School
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <!-- Plain Html start here -->

         <!-- *** Website Container Start *** -->
     <div class="website-container">
        <!-- *** Home Section Start *** -->
         <section class="home" id="home">
            <!-- *** Main Nav start *** -->
             <!-- <nav class=" navbar navbar-expand-lg navbar-dark b-primary shadow-sm main-nav"> -->
             <nav class=" navbar navbar-expand-lg navbar-dark b-primary shadow-sm main-nav">
                <a href="{{ route('home') }}" class="logo">
                    <img src= "{{ asset('assets/images/laurisdanLogo1.jpg') }}"  alt="" width="40">
                </a>
                <ul class="nav-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="">Courses</a></li>
                    <li>
                        <a href="">Services</a>

                        
                    </li>
                    <li><a href="">Location</a></li>
                    <li><a href="">Testimonials</a></li>
                    <li><a href="">Blogs</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    
                </ul>
                <a href="#" class="get-started-btn-container">
                    <button class="get-started-btn btn">Get Started</button>
                </a>
                <div class="menu-btn">
                    <span></span>
                </div>
             </nav>