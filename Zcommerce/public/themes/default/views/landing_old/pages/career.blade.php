@extends('landing.layout')

@section('content')
<section class="wow fadeIn parallax" data-stellar-background-ratio="0.5" style="background-image:url({{ theme_asset_url('landing/breadcrumbs_banners/banner_1920x1100___02.png')}});">
            <div class="opacity-medium bg-extra-dark-gray"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12 extra-small-screen page-title-large d-flex flex-column justify-content-center text-center">
                        <!-- start page title -->
                        <h1 class="text-white-2 alt-font font-weight-600 letter-spacing-minus-1 margin-15px-bottom">Career</h1>
                        <!-- end page title -->
                        <!-- start sub title -->
                        <!-- <span class="text-white-2 opacity6 alt-font">Unlimited power and customization possibilities</span> -->
                        <!-- end sub title -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title section -->
        <!-- start contact info -->
        <section class="wow fadeIn parallax">
            
            <div class="container">
                <div class="row">
                    <div class="col-12 extra-small-screen page-title-large d-flex flex-column justify-content-center text-center">
                        {!!$pages->content!!}
                    </div>
                </div>
            </div>
        </section>
    @endsection