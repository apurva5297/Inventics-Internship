@extends('welcome.layouts.master')
@section('title')
{{ 'Contact us | ZIGGLE '}}
@endsection
@section('content')

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
  @endsection