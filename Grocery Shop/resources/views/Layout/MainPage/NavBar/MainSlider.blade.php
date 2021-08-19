<!-- Main Slider -->

<div class="holder mt-0 fullwidth full-nopad">
    <div class="container">
        <div class="bnslider-wrapper">
            <div class="bnslider bnslider--lg keep-scale" id="bnslider-01" data-start-width='' data-start-height='' data-start-mwidth='1200' data-start-mheight='560'>
                @foreach($banners as $banner)
                <div class="bnslider-slide">
                    <div class="bnslider-image-mobile lazyload fade-up-fast" data-bgset="http://dev.gudgrocery.com/image/{{$banner->path}}"></div>
                    <div style="width: 100%" class="bnslider-image lazyload fade-up-fast" data-bgset="http://dev.gudgrocery.com/image/{{$banner->path}}"></div>
                    <div class="bnslider-text-wrap bnslider-overlay">
                        <div class="bnslider-text-content txt-middle txt-right txt-middle-m txt-right-m">
                            <div class="bnslider-text-content-flex ">
                                {{-- <div class="bnslider-vert w-s-40 w-ms-50" style="padding: 0px">
                                    <div class="bnslider-text order-1 mt-0 bnslider-text--lg text-left heading-font" data-animation="fadeInUp" data-animation-delay="800" data-fontcolor="#000000" data-fontweight="300" data-fontline="1.25" data-otherstyle="">
                                        Pomegrante</div>
                                    <div class="bnslider-text order-2 mt-0 bnslider-text--lg text-left heading-font d-none d-md-block" data-animation="fadeInUp" data-animation-delay="1000" data-fontcolor="#000000" data-fontweight="300" data-fontline="1.25"
                                         data-otherstyle="">Vegetables 100%</div>
                                    <div class="bnslider-text order-3 mt-0 bnslider-text--lg text-left heading-font" data-animation="fadeInUp" data-animation-delay="1500" data-fontcolor="#000000" data-fontweight="300" data-fontline="1.25" data-otherstyle="">
                                        Organic</div>
                                    <div class="btn-wrap text-left  order-4 mt-lg" data-animation="fadeIn" data-animation-delay="3000">
                                        <a href="#buynow" target="_self" class="btn">Shop now</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- //Main Slider -->
