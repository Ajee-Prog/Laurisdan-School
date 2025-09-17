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
</div>



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
                            </div>
                            <!-- after span -->
                             <div class="courses-ratings">
                                <span>4.7 <i class="fa-solid fa-star"></i></span>
                                <span>Ratings (58k) <i class="fa-solid fa-star"></i></span>
                             </div>
                            <!-- after span ends -->
                        </div>
                    </div>
                </div>


             </div>
            <!-- *** Banner Ends  *** -->
@endsection