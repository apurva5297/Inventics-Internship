@extends('welcome.layouts.master')

@section('content')

<div id="home">
      <br>
    <section class="hero hero-2">
        <div class="hero__wrapper">
        <div class="container">
            <div class="row align-items-lg-center">
            <div class="col-lg-6 order-2 order-lg-1">
                <h1 class="main-heading color-black">Kiddotrack Is Just What Schools and Parents need</h1>
                <p class="paragraph">Kiddotrack helps schools and parents to track the school bus and receive important notifications on their mobile phone. It is an innovative school bus tracker without installing GPS devices! A cost effective solution that has ready Web and Mobile Apps for your school and parents.</p>
                <div class="download-buttons">
                <a href="#" class="google-play">
                  <i class="fab fa-google-play"></i>
                  <div class="button-content">
                    <h6>Google Play <span>Driver App</span></h6>
                  </div>
                </a>
                <a href="#" class="apple-store">
                  <i class="fab fa-google-play"></i>
                  <div class="button-content">
                    <h6>Google Play <span>Parent App</span></h6>
                  </div>
                </a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="questions-img hero-img">
                <img src="assets/images/banner.png" alt="image">
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
  </div>
  @endsection