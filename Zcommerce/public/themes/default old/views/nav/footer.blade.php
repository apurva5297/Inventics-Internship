<footer>
    <div class="footer">
        <div class="container">
            <div class="footer__inner">
                
                <div class="footer__content">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="footer__content-box">
                                <div class="footer__content-box-inner">
                                     @if(isset($shop))
                                    <div class="footer__content-box-logo">
                                        <a href="{{ url('/shop',$shop->slug) }}">
                                            <img src="{{ get_storage_file_url(optional($shop->logo)->path, 'full') }}" class="brand-logo" alt="Logo" title="Logo" style="max-width: 70%; margin-bottom: 10px;">
                                        </a>
                                    </div>
                                    <div class="footer__content-box-text">
                                        <p></p>
                                    </div>
                                    @else
                                    <div class="footer__content-box-logo">
                                        <a href="{{url('/')}}">
                                            <img src="{{ theme_asset_url('img/z commerce_logo.png')}}" class="brand-logo" alt="Logo" title="Logo" style="max-width: 70%; margin-bottom: 10px;">
                                        </a>
                                    </div>
                                    <div class="footer__content-box-text">
                                        <p></p>
                                    </div>
                                    @endif


                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2">
                            <div class="footer__content-box">
                                <div class="footer__content-box-inner">
                                    <div class="footer__content-box-title">
                                        
                                    </div>
                                    <div class="footer__content-box-links">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-8">
                            <div class="footer__content-box">
                                <div class="footer__content-box-inner">
                                    <div class="footer__content-box-title">
                                        <h3>Address</h3>
                                    </div>
                                    <div class="footer__content-box-links">
                                        <div class="footer__content-box-location">
                                        
<style type="text/css">
    address{
        color:#fff !important;
        float: left;
    }
</style>
                                        @if(isset($shop))
        <span style="color: #fff;"><i class="fas fa-map-marker-alt" style="float: left;"></i><span style="color: #fff">@if($shop->primaryAddress){!! $shop->primaryAddress->toHtml() !!}@endif</span></span>
        @elseif(Session::get('shop') != array(['','null']))
        <span style="color: #fff;"><i class="fas fa-map-marker-alt" style="float: left;"></i> @if(Session::get('shop')->primaryAddress){!! Session::get('shop')->primaryAddress->toHtml() !!}@endif</span></span>
        @else
        <p></p>
        @endif
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2">
                            <div class="footer__content-box">
                                <div class="footer__content-box-inner">
                                    <div class="footer__content-box-title">
                                        
                                    </div>
                                    <div class="footer__content-box-links">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="footer__content-box">
                                <div class="footer__content-box-inner">
                                    <div class="footer__content-box-title">
                                        <h3>Stay Connected</h3>
                                    </div>
                                                                            <div class="footer__content-box-social">
                                            <ul>
                                                                                                    <li>
                                                        <a href="https://www.facebook.com/" target="_blank">
                                                            <i class="fab fa-facebook"></i>
                                                        </a>
                                                    </li>
                                                                                                    <li>
                                                        <a href="https://twitter.com/" target="_blank">
                                                            <i class="fab fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                                                                    
                                                                                                    <li>
                                                        <a href="https://www.instagram.com/" target="_blank">
                                                            <i class="fab fa-instagram"></i>
                                                        </a>
                                                    </li>
                                                                                                    <li>
                                                        <a href="https://www.youtube.com/" target="_blank">
                                                            <i class="fab fa-youtube"></i>
                                                        </a>
                                                    </li>
                                                                                            </ul>
                                        </div>
                                                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>