@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <section>
                <h1> This is Landing Page</h1>
            </section>
        </div>
    </div>
<!-- </div> -->



<!-- *** Banner starts  *** -->
             <div class="banner">
                <div class="banner-desc">
                    <h2> Start Learning with our Experts, anywhere, Anytime </h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque quod sit nihil ratione labore rem omnis itaque laudantium harum distinctio nesciunt officiis nisi, laborum quis in doloribus deserunt cumque? Accusantium.
                    Sit, maxime commodi deleniti quam eius exercitationem odio quibusdam quasi fuga error neque nam alias nostrum ducimus aperiam laboriosam soluta perspiciatis libero unde sunt ex aliquid necessitatibus repudiandae vitae? Alias?
                    Adipisci, laudantium. Laborum corporis architecto vel, consectetur quam impedit sapiente sit enim itaque expedita eius, nemo alias tempore consequuntur, assumenda sequi ad? Voluptatem eaque in quos! Quis sapiente nisi possimus!</p>

                    <form action="" class="search-bar">
                        <input type="search" name="" id="" placeholder="Search Your Course">
                        <i class="fa-solid fa-search"></i>
                    </form>
                </div>

                <div class="banner-img">
                    <div class="banner-img-container">
                        <img src="{{ asset('assets/images/laurisdan10.jpg') }}" alt="">

                         <div class="states">
                            <div class="total-courses">
                                <div class="icon">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                                <div class="desc">
                                    <span>284+</span>
                                    <span>Total Courses+</span>
                                </div>
                            </div>

                             <!-- after span -->
                             <div class="courses-ratings">
                                <span>4.7 <i class="fa-solid fa-star"></i></span>
                                <span>Ratings (58k) <i class="fa-solid fa-star"></i></span>
                             </div>
                            <!-- after span ends -->
                             <!-- *** Banner starts  *** -->
             <!-- <div class="banner">
                <div class="banner-desc">
                    <h2> Start Learning with our Experts, anywhere, Anytime </h2>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque quod sit nihil ratione labore rem omnis itaque laudantium harum distinctio nesciunt officiis nisi, laborum quis in doloribus deserunt cumque? Accusantium.
                    Sit, maxime commodi deleniti quam eius exercitationem odio quibusdam quasi fuga error neque nam alias nostrum ducimus aperiam laboriosam soluta perspiciatis libero unde sunt ex aliquid necessitatibus repudiandae vitae? Alias?
                    Adipisci, laudantium. Laborum corporis architecto vel, consectetur quam impedit sapiente sit enim itaque expedita eius, nemo alias tempore consequuntur, assumenda sequi ad? Voluptatem eaque in quos! Quis sapiente nisi possimus!</p>
                    <form action="" class="search-bar">
                        <input type="search" name="" id="" placeholder="Search Your Course">
                        <i class="fa-solid fa-search"></i>
                    </form>
                </div> -->

                <!-- <div class="banner-img">
                    <div class="banner-img-container">
                        <img src="./images/laurisdan10.jpg" width="100%" alt="">

                        <div class="states">
                            <div class="total-courses">
                                <div class="icon">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                                <div class="desc">
                                    <span>284+</span>
                                    <span>Total Courses+</span>
                                </div>
                            </div> -->
                            <!-- after span -->
                             <!-- <div class="courses-ratings">
                                <span>4.7 <i class="fa-solid fa-star"></i></span>
                                <span>Ratings (58k) <i class="fa-solid fa-star"></i></span>
                             </div> -->
                            <!-- after span ends -->
                        <!-- </div> -->
                    <!-- </div> -->
                <!-- </div> -->


             <!-- </div> -->
            <!-- *** Banner Ends  *** -->
                        </div>

                    </div>
                </div>
             </div>
            <!-- *** Banner Ends  *** -->
         </section>
        <!-- *** Home Section Ends *** -->
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
            <p>Email: info@lisschool.com | Phone: +234-8141132252</p>
        </div>
        </section>

        <!-- Footer -->
        <footer class="bg-primary text-white text-center p-3">
        © {{ date('Y') }} LAURISDAN NURSRY AND PRIMARY School. All Rights Reserved.
        </footer>
     </div>
    <!-- *** Website Container Ends *** -->

         <!-- Plain Html navbar ends here -->
@endsection