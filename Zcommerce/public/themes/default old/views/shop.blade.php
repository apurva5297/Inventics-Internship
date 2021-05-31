@extends('layouts.main')

@section('content')
    <!-- SHOP COVER IMAGE -->
    @include('banners.shop_cover', ['shop' => $shop])
    
            @include('sliders.carousel_with_feedback', ['products' => $trending])


    <!-- PRODUCTS -->
    @include('contents.shop_products')

    <!-- CONTENT SECTION -->
    {{--@include('contents.shop_page')--}}

    <!-- BROWSING ITEMS -->
    @include('sliders.browsing_items')

    <!-- MODALS -->
    @include('modals.shopReviews')
@endsection