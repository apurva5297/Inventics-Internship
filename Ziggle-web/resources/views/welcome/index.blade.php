@extends('welcome.layouts.master')
@section('title')
{{ 'ZIGGLE'}}
@endsection
@section('content')

  <!--hero section start-->
  
    <section class="hero hero-2">
        <div class="hero__wrapper">
        <div class="container">
            <div class="row align-items-lg-center">
            <div class="col-lg-6 order-2 order-lg-1">
                <h1 class="main-heading color-black">Earn from home with Zero Investment</h1>
                <p class="paragraph">Kiddotrack helps schools and parents to track the school bus and receive important notifications on their mobile phone. It is an innovative school bus tracker without installing GPS devices! A cost effective solution that has ready Web and Mobile Apps for your school and parents.</p>
                <div class="download-buttons">
                  <a href=" https://play.google.com/store/apps/details?id=com.inventics.ziggle" class="google-play">
                    <i class="fab fa-google-play"></i>
                    <div class="button-content">
                      <h6>Google Play <span>Reseller App</span></h6>
                    </div>
                  </a>
                {{-- <a href="#" class="apple-store">
                  <i class="fab fa-google-play"></i>
                  <div class="button-content">
                    <h6>Google Play <span>Parent App</span></h6>
                  </div>
                </a> --}}
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="questions-img hero-img">
                <img style="width:80%;height:80%;" src="assets/images/banner.png" alt="image">
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
  <!--hero section end-->

  <!--feature section start-->
  <section id="benifits">
    <div class="container">
      <h4 class="section-heading color-black">Steps to earn on Ziggle</h4>
      <div class="row">
      <div class="col-lg-4 col-md-6">
          <div class="feature__box feature__box--3">
            <div class="icon icon-3">
              <i class="fad fa-solar-system"></i>
            </div>
            <div class="feature__box__wrapper">
              <div class="feature__box--content feature__box--content-3">
                <h3>Find products you want to sell at wholesale price</h3>
                <p class="paragraph dark">No students cards needed to
                capture In-Bus Attendance
                and send parents notifications
                </p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="feature__box feature__box--2">
            <div class="icon icon-2">
              <i class="fad fa-lightbulb-on"></i>
            </div>
            <div class="feature__box__wrapper">
              <div class="feature__box--content feature__box--content-2">
                <h3>Add your own margin with the product</h3>
                <p class="paragraph dark">Kiddotrack Driver and Matron’s
                App help them to work smartly,
                and automagically sends all information in app
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="feature__box feature__box--4">
            <div class="icon icon-4">
              <i class="fad fa-rocket-launch"></i>
            </div>
            <div class="feature__box__wrapper">
              <div class="feature__box--content feature__box--content-4">
                <h3>Share them on your social networking site </h3>
                <p class="paragraph dark">Fully secured with highest data privacy standards. 
                    Guaranteed uptime to ensure continuous monitoring 
                </p>
              </div>
            </div>
          </div>
        </div>
      
        <div class="col-lg-4 col-md-6">
          <div class="feature__box feature__box--1">
            <div class="icon icon-1">
              <i class="fad fa-user-astronaut"></i>
            </div>
            <div class="feature__box__wrapper">
              <div class="feature__box--content feature__box--content-1">
                <h3>Deliver the product</h3>
                <p class="paragraph dark">No GPS devices to be fitted. Get started instantly with mobile apps.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="feature__box feature__box--4">
            <div class="icon icon-2">
              <i class="fad fa-rocket-launch"></i>
            </div>
            <div class="feature__box__wrapper">
              <div class="feature__box--content feature__box--content-4">
                <h3>Collect COD or make online payment</h3>
                <p class="paragraph dark">Parents have full visibility of their
                     kids pickup and drop off times
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="feature__box feature__box--4">
            <div class="icon icon-2">
              <i class="fad fa-rocket-launch"></i>
            </div>
            <div class="feature__box__wrapper">
              <div class="feature__box--content feature__box--content-4">
                <h3>Earn money from home with Zero investment</h3>
                <p class="paragraph dark">Parents have full visibility of their
                     kids pickup and drop off times
                </p>
              </div>
            </div>
          </div>
        </div>
    
      </div>
    </div>
  </section>
  <!--feature section end-->

  <!--growth section start-->
  <section class="growth" id="feature">
    <div class="growth__wrapper">
      <div class="container">
        <h2 class="section-heading color-black">We ensure your success</h2>
        <div class="row">
          <div class="col-lg-6">
            <div class="growth__box">
              <div class="icon">
                <i class="fad fa-user-astronaut"></i>
              </div>
              <div class="content">
                <h3>Quality products at wholesale price</h3>
                <p class="paragraph dark"> during daily commutes and field trips. Receive instant notification whenever speed limit is exceeded.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="growth__box">
              <div class="icon">
                <i class="fad fa-lightbulb-on"></i>
              </div>
              <div class="content">
                <h3>Free website</h3>
                <p class="paragraph dark"> when kids are on-board and off-board the bus.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="growth__box">
              <div class="icon">
                <i class="fad fa-solar-system"></i>
              </div>
              <div class="content">
                <h3>Regular update on each order</h3>
                <p class="paragraph dark"> in the streets. Receive automatic notification when the bus is nearby
                  </p>
              </div>
            </div>
          </div>
           <div class="col-lg-6">
            <div class="growth__box">
              <div class="icon">
                <i class="fad fa-backpack"></i>
              </div>
              <div class="content">
                <h3>Trusted Reselling App </h3>
                <p class="paragraph dark">and securely with the bus matron, the school and the other parents </p>
              </div>
            </div>
          </div> 
      </div>
    </div>
  </section>
  <!--growth section end-->

  {{-- <!--step section start-->
   <section class="step">
    <div class="step__wrapper">
      <div class="container">
        <h2 class="section-heading color-black">Jumpstart your growth in just few clicks.</h2>
        <div class="row">
          <div class="col-lg-4">
            <div class="step__box">
              <div class="image">
                <img src="assets/images/phone-01.png" alt="image">
              </div>
              <div class="content">
                <h3>EASY TO<span>Register.</span></h3>
                <p class="paragraph dark">Join the app in 3 easy steps and get
                  started with your progresso daily.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="step__box">
              <div class="image">
                <img src="assets/images/phone-02.png" alt="image">
              </div>
              <div class="content">
                <h3>SIMPLE TO<span>Create.</span></h3>
                <p class="paragraph dark">Once you’re signed up you can create
                  as many polls you want to watch.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="step__box">
              <div class="image">
                <img src="assets/images/phone-03.png" alt="image">
              </div>
              <div class="content">
                <h3>FUN TO<span>Measure.</span></h3>
                <p class="paragraph dark">Share your growth results with your
                  friends and inspre others.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="button__wrapper">
            <a href="#" class="button">
              <span>GET STARTED <i class="fad fa-long-arrow-right"></i></span>
            </a>
            <a href="#" class="button">
              <span>LEARN MORE <i class="fad fa-long-arrow-right"></i></span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--step section end--> --}}

  <!--client section start-->
  {{-- <section class="clients-sec" id="feedback">
    <div class="container">
      <h2 class="section-heading color-black">Hear from what others had to say.</h2>
      <div class="testimonial__wrapper">
        <div class="client client-01 active">
          <div class="image">
            <img src="assets/images/testimonial-img-01.png" alt="image">
          </div>
          <div class="testimonial">
            <div class="testimonial__wrapper">
              <p>“One Hath. Second. Kind them you fourth, fly brought. Give very let. Dominion wherein after can't fill,
                unto brought waters air. And our Beast won't dry there have after it. You have herb shall creeping bring
                sixth tree she'd open.”</p>
              <h4>— DAVID SPADE</h4>
            </div>
          </div>
        </div>
        <div class="client client-02">
          <div class="image">
            <img src="assets/images/testimonial-img-02.png" alt="image">
          </div>
          <div class="testimonial">
            <div class="testimonial__wrapper">
              <p>“One Hath. Second. Kind them you fourth, fly brought. Give very let. Dominion wherein after can't fill,
                unto brought waters air. And our Beast won't dry there have after it. You have herb shall creeping bring
                sixth tree she'd open.”</p>
              <h4>— MONICA WADE</h4>
            </div>
          </div>
        </div>
        <div class="client client-03">
          <div class="image">
            <img src="assets/images/testimonial-img-03.png" alt="image">
          </div>
          <div class="testimonial">
            <div class="testimonial__wrapper">
              <p>“One Hath. Second. Kind them you fourth, fly brought. Give very let. Dominion wherein after can't fill,
                unto brought waters air. And our Beast won't dry there have after it. You have herb shall creeping bring
                sixth tree she'd open.”</p>
              <h4>— KIRA SMITH</h4>
            </div>
          </div>
        </div>
        <div class="client client-04">
          <div class="image">
            <img src="assets/images/testimonial-img-04.png" alt="image">
          </div>
          <div class="testimonial">
            <div class="testimonial__wrapper">
              <p>“One Hath. Second. Kind them you fourth, fly brought. Give very let. Dominion wherein after can't fill,
                unto brought waters air. And our Beast won't dry there have after it. You have herb shall creeping bring
                sixth tree she'd open.”</p>
              <h4>— WILL SMITH</h4>
            </div>
          </div>
        </div>
      </div>
      <div class="clients">
        <div class="clients__info">
          <h3>3,780+</h3>
          <p class="paragraph dark">Customers in over 4 countries are growing their businesses with us.</p>
        </div>
        <div class="swiper-container clients-slider">
          <div class="swiper-wrapper">
            <div class="swiper-slide clients-slide">
              <a href="https://en.wikipedia.org/wiki/India"  target="_blank"><img src="assets/images/india.png" alt="image"  style="width: 100px;"></a>
            </div>
            <div class="swiper-slide clients-slide">
              <a href="https://en.wikipedia.org/wiki/Kuwait" target="_blank"><img src="assets/images/kuwait.png" alt="image"  style="width: 100px;"></a>
            </div>
            <div class="swiper-slide clients-slide">
              <a href="https://en.wikipedia.org/wiki/Sweden"  target="_blank"><img src="assets/images/sweden.png" alt="image" style="width: 100px;"></a>
            </div>
            <div class="swiper-slide clients-slide">
              <a href="https://en.wikipedia.org/wiki/United_Kingdom"  target="_blank"><img src="assets/images/united-kingdom.png" alt="image"  style="width: 100px;"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
  <!--client section end-->

  
  <!--questions section end-->

  

  <!--screenshot section start-->
  <!--screenshot section end-->
{{-- 
  <!--pricing section start-->
  <section class="pricing" id="pricing">
    <div class="pricing__wrapper">
      <h2 class="section-heading color-black">Franchise Pricing plans</h2>
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="pricing__single pricing__single-1">
              <div class="icon">
                <i class="fad fa-user-graduate"></i>
              </div>
              <h4>FREE</h4>
              <h3>Rs 0.00</h3>
              <h6>Per student/ month</h6>
              <div class="list">
                <ul>
                  <li>100 Students registation</li>
                  <li>100 parent's app accounts</li>
                  <li>5 Driver & vehicles</li>
                  <li>1 School</li>
                  <li>Basic customer support</li>
                  <li>50 trips per month</li>
                  <li>5 Routes only</li>
                </ul>
              </div>
              <a href="#contact" class="button">
                <span>GET STARTED <i class="fad fa-long-arrow-right"></i></span>
              </a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="pricing__single pricing__single-2">
              <div class="icon">
                <i class="fad fa-user-cowboy"></i>
              </div>
              <h4>PREMIUM</h4>
              <h3>Rs 10.00</h3>
              <h6>Per student/ month</h6>
              <div class="list">
                <ul>
                  <li>5000 Students registation</li>
                  <li>5000 parent's app accounts</li>
                  <li>500 Driver & vehicles</li>
                  <li>100 School</li>
                  <li>Premium customer support</li>
                  <li>5000 trips per month</li>
                  <li>500 Routes only</li>
                </ul>
              </div>
              <a href="#contact" class="button">
                <span>GET STARTED <i class="fad fa-long-arrow-right"></i></span>
              </a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="pricing__single pricing__single-3">
              <div class="icon">
                <i class="fad fa-user-astronaut"></i>
              </div>
              <h4>GOLD</h4>
              <h3>Rs 15.00</h3>
              <h6>Per student/ month</h6>
              <div class="list">
                <ul>
                  <li>Unlimited Students registation</li>
                  <li>Unlimited parent's app accounts</li>
                  <li>Unlimited Driver & vehicles</li>
                  <li>Unlimited School</li>
                  <li>Gold customer support</li>
                  <li>Unlimited trips per month</li>
                  <li>Unlimited Routes</li>
                </ul>
              </div>
              <a href="#contact" class="button">
                <span>GET STARTED <i class="fad fa-long-arrow-right"></i></span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--pricing section end--> --}}

  <!--screenshot section start-->
<br>
<br>
<br>
  <section class="screenshot" id="preview">
    <div class="screenshot__wrapper">
      <div class="container">
        <div class="screenshot__info">
          <h2 class="section-heading color-black">Have a look at what’s inside the Ziggle app.</h2>
          <div class="screenshot-nav">
            <div class="screenshot-nav-prev"><i class="fad fa-long-arrow-left"></i></div>
            <div class="screenshot-nav-next"><i class="fad fa-long-arrow-right"></i></div>
          </div>
        </div>
      </div>
      <div class="swiper-container screenshot-slider">
        <div class="swiper-wrapper">
          <div  class="swiper-slide screenshot-slide">
            <img style="width:80%;height:80%;" src="assets/images/phone-011.png" alt="image">
          </div>
          <div class="swiper-slide screenshot-slide">
            <img style="width:80%;height:80%;"src="assets/images/phone-022.png" alt="image">
          </div>
          <div class="swiper-slide screenshot-slide">
            <img style="width:80%;height:80%;" src="assets/images/phone-033.png" alt="image">
          </div>
          <div class="swiper-slide screenshot-slide">
            <img style="width:80%;height:80%;"src="assets/images/phone-044.png" alt="image">
          </div>
          <div class="swiper-slide screenshot-slide">
            <img style="width:80%;height:80%;" src="assets/images/phone-055.png" alt="image">
          </div>
          <div class="swiper-slide screenshot-slide">
            <img style="width:80%;height:80%;" src="assets/images/phone-066.png" alt="image">
          </div>
          <div class="swiper-slide screenshot-slide">
            <img style="width:80%;height:80%;" src="assets/images/phone-077.png" alt="image">
          </div>
          <div class="swiper-slide screenshot-slide">
            <img style="width:80%;height:80%;" src="assets/images/phone-088.png" alt="image">
          </div>
          <div class="swiper-slide screenshot-slide">
            <img style="width:80%;height:80%;" src="assets/images/phone-099.png" alt="image">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--newsletter section start-->
  <!-- contact us start -->

  <div id="contact">
      <section class="newsletter newsletter-2">
          <div class="newsletter__wrapper">
              <div class="container">
                  <div class="row align-items-lg-center">
                      <div class="col-lg-8">
                          <div class="newsletter__info">
                              <h2 class="section-heading color-black">Get in touch with us today.</h2>
                              <form method="post" action="/thankyou">
                                @csrf
                              <div class="comment_form">
                                
                                  <div>
                                      <input type="text" placeholder="Name *" class="input-field" required pattern="[a-zA-Z\s]+" name="name">
                                      <input type="email" name="email" placeholder="Email *" class="input-field" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                      <input type="text" name="mobile" placeholder="Phone Number *" class="input-field" required maxlength="10" minlength="10" pattern="[0-9]+">
                                    </div>
                                    <div>
                                        <textarea placeholder="Write message *" name="message" class="input-field" required pattern="[a-zA-Z\s]+"></textarea>
                                        <button type="submit" class="button"><span>SEND <i class="fad fa-long-arrow-right"></i></span></button>
                                    </div>
                                  
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="newsletter__img">
                                <img src="assets/images/newsletter-img-1.png" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- contact us end -->
    <!--newsletter section end-->
    @endsection