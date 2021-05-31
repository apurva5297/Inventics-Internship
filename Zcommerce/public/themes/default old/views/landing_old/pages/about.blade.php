@extends('landing_old.layout')

@section('content')
<section class="wow fadeIn cover-background background-position-top top-space" style="background-image:url({{ theme_asset_url('landing/breadcrumbs_banners/about_us.png')}});">
            <div class="opacity-medium bg-extra-dark-gray"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 d-flex flex-column text-center justify-content-center page-title-large padding-30px-tb">
                        <!-- start sub title -->
                        <span class="d-block text-white-2 opacity6 alt-font margin-5px-bottom">We are awesome</span>
                        <!-- end sub title -->
                        <!-- start page title -->
                        <h1 class="alt-font text-white-2 font-weight-600 mb-0">About Us</h1>
                        <!-- end page title -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title section -->     
        <!-- start story section -->
        <section class="wow fadeIn">
            <div class="container"> 
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5 text-center md-margin-30px-bottom wow fadeInLeft">
                        <img src="{{ theme_asset_url('landing/breadcrumbs_banners/banner_1920x1100___16.png')}}" alt="" class="border-radius-6 w-100">
                    </div> 
                    <div class="col-12 col-lg-7 padding-eight-lr text-center text-lg-left lg-padding-nine-right md-padding-15px-lr wow fadeInRight" data-wow-delay="0.2s">
                        <span class="text-deep-pink alt-font margin-10px-bottom d-inline-block text-medium">Don’t worry, you’re in safe hands.</span>
                        <h6 class="alt-font text-extra-dark-gray">We are committed to our customers’ success from start to finish. Our input helps make their solutions.</h6>
                        <p>Zcommerce provides the best for your business Zcommerce is a team of young minds which brings fresh innovative ideas to implement into your business and make them grow. Zcommerce is the only place to start and expand your business.</p>
                        <a href="{{url('contact-us')}}" class="btn btn-dark-gray btn-small text-extra-small btn-rounded margin-5px-top"><i class="fas fa-play-circle icon-very-small margin-5px-right no-margin-left" aria-hidden="true"></i> Contact Us</a>
                    </div>
                </div>
                
            </div>
        </section>
        
        <section class="wow fadeIn bg-light-gray" style="visibility: visible; animation-name: fadeIn;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-7 text-center margin-100px-bottom sm-margin-40px-bottom">
                        <div class="position-relative overflow-hidden w-100">
                            <h5>Why Should you consider us ? </h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- start process step item -->
                    <div class="col-12 col-lg-3 col-md-6 text-center feature-box-11 md-margin-eight-bottom sm-margin-fifteen-bottom wow fadeInRight last-paragraph-no-margin" style="visibility: visible; animation-name: fadeInRight;">
                        <div class="d-inline-block padding-30px-all width-130px height-130px line-height-65 rounded-circle bg-white text-center progress-line">
                            <img src="{{ theme_asset_url('landing/icons/world_class_product.png')}}" alt="" data-no-retina="">
                        </div>
                        <div class="alt-font margin-30px-top margin-5px-bottom text-extra-dark-gray font-weight-600">A World Class Product</div>
                        <!-- <p class="width-75 lg-width-100 md-width-80 mx-auto">Lorem Ipsum is simply text of the printing and typesetting standard industry.</p> -->
                    </div>
                    <!-- end process step item -->
                    <!-- start process step item -->
                    <div class="col-12 col-lg-3 col-md-6 text-center feature-box-11 md-margin-eight-bottom sm-margin-fifteen-bottom wow fadeInRight last-paragraph-no-margin" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInRight;">
                        <div class="d-inline-block padding-30px-all width-130px height-130px line-height-65 rounded-circle bg-white text-center progress-line">
                            <img src="{{ theme_asset_url('landing/icons/great_learning.png')}}" alt="" data-no-retina="">
                        </div>
                        <div class="alt-font margin-30px-top margin-5px-bottom text-extra-dark-gray font-weight-600">Great Learning Opportunity</div>
                        <!-- <p class="width-75 lg-width-100 md-width-80 mx-auto">Lorem Ipsum is simply text of the printing and typesetting standard industry.</p> -->
                    </div>
                    <!-- end process step item -->
                    <!-- start process step item -->
                    <div class="col-12 col-lg-3 col-md-6 text-center feature-box-11 sm-margin-fifteen-bottom wow fadeInRight last-paragraph-no-margin" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInRight;">
                        <div class="d-inline-block padding-30px-all width-130px height-130px line-height-65 rounded-circle bg-white text-center progress-line">
                            <img src="{{ theme_asset_url('landing/icons/motivated_team.png')}}" alt="" data-no-retina="">
                        </div>
                        <div class="alt-font margin-30px-top margin-5px-bottom text-extra-dark-gray font-weight-600">A Highly Motivated Team</div>
                        <!-- <p class="width-75 lg-width-100 md-width-80 mx-auto">Lorem Ipsum is simply text of the printing and typesetting standard industry.</p> -->
                    </div>
                    <!-- end process step item -->
                    <!-- start process step item -->
                    <div class="col-12 col-lg-3 col-md-6 text-center feature-box-11 wow fadeInRight last-paragraph-no-margin" data-wow-delay="1.2s" style="visibility: visible; animation-delay: 1.2s; animation-name: fadeInRight;">
                        <div class="d-inline-block padding-30px-all width-130px height-130px line-height-65 rounded-circle bg-white text-center">
                            <img src="{{ theme_asset_url('landing/icons/order_return.png')}}" alt="" data-no-retina="">
                        </div>
                        <div class="alt-font margin-30px-top margin-5px-bottom text-extra-dark-gray font-weight-600">An Informal Fun Culture</div>
                        <!-- <p class="width-75 lg-width-100 md-width-80 mx-auto">Lorem Ipsum is simply text of the printing and typesetting standard industry.</p> -->
                    </div>
                    <!-- end process step item -->
                </div>
            </div>
        </section>  
        <!-- end story section -->
        
        <section class="wow fadeIn">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-7 col-lg-8 col-md-6 margin-eight-bottom md-margin-40px-bottom sm-margin-30px-bottom text-center">
                        <div class="alt-font text-medium-gray margin-5px-bottom text-uppercase text-small">we believe in business growth</div>
                        <h5 class="alt-font text-extra-dark-gray font-weight-600 mb-0">Talent wins games, but teamwork and intelligence wins championships</h5>
                    </div>
                </div>
                <div class="row">
                    <!-- start team item -->
                    <div class="col-12 col-lg-3 col-md-6 team-block text-left team-style-1 md-margin-seven-bottom sm-margin-60px-bottom wow fadeInRight" data-wow-duration="900ms">
                        <figure>
                            <div class="team-image sm-width-100">
                                <img src="{{ theme_asset_url('/landing/team/vineet_sir.png')}}" alt="">
                                
                            </div>
                            <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-extra-dark-gray text-uppercase">Vineet Saraogi</div>
                                    <div class="text-extra-small text-uppercase text-medium-gray">CEO</div>
                                </div>   
                            </figcaption>
                        </figure>
                        <br /><br />
                    </div>

                    <div class="col-12 col-lg-3 col-md-6 team-block text-left team-style-1 md-margin-seven-bottom sm-margin-30px-bottom wow fadeInRight" data-wow-duration="900ms">
                        <figure>
                            <div class="team-image sm-width-100">
                                <img src="{{ theme_asset_url('/landing/team/puneet_sir.png')}}" alt="">
                                
                            </div>
                            <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-extra-dark-gray text-uppercase">Puneet R Saharey</div>
                                    <div class="text-extra-small text-uppercase text-medium-gray">Director</div>
                                </div>   
                            </figcaption>
                        </figure>
                        <br /><br />
                    </div>

                    <div class="col-12 col-lg-3 col-md-6 team-block text-left team-style-1 md-margin-seven-bottom sm-margin-30px-bottom wow fadeInRight" data-wow-duration="900ms">
                        <figure>
                            <div class="team-image sm-width-100">
                                <img src="{{ theme_asset_url('/landing/team/hermyne.png')}}" alt="">
                                
                            </div>
                            <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-extra-dark-gray text-uppercase">Hermyne</div>
                                    <div class="text-extra-small text-uppercase text-medium-gray">Human Resource</div>
                                </div>   
                            </figcaption>
                        </figure>
                        <br /><br />
                    </div>

                    <div class="col-12 col-lg-3 col-md-6 team-block text-left team-style-1 md-margin-seven-bottom sm-margin-30px-bottom wow fadeInRight" data-wow-duration="900ms">
                        <figure>
                            <div class="team-image sm-width-100">
                                <img src="{{ theme_asset_url('/landing/team/kaushal.png')}}" alt="">
                                
                            </div>
                            <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-extra-dark-gray text-uppercase">Kaushal Kumar</div>
                                    <div class="text-extra-small text-uppercase text-medium-gray">SDE</div>
                                </div>   
                            </figcaption>
                        </figure>
                        <br /><br />
                    </div>

                    <div class="col-12 col-lg-3 col-md-6 team-block text-left team-style-1 md-margin-seven-bottom sm-margin-30px-bottom wow fadeInRight" data-wow-duration="900ms">
                        <figure>
                            <div class="team-image sm-width-100">
                                <img src="{{ theme_asset_url('/landing/team/shakun verma.png')}}" alt="">
                                
                            </div>
                            <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-extra-dark-gray text-uppercase">Shakun Verma</div>
                                    <div class="text-extra-small text-uppercase text-medium-gray">Graphic Designer</div>
                                </div>   
                            </figcaption>
                        </figure>
                        <br /><br />
                    </div>

                    <div class="col-12 col-lg-3 col-md-6 team-block text-left team-style-1 md-margin-seven-bottom sm-margin-30px-bottom wow fadeInRight" data-wow-duration="900ms">
                        <figure>
                            <div class="team-image sm-width-100">
                                <img src="{{ theme_asset_url('/landing/team/rajni.png')}}" alt="">
                                
                            </div>
                            <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-extra-dark-gray text-uppercase">Rajani Verma</div>
                                    <div class="text-extra-small text-uppercase text-medium-gray">Android Developer</div>
                                </div>   
                            </figcaption>
                        </figure>
                        <br /><br />
                    </div>

                    <div class="col-12 col-lg-3 col-md-6 team-block text-left team-style-1 md-margin-seven-bottom sm-margin-30px-bottom wow fadeInRight" data-wow-duration="900ms">
                        <figure>
                            <div class="team-image sm-width-100">
                                <img src="{{ theme_asset_url('/landing/team/mayank.png')}}" alt="">
                                
                            </div>
                            <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-extra-dark-gray text-uppercase">Mayank Dixit</div>
                                    <div class="text-extra-small text-uppercase text-medium-gray">Backend Developer</div>
                                </div>   
                            </figcaption>
                        </figure>
                        <br /><br />
                    </div>

                    <div class="col-12 col-lg-3 col-md-6 team-block text-left team-style-1 md-margin-seven-bottom sm-margin-30px-bottom wow fadeInRight" data-wow-duration="900ms">
                        <figure>
                            <div class="team-image sm-width-100">
                                <img src="{{ theme_asset_url('/landing/team/rishikesh.png')}}" alt="">
                                
                            </div>
                            <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-extra-dark-gray text-uppercase">Rishikesh Singh</div>
                                    <div class="text-extra-small text-uppercase text-medium-gray">Android Developer</div>
                                </div>   
                            </figcaption>
                        </figure>
                        <br /><br />
                    </div>

                    <div class="col-12 col-lg-3 col-md-6 team-block text-left team-style-1 md-margin-seven-bottom sm-margin-30px-bottom wow fadeInRight" data-wow-duration="900ms">
                        <figure>
                            <div class="team-image sm-width-100">
                                <img src="{{ theme_asset_url('/landing/team/rahul.png')}}" alt="">
                                
                            </div>
                            <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-extra-dark-gray text-uppercase">Rahul</div>
                                    <div class="text-extra-small text-uppercase text-medium-gray">Android Developer</div>
                                </div>   
                            </figcaption>
                        </figure>
                        <br /><br />
                    </div>

                    <div class="col-12 col-lg-3 col-md-6 team-block text-left team-style-1 md-margin-seven-bottom sm-margin-30px-bottom wow fadeInRight" data-wow-duration="900ms">
                        <figure>
                            <div class="team-image sm-width-100">
                                <img src="{{ theme_asset_url('/landing/team/vandana.png')}}" alt="">
                                
                            </div>
                            <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-extra-dark-gray text-uppercase">Bandana</div>
                                    <div class="text-extra-small text-uppercase text-medium-gray">PHP Developer</div>
                                </div>   
                            </figcaption>
                        </figure>
                        <br /><br />
                    </div>

                    <div class="col-12 col-lg-3 col-md-6 team-block text-left team-style-1 md-margin-seven-bottom sm-margin-30px-bottom wow fadeInRight" data-wow-duration="900ms">
                        <figure>
                            <div class="team-image sm-width-100">
                                <img src="{{ theme_asset_url('/landing/team/harsh.png')}}" alt="">
                                
                            </div>
                            <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-extra-dark-gray text-uppercase">Harsh</div>
                                    <div class="text-extra-small text-uppercase text-medium-gray">Laravel Developer</div>
                                </div>   
                            </figcaption>
                        </figure>
                        <br /><br />
                    </div>

                    <div class="col-12 col-lg-3 col-md-6 team-block text-left team-style-1 md-margin-seven-bottom sm-margin-30px-bottom wow fadeInRight" data-wow-duration="900ms">
                        <figure>
                            <div class="team-image sm-width-100">
                                <img src="{{ theme_asset_url('/landing/team/neha.png')}}" alt="">
                                
                            </div>
                            <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-extra-dark-gray text-uppercase">Neha</div>
                                    <div class="text-extra-small text-uppercase text-medium-gray">Laravel Developer</div>
                                </div>   
                            </figcaption>
                        </figure>
                        <br /><br />
                    </div>
                    <!-- end team item -->
                </div>                
            </div>
        </section>
        
        <!-- start testimonial section -->
        <section class="wow fadeIn bg-light-gray testimonial-style3">
            <div class="container">    
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-7 col-lg-8 col-md-6 text-center">
                        <div class="alt-font text-medium-gray margin-5px-bottom text-uppercase text-small"></div>
                        <h5 class="alt-font text-extra-dark-gray font-weight-600 mb-0">Employee Testimonial</h5>
                        <br />
                    </div>
                </div>            
                <div class="row justify-content-center">
                    <div class="col-12 col-md-7 col-lg-12">
                        <div class="row">
                            <div class="col-12 col-lg-4 md-margin-two-bottom wow fadeIn last-paragraph-no-margin testimonial-style3">
                                <div class="testimonial-content-box padding-twelve-all bg-white border-radius-6 box-shadow arrow-bottom md-padding-seven-all sm-padding-eight-all">
                                    <p style="text-align: justify;">I am enjoying working with Zcommerce. I can proudly say this is my first and best move. Work environment is good. Zcommerce is fundamentally a strong concern with lot of opportunities to learn. My mentors had faith and pushed me to the edge so that I can learn more and explore new things which made me realize the mettle within me. Honored to be part of Zcommerce family.</p>
                                </div>
                                <!-- start testimonials item -->
                                <div class="testimonial-box padding-25px-all sm-padding-20px-all">
                                    <div class="image-box width-20"><img src="images/avtar-14.jpg" class="rounded-circle" alt=""></div>
                                    <div class="name-box padding-20px-left">
                                        <div class="alt-font font-weight-600 text-small text-uppercase text-extra-dark-gray">Shkun Verma</div>
                                        <p class="text-extra-small text-uppercase text-medium-gray">Graphic Designer</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end testimonials item -->
                            <!-- start testimonials item -->
                            <div class="col-12 col-lg-4 sm-margin-two-bottom wow fadeIn last-paragraph-no-margin testimonial-style3" data-wow-delay="0.2s">
                                <div class="testimonial-content-box padding-twelve-all bg-white border-radius-6 box-shadow arrow-bottom md-padding-seven-all sm-padding-eight-all">
                                    <p style="text-align: justify;">I’ve always been glad to be with Zcommerce because is the right place to learn and to execute my thoughts and ideas on any platform as I wish. Both our people and clients are very supportive and helpful. Very proud to work with Zcommerce and happy to continue my career with Zcommerce.
                                    The work environment in Zcommerce is extremely positive and competitive.</p>
                                </div>
                                <div class="testimonial-box padding-25px-all sm-padding-20px-all">
                                    <div class="image-box width-20"><img src="images/avtar-15.jpg" class="rounded-circle" alt=""></div>
                                    <div class="name-box padding-20px-left">
                                        <div class="alt-font font-weight-600 text-small text-uppercase text-extra-dark-gray">Suyesh</div>
                                        <p class="text-extra-small text-uppercase text-medium-gray">Marketing executive</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end testimonials item -->
                            <!-- start testimonials item -->
                            <div class="col-12 col-lg-4 wow fadeIn last-paragraph-no-margin testimonial-style3" data-wow-delay="0.4s">
                                <div class="testimonial-content-box padding-twelve-all bg-white border-radius-6 box-shadow arrow-bottom md-padding-seven-all sm-padding-eight-all">
                                    <p style="text-align: justify;">Since joining Zcommerce, I have had a good professional journey. The years I have been with the company are the most rewarding and best learning years of my career. It is very motivating to join a company early in its growth process and i throughly enjoy working here. If you want to work in good environment, you can join any place, but if you want to work in a great environment – this is the place.</p>
                                </div>
                                <div class="testimonial-box padding-25px-all sm-padding-20px-all">
                                    <div class="image-box width-20"><img src="images/avtar-16.jpg" class="rounded-circle" alt=""></div>
                                    <div class="name-box padding-20px-left">
                                        <div class="alt-font font-weight-600 text-small text-uppercase text-extra-dark-gray">Anamika</div>
                                        <p class="text-extra-small text-uppercase text-medium-gray">Product manager</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end testimonials item -->
                        </div>
                    </div>
                </div> 
            </div> 
        </section>
        <!-- end testimonial section -->         
        <!-- start team section -->
        
    @endsection