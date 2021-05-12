@extends('landing.layout')

@section('content')
<section class="wow fadeIn parallax" data-stellar-background-ratio="0.5" style="background-image:url({{ theme_asset_url('landing/breadcrumbs_banners/banner_1920x1100___02.png')}});">
            <div class="opacity-medium bg-extra-dark-gray"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12 extra-small-screen page-title-large d-flex flex-column justify-content-center text-center">
                        <!-- start page title -->
                        <h1 class="text-white-2 alt-font font-weight-600 letter-spacing-minus-1 margin-15px-bottom">Contact Us</h1>
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
        <section class="wow fadeIn">
            <div class="container px-0">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6 col-md-8 margin-eight-bottom md-margin-40px-bottom sm-margin-30px-bottom text-center last-paragraph-no-margin">
                        <h5 class="alt-font font-weight-700 text-extra-dark-gray text-uppercase mb-0">We love to talk</h5>
                    </div>  
                </div>
                <div class="row">
                    <!-- start contact info item -->
                    <div class="col-12 col-lg-3 col-md-6 text-center md-margin-eight-bottom sm-margin-30px-bottom wow fadeInUp last-paragraph-no-margin">
                        <div class="d-inline-block margin-20px-bottom">
                            <div class="bg-extra-dark-gray icon-round-medium"><i class="icon-map-pin icon-medium text-white-2"></i></div>
                        </div>
                        <div class="text-extra-dark-gray text-uppercase text-small font-weight-600 alt-font margin-5px-bottom">Visit Our Office</div>
                        <p class="mx-auto">SVVS Tower, Opposite reddy school, Hosur Road, NGR Layout, Roopena Agrahara,Bommanahalli, Bengaluru, Karnataka 560068</p>
                        <!-- <a href="#" class="text-decoration-line-through-deep-pink text-uppercase text-deep-pink text-small margin-15px-top sm-margin-10px-top d-inline-block">GET DIRECTION</a> -->
                    </div>
                    <!-- end contact info item -->
                    <!-- start contact info item -->
                    <div class="col-12 col-lg-3 col-md-6 text-center md-margin-eight-bottom sm-margin-30px-bottom wow fadeInUp last-paragraph-no-margin" data-wow-delay="0.2s">
                        <div class="d-inline-block margin-20px-bottom">
                            <div class="bg-extra-dark-gray icon-round-medium"><i class="icon-chat icon-medium text-white-2"></i></div>
                        </div>
                        <div class="text-extra-dark-gray text-uppercase text-small font-weight-600 alt-font margin-5px-bottom">Let's Talk</div>
                        <p class="mx-auto">Phone: 8299886767<br></p>
                        <!-- <a href="#" class="text-decoration-line-through-deep-pink text-uppercase text-deep-pink text-small margin-15px-top sm-margin-10px-top d-inline-block">call us</a> -->
                    </div>
                    <!-- end contact info item -->
                    <!-- start contact info item -->
                    <div class="col-12 col-lg-3 col-md-6 text-center sm-margin-30px-bottom wow fadeInUp last-paragraph-no-margin" data-wow-delay="0.4s">
                        <div class="d-inline-block margin-20px-bottom">
                            <div class="bg-extra-dark-gray icon-round-medium"><i class="icon-envelope icon-medium text-white-2"></i></div>
                        </div>
                        <div class="text-extra-dark-gray text-uppercase text-small font-weight-600 alt-font margin-5px-bottom">E-mail Us</div>
                        <p class="mx-auto"><a href="mailto:contact@zcommerce.online">contact@zcommerce.online</a><br><!-- <a href="mailto:hr@yourdomain.com">hr@yourdomain.com</a> --></p>
                        <!-- <a href="#" class="text-decoration-line-through-deep-pink text-uppercase text-deep-pink text-small margin-15px-top sm-margin-10px-top d-inline-block">send e-mail</a> -->
                    </div>
                    <!-- end contact info item -->
                    <!-- start contact info item -->
                    <div class="col-12 col-lg-3 col-md-6 text-center wow fadeInUp last-paragraph-no-margin" data-wow-delay="0.6s">
                        <div class="d-inline-block margin-20px-bottom">
                            <div class="bg-extra-dark-gray icon-round-medium"><i class="icon-megaphone icon-medium text-white-2"></i></div>
                        </div>
                        <div class="text-extra-dark-gray text-uppercase text-small font-weight-600 alt-font margin-5px-bottom">Customer Services</div>
                        <p class="mx-auto">Contact our customer service executive in case of any query.</p>
                        <!-- <a href="#" class="text-decoration-line-through-deep-pink text-uppercase text-deep-pink text-small margin-15px-top sm-margin-10px-top d-inline-block">open ticket</a> -->
                    </div>
                    <!-- end contact info item -->
                </div>
            </div>
        </section>
        <!-- end contact info section -->
        <!-- start contact form -->
        @include('landing.element.contact_form')
        <!-- end contact form -->
        <!-- start map section -->
        <section class="p-0 one-second-screen md-height-400px wow fadeIn">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d62231.02660301897!2d77.61449376462558!3d12.879458413093564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sSVVS%20Tower%2C%20Opposite%20reddy%20school%2C%20Hosur%20Road%2C%20NGR%20Layout%2C%20Roopena%20Agrahara%2CBommanahalli%2C%20Bengaluru%2C%20Karnataka%20560068!5e0!3m2!1sen!2sin!4v1612957575653!5m2!1sen!2sin" class="w-100 h-100" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            <!-- <iframe class="w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.843821917424!2d144.956054!3d-37.817127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sin!4v1427947693651"></iframe> -->
        </section>
        <!-- end map section -->
        <!-- start social section -->
        <section class="wow fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center social-style-1 social-icon-style-5">
                        <ul class="large-icon mb-0">
                            <li><a class="facebook" href="http://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i><span></span></a></li>
                            <li><a class="twitter" href="http://twitter.com" target="_blank"><i class="fab fa-twitter"></i><span></span></a></li>
                            <li><a class="google" href="http://google.com" target="_blank"><i class="fab fa-google-plus-g"></i><span></span></a></li>
                            <li><a class="dribbble" href="http://dribbble.com" target="_blank"><i class="fab fa-dribbble"></i><span></span></a></li>
                            <li><a class="linkedin" href="http://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i><span></span></a></li>
                        </ul>
                    </div>                   
                </div>
            </div>
        </section>
    @endsection