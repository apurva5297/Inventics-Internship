<section>
    <div class="shell-banner">
        <div class="container">
            <div class="shell-banner__inner">
                <div class="row">
                    @foreach($banners as $banner)
                        <div class="col-md-6">
                            <div class="image-banner ">
                                <div class="shell-banner__box">
                                    <div class="shell-banner__img">
                                        <img src="{{ asset('image/' . $banner['featured_image']['path']) }}" alt="Knockout offers!" title="Knockout offers!">
                                    </div>
                                    <div class="shell-banner__overlay ">
                                        <div class="single-banner__texts  ">
                                            <div class="shell-banner__overlay-title">
                                                <h3>{{ $banner['title'] }}</h3>
                                            </div>
                                            <div class="shell-banner__overlay-text">
                                                <p>{{ $banner['description'] }}</p>
                                            </div>
                                        </div>
                                        <div class="neckbands__button">
                                            <a href="{{ $banner['link'] }}">{!! $banner['link_label'] ? $banner['link_label'] . ' <i class="fas fa-caret-right"></i>' : '' !!}</a>
                                        </div>
                                      
                                    </div>
                                </div>
                                <!-- <a href="#">
                                           <img src="images/ib-02.png" alt="">
                                       </a> -->
                            </div>
                        </div>
                    @endforeach                
                    </div>
            </div>
        </div>
    </div>
</section>