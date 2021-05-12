<!-- start slider section -->
        <section class="no-padding main-slider height-100 mobile-height wow fadeIn ">
            <div class="swiper-full-screen swiper-container height-100 width-100 black-move">
                <div class="swiper-wrapper">
                    @foreach($sliders as $slider)
                    <!-- start slider item -->
                    <div class="swiper-slide cover-background" style="background-image:url({{ get_storage_file_url($slider['featured_image']['path'], 'main_slider') }});">
                        <div class="container position-relative full-screen">
                            <div class="col-md-12 slider-typography text-center text-md-left">
                                <div class="slider-text-middle-main">
                                    <div class="slider-text-middle">
                                        <h4 class="alt-font text-extra-dark-gray font-weight-700 letter-spacing-minus-1 width-55 margin-35px-bottom lg-width-60 md-width-70 lg-line-height-auto sm-width-100 sm-margin-15px-bottom" style="color:{{$slider['title_color']}}">{{ $slider['title'] }}</h4>
                                        
                                        <form class="form" action="{{url('banner_email_form')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="email" name="email" placeholder="Enter your email address" class="form-control" style="border-radius: 0; padding:15px; color: #000; border-style: solid; border-width: 0.8px; height: 50px ">
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="padding-left: 0">
                                                    <div class="form-group">
                                                        <input type="submit" value="Submit" class="btn btn-lg btn-rounded" style="border-style: solid; border-color: #000; background-color: #fff; color: #000">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <p class="text-extra-dark-gray text-large margin-four-bottom width-40 lg-width-50 md-width-60 sm-width-100 sm-margin-15px-bottom" style="color:{{$slider['sub_title_color']}}">{{ $slider['sub_title'] }}</p>
                                        <div class="btn-dual"><!-- <a href="{{ $slider['link'] }}" target="_blank" class="btn btn-dark-gray btn-rounded btn-small no-margin-lr">Go To</a> --><!-- <a href="" target="_blank" class="btn btn-transparent-dark-gray btn-rounded btn-small margin-20px-lr sm-margin-5px-top">Download now</a> --></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end slider item -->
                    @endforeach
                    
                </div>
                <!-- start slider pagination -->
                <div class="swiper-pagination swiper-full-screen-pagination"></div>
                <div class="swiper-button-next swiper-button-black-highlight d-none"></div>
                <div class="swiper-button-prev swiper-button-black-highlight d-none"></div>
                <!-- end slider pagination -->
            </div>
        </section>
        <!-- end slider section --> 