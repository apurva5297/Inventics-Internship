@extends('landing.layout')

@section('content')
        <!--  -->
        <section class="wow fadeIn cover-background background-position-top top-space"data-stellar-background-ratio="0.5" style="background-image:url({{ theme_asset_url('landing/breadcrumbs_banners/banner_1920x1100___13.png')}});">
            <div class="opacity-medium bg-extra-dark-gray"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12 page-title-large d-flex flex-column justify-content-center align-items-center text-center padding-30px-tb">
                        <!-- start sub title -->
                        <span class="d-block text-white-2 opacity6 width-45 md-width-100 alt-font margin-10px-bottom"></span>
                        <!-- end sub title -->
                        <!-- start page title -->
                        <h1 class="alt-font text-white-2 font-weight-600 mb-0">Blogs</h1>
                        <!-- end page title -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title section --> 
        @include('landing.element.blog_list',$blogs)
        <!-- end page title section --> 

@endsection
       