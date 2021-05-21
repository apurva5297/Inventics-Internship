@extends('welcome.layouts.master')
@section('title')
{{ 'Thankyou | Kiddotrack'}}
@endsection
@section('content')
  <!--header section end-->
  <div id="thankyou">
  <section class="hero hero-2">
      <div class="hero__wrapper">
        <div class="container">
            <div class="row align-items-lg-center">
              <div class="col-lg-12 order-2 order-lg-1">
                  <h1 class="main-heading color-black">Thanking you!</h1>
                  <p class="paragraph">Dear {{ $data['name'] }}, Thank you for showing your interest in our services. <br> One of our representative will call you shortly.</p>
              </div>
            </div>
        </div>
      </div>
  </section>
  </div>
  @endsection