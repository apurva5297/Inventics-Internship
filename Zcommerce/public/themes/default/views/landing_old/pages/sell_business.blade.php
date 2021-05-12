@extends('landing_old.layout')

@section('content')
        <!--  -->
        <section class="wow fadeIn cover-background background-position-top top-space" style="background-image:url({{ theme_asset_url('landing/breadcrumbs_banners/banner_1920x1100___05.png')}});">
            <div class="opacity-medium bg-extra-dark-gray"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12 page-title-large d-flex flex-column justify-content-center align-items-center text-center padding-30px-tb">
                        <!-- start sub title -->
                        <span class="d-block text-white-2 opacity6 width-45 md-width-100 alt-font margin-10px-bottom"></span>
                        <!-- end sub title -->
                        <!-- start page title -->
                        <h1 class="alt-font text-white-2 font-weight-600 mb-0">Start Your Business</h1>
                        <!-- end page title -->
                    </div>
                </div>
            </div>
        </section>
        <section class="wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 last-paragraph-no-margin">
                        <!-- <h5 class="text-extra-dark-gray alt-font font-weight-600" style="margin-bottom: 5px">Start Your Business</h5> -->
                        <h6 style="margin-bottom: 10px">Take the steps to move from your dream to success</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4 col-md-6" style="padding:10px">
                        <div class=" d-flex align-items-center bg-black feature-box-1 sm-no-padding-lr text-center text-md-left">
                            <div class="padding-eighteen-all lg-padding-ten-all sm-padding-30px-tb sm-padding-20px-lr width-100">
                                <span class="alt-font text-medium-gray margin-10px-bottom d-block">Create your shop</span>
                                <h6 class="text-light-gray alt-font">Create your own shop and sell as your need</h6>
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p> -->
                                <center><a class="btn btn-transparent-light-gray btn-small border-radius-4" href="{{url('/register')}}"><i class="fas fa-play-circle icon-very-small margin-5px-right ml-0" aria-hidden="true"></i></a></center>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6" style="padding:10px">
                        <div class=" d-flex align-items-center bg-extra-dark-gray feature-box-1 sm-no-padding-lr text-center text-md-left">
                            <div class="padding-eighteen-all lg-padding-ten-all sm-padding-30px-tb sm-padding-20px-lr width-100">
                                <span class="alt-font text-medium-gray margin-10px-bottom d-block">Manage Your Shop</span>
                                <h6 class="text-light-gray alt-font">Manage your all shop from one platform</h6>
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p> -->
                                <center><a class="btn btn-transparent-light-gray btn-small border-radius-4" href="{{url('/login')}}"><i class="fas fa-play-circle icon-very-small margin-5px-right ml-0" aria-hidden="true"></i></a></center>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 d-flex cover-background feature-box-1 md-height-450px sm-height-350px" style="background: url({{ theme_asset_url('landing/img/vector_02.png')}})"></div>
                </div>
            </div>
        </section>
        
        <!-- <section class="bg-light-gray">
            <div class="container">
                <div class="row align-items-center">
                    
                    <div class="col-12 col-lg-6 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                        <span class="text-medium text-deep-pink alt-font margin-10px-bottom d-inline-block">Easy way to build perfect websites</span>
                        <h5 class="alt-font text-extra-dark-gray font-weight-600">Beautifully handcrafted templates for your website</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since. Lorem Ipsum has been the industry's standard dummy text ever since. Lorem Ipsum is simply dummy text.</p>
                        <div class="margin-30px-tb">
                            <ul class="p-0 list-style-5">
                                <li>Beautiful and easy to understand UI, professional animations</li>
                                <li>Theme advantages are pixel perfect design &amp; clear code delivered</li>
                                <li>Present your services with flexible, convenient and multipurpose</li>
                                <li>Find more creative ideas for your projects </li>
                                <li>Unlimited power and customization possibilities</li> 
                            </ul>                                
                        </div>
                        <a href="services-modern.html" class="btn btn-dark-gray btn-small text-extra-small">View more info</a>
                    </div>
                    <div class="col-12 col-lg-5 offset-lg-1 md-margin-30px-bottom wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                        <img src="images/services-img9.png" class="w-100" alt="" data-no-retina="">
                    </div>
                </div>
            </div>
        </section> -->
        <!-- end page title section --> 
        <section class="wow fadeIn bg-light-gray" style="visibility: visible; animation-name: fadeIn;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6 md-margin-30px-bottom wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                        <img src="{{ theme_asset_url('landing/breadcrumbs_banners/banner_1920x1100___14.png')}}" class="w-100" alt="" data-no-retina="">
                    </div>
                    <div class="col-12 col-xl-5 col-lg-6 offset-xl-1 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                        <h5 class="alt-font text-extra-dark-gray font-weight-600 margin-30px-bottom">Beautifully handcrafted templates for your website</h5>
                        <ul class="p-0 list-style-4">
                            <li>Beautiful and easy to understand UI, professional animations</li>
                            <li>Theme advantages are pixel perfect design &amp; clear code delivered</li>
                            <li>Present your services with flexible, convenient and multipurpose</li>
                            <li>Find more creative ideas for your projects </li>
                            <li>Unlimited power and customization possibilities</li> 
                        </ul>
                        <a href="portfolio-full-width-masonry-overlay.html" class="btn btn-dark-gray btn-small text-extra-small border-radius-4 margin-20px-top"><i class="fas fa-play-circle icon-very-small margin-5px-right ml-0" aria-hidden="true"></i> View Portfolio</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title section --> 

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <center><h5 style="color: #000"><u>Best Ecommerce platform for your business</u></h5></center>
                    </div>
                    <div class="col-12 margin-60px-bottom sm-margin-30px-bottom wow fadeIn" style="visibility: visible; animation-name: fadeIn;"><img src="images/services-img1.jpg" alt=""></div>
                    <!-- start service item -->

                    <div class="col-12 col-lg-4 md-margin-40px-bottom sm-margin-30px-bottom wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <!-- <div class="text-small alt-font text-medium-gray text-uppercase">E-Commerce</div> -->
                        <span class="text-medium alt-font text-extra-dark-gray d-block margin-15px-bottom md-margin-10px-bottom">E-Commerce Solution</span>
                        <p class="width-90 md-width-100 sm-margin-15px-bottom">Zcommerce believes the reason it seems that price is all your customers care about is that you haven't given them anything else to care about.</p>
                        <div class="separator-line-horrizontal-medium-light margin-30px-top md-no-margin-top bg-deep-pink"></div>
                    </div>
                    <!-- end service item -->
                    <!-- start service item -->
                    <div class="col-12 col-lg-4 md-margin-40px-bottom sm-margin-30px-bottom wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <!-- <div class="text-small alt-font text-medium-gray text-uppercase">Digital</div> -->
                        <span class="text-medium alt-font text-extra-dark-gray d-block margin-15px-bottom md-margin-10px-bottom">Web Development</span>
                        <p class="width-90 md-width-100 sm-margin-15px-bottom">Websites promote you 24*7, which no employees will do that for you. Zcommerce don't just build websites, Zcommerce builds websites that sells.</p>
                        <div class="separator-line-horrizontal-medium-light margin-30px-top md-no-margin-top bg-deep-pink"></div>
                    </div>
                    <!-- end service item -->
                    <!-- start service item -->
                    <div class="col-12 col-lg-4 wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <!-- <div class="text-small alt-font text-medium-gray text-uppercase">Analytics</div> -->
                        <span class="text-medium alt-font text-extra-dark-gray d-block margin-15px-bottom md-margin-10px-bottom">Marketing Strategy</span>
                        <p class="width-90 md-width-100 sm-margin-15px-bottom">Zcommerce believes the aim of marketing is to know and understand the customer so well that the product or service fits him and sells itself.</p>
                        <div class="separator-line-horrizontal-medium-light margin-30px-top md-no-margin-top bg-deep-pink"></div>
                    </div>
                    <!-- end service item -->
                </div>
            </div>
        </section>
        
@endsection
       