@extends('welcome.layouts.master')
@section('title')
{{ 'About us | ZIGGLE '}}
@endsection
@section('content')

  <!--header section end-->
 <section class="pricing" id="about">
  <div class="pricing__wrapper">

        <div class="container">
          <h2 class="section-heading color-black"></h2>
          <p class="text-left" style="font-size: 30px"><h2 class="section-heading color-black">Why use Ziggle?</h2></p>
          <div class="row">
            <div class="col-lg-4">
              <div class="pricing__single pricing__single-1">
                {{-- <div class="icon">
                  <i class="fad fa-user-graduate"></i>
                </div> --}}
                <h4 style="padding-bottom: 10%">Made in India</h4>
                {{-- <h3>Rs 0.00</h3>
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
                </a> --}}
              </div>
            </div>
            <div class="col-lg-4">
              <div class="pricing__single pricing__single-2">
                {{-- <div class="icon">
                  <i class="fad fa-user-cowboy"></i>
                </div> --}}
                <h4 style="padding-bottom: 10%">Trusted online reselling app</h4>
                {{-- <h3>Rs 10.00</h3>
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
                </a> --}}
              </div>
            </div>
            <div class="col-lg-4">
              <div class="pricing__single pricing__single-3">
                {{-- <div class="icon">
                  <i class="fad fa-user-astronaut"></i>
                </div> --}}
                <h4 style="padding-bottom: 10%">Business with zero investment</h4>
                {{-- <h3>Rs 15.00</h3>
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
                </a> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  

  <!--client section start-->
  <section class="clients-sec" id="feedback">
    <div class="container">
      <h2 class="section-heading color-black">Our Trusted Team</h2>
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
  </section>
  <!--client section end-->
@endsection
  