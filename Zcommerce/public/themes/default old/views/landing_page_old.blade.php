<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Alexstrap Saas - HTML5 Bootstrap Landing Page Template" />
        <meta name="viewport" content="minimum-scale=1,initial-scale=1,width=device-width,shrink-to-fit=no" />
        <!-- Favicon-->
        <link rel="shortcut icon" href="../assets/favicons/favicon.ico" />
        <link rel="apple-touch-icon" sizes="57x57" href="../assets/favicons/apple-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="60x60" href="../assets/favicons/apple-icon-60x60.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="../assets/favicons/apple-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/favicons/apple-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="../assets/favicons/apple-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="../assets/favicons/apple-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="../assets/favicons/apple-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="../assets/favicons/apple-icon-152x152.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicons/apple-icon-180x180.png" />
        <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicons/android-icon-192x192.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicons/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="96x96" href="../assets/favicons/favicon-96x96.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicons/favicon-16x16.png" />
        <link rel="manifest" href="../assets/favicons/manifest.json" />
        <meta name="msapplication-TileColor" content="#ffffff" />
        <meta name="msapplication-TileImage" content="../assets/favicons/ms-icon-144x144.png" />
        <!-- PWA primary color-->
        <meta name="theme-color" content="#9C27B0" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
        <!-- Facebook-->
        <meta property="author" content="luxi" />
        <meta property="og:site_name" content="alexstrap.ux-maestro.com" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <!-- Twitter-->
        <meta property="twitter:site" content="luxi.ux-maestro.com" />
        <meta property="twitter:domain" content="luxi.ux-maestro.com" />
        <meta property="twitter:creator" content="luxi" />
        <meta property="twitter:card" content="summary" />
        <meta property="twitter:image:src" content="../assets/images/logo.png" />
        <meta property="og:url" content="alexstrap.ux-maestro.com/saas" />
        <meta property="og:title" content="Software" />
        <meta property="og:description" content="Alexstrap Saas - HTML5 Bootstrap Landing Page Template" />
        <meta name="twitter:site" content="alexstrap.ux-maestro.com/saas" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:image" content="/images/saas-logo.png" />
        <meta property="og:image" content="/images/saas-logo.png" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <title>Z-Commerce</title>
        <!-- Styles-->
        <link href="{{ theme_asset_url('landing/css/side-right.css')}}" rel="stylesheet" />
        <link href="{{ theme_asset_url('landing/css/saas-bundle.min.css')}}" rel="stylesheet" />
    </head>
    <body>
        <!-- <div id="preloader" style="position: fixed; z-index: 10000; background: #fafafa; width: 100%; height: 100%;">
            <img style="opacity: 0.5; position: fixed; top: calc(50% - 50px); left: calc(50% - 50px);" src="../assets/images/loading.gif" alt="loading" />
        </div> -->
        <div class="m-application theme--light transition-page" id="app">
            <div class="loading"></div>
            <div class="m-content violeta violeta-var" id="main-wrap">
                
                <div>
                    <div id="home"></div>
                    <div class="main-wrap">
                        <div class="sidenav mobile-nav" id="slide-menu">
                            <div class="menu">
                                <ul class="collection">
                                    <li class="collection-item" style="animation-duration: 0.25s;"><a class="sidenav-close waves-effect menu-list" href="#feature">feature</a></li>
                                    <li class="collection-item" style="animation-duration: 0.5s;"><a class="sidenav-close waves-effect menu-list" href="#testimonials">testimonials</a></li>
                                    <li class="collection-item" style="animation-duration: 0.75s;"><a class="sidenav-close waves-effect menu-list" href="#pricing">pricing and plan</a></li>
                                    <li class="collection-item" style="animation-duration: 1s;"><a class="sidenav-close waves-effect menu-list" href="#faq">faq</a></li>
                                    <li class="collection-item" style="animation-duration: 1s;"><a class="waves-effect menu-list" href="{{url('page/contact-us')}}">contact</a></li>
                                </ul>
                                <hr class="divider-sidebar" />
                                <ul class="collection">
                                    <li class="collection-item" style="animation-duration: 1s;"><a class="sidenav-close waves-effect menu-list" href="login.html">log in</a></li>
                                    <li class="collection-item" style="animation-duration: 1s;"><a class="sidenav-close waves-effect menu-list" href="register.html">register</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- ##### HEADER #####-->
                        <header class="app-bar header" id="header">
                            <div class="container fixed-width-lg-up">
                                <div class="header-content">
                                    <nav class="nav-logo nav-menu">
                                        <button class="mobile-menu btn-icon waves-effect hamburger hamburger--spin show-md-down" id="mobile_menu" type="button">
                                            <span class="hamburger-box"><span class="bar hamburger-inner"></span></span>
                                        </button>
                                        <div class="logo scrollnav current"><a href="#banner"><img src="{{ theme_asset_url('img/z commerce_icon.png')}}" alt="logo"><span>Z-Commerce</span></a></div>
                                        <div>
                                            <div class="scrollactive-nav show-lg-up scrollnav">
                                                <ul>
                                                    <li class="d-none"><a href="#banner"></a></li>
                                                    <li><a class="btn btn-flat anchor-link waves-effect" href="#feature">feature</a></li>
                                                    <li><a class="btn btn-flat anchor-link waves-effect" href="#testimonials">testimonials</a></li>
                                                    <li><a class="btn btn-flat anchor-link waves-effect" href="#pricing">pricing and plan</a></li>
                                                    <li><a class="btn btn-flat anchor-link waves-effect" href="#faq">faq</a></li>
                                                    <li><a class="btn btn-flat anchor-link waves-effect" href="{{url('page/contact-us')}}">contact</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </nav>
                                    <nav class="nav-menu">
                                        <div class="hidden-xs-down"><a class="btn btn-flat text-btn waves-effect" href="http://128.199.22.53/login">log in</a> <a class="btn secondary button waves-effect" href="http://128.199.22.53/register">register</a></div>
                                    </nav>
                                </div>
                            </div>

                        </header>
                        <!-- ##### END HEADER #####-->
                        <main class="container-wrap">
                            <!-- ##### BANNER #####-->
                            <section id="banner" style="background-image: url({{ theme_asset_url('landing/img/vector_01.png')}})">
                                <div class="root">
                                    <div class="modal video-popup" id="video_modal">
                                        <div class="modal-content">
                                            <h4>Amazing company deserve</h4>
                                            <button class="btn-icon modal-close waves-effect"><i class="material-icons">close</i></button>
                                            <div class="text-center"><div id="video_iframe"></div></div>
                                        </div>
                                    </div>
                                    <div class="decoration">
                                        <svg class="left-deco" width="1045px" height="1468px" viewBox="0 0 1045 1468" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g transform="translate(-1030.000000, 0.000000)">
                                                <g transform="translate(950.000000, 0.000000)">
                                                    <path
                                                        d="M0,0 L805.395445,0 C731.131815,0 740.666667,76.9414646 834,230.824394 C915.57424,365.319569 1045,513.536468 1045,652.024982 C1045,806.30828 951.877684,902.632061 904.5,1091.56209 C874.07902,1212.87314 909.795583,1338.35244 1011.64969,1468 L0,1468 L0,0 Z"
                                                    ></path>
                                                </g>
                                            </g>
                                        </svg>
                                        <svg class="right-deco" width="389px" height="1468px" viewBox="0 0 389 1468" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g transform="translate(-2171.000000, 0.000000)">
                                                <g transform="translate(-950.000000, 0.000000)">
                                                    <g transform="translate(950.000000, 0.000000)">
                                                        <path
                                                            d="M2329.58044,-732.909805 L3294.66463,-608.836163 C3018.10652,-208.944402 2934.07929,71.8618948 3042.58292,233.582726 C3136.98689,374.288498 3255.13325,471.945016 3255.13325,636.668858 C3255.13325,820.179655 3107.51302,903.798038 3059.64228,1128.51906 C3028.9047,1272.81133 3063.63816,1429.66837 3163.84265,1599.0902 L2141.66463,1599.0902 L2329.58044,-732.909805 Z"
                                                            transform="translate(2718.164626, 433.090195) rotate(179.000000) translate(-2718.164626, -433.090195) "
                                                        ></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="container fixed-width-lg-up">
                                        <div class="slider-wrap">
                                            <div class="text">
                                                <h3 class="use-text-title">Amazing company deserve<strong>&nbsp; amazing software</strong></h3>
                                                <p class="use-text-subtitle">Millions of happy users work better with our integrated Apps.</p>
                                                <div class="btn-area">
                                                    <button class="btn btn-flat play-btn waves-effect modal-trigger" data-target="video_modal">
                                                        <span class="icon"><i class="ion-ios-play-outline">Watch Video</i></span>Watch Video
                                                    </button>
                                                    <a class="btn secondary waves-effect" href="login.html">Get Started</a>
                                                </div>
                                            </div>
                                            <div class="illustration"><img src="{{ theme_asset_url('landing/img/vector_02.png')}}" alt="illustration" /></div>
                                        </div>
                                    </div>
                                    <div class="deco">
                                        <div class="hidden-md-down">
                                            <div class="deco-inner">
                                                <div class="wave wave-one"></div>
                                                <div class="wave wave-two"></div>
                                            </div>
                                        </div>
                                        <div class="wave wave-cover"></div>
                                    </div>
                                </div>
                            </section>
                            <!-- ##### END BANNER #####-->
                            <!-- ##### LOGO LIST #####-->
                            <section id="logo_list">
                                <div class="fixed-width">
                                    <div class="root">
                                        
                                            <img src="{{ theme_asset_url('landing/img/amazon.png')}}" alt="logo0" /> 
                                            <!-- <img src="{{ theme_asset_url('landing/img/ebay.png')}}" alt="logo1" />  -->
                                            <img src="{{ theme_asset_url('landing/img/flipkart.png')}}" alt="logo2" />
                                            <img src="{{ theme_asset_url('landing/img/myntra.png')}}" alt="logo3" /> <!-- <img src="{{ theme_asset_url('landing/img/shopclues.png')}}" alt="logo4" />  -->
                                            <img src="{{ theme_asset_url('landing/img/snapdeal.png')}}" alt="logo5" />
                                        
                                    </div>
                                </div>
                            </section>
                            <!-- ##### END LOGO LIST #####-->
                            <!-- ##### COUNTER #####-->
                            <section class="space-top-short">
                                <div class="counter-wrap">
                                    <div class="container">
                                        <div class="row counter-inner spacing6 justify-content-center align-items-center">
                                            <div class="col-sm-4 pa-6">
                                                <div class="counter-item">
                                                    <div class="text">
                                                        <h3 class="use-text-title2"><span class="numscroller" data-min="0" data-max="12" data-delay="5" data-increment="8"></span>&nbsp; Month</h3>
                                                        <p class="use-text-subtitle"><i class="material-icons">reply</i>Free Trial</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 pa-6">
                                                <div class="counter-item">
                                                    <div class="text">
                                                        <h3 class="use-text-title2">+<span class="numscroller" data-min="0" data-max="80" data-delay="5" data-increment="8"></span>M</h3>
                                                        <p class="use-text-subtitle"><i class="material-icons">people</i>Active Users</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 pa-6">
                                                <div class="counter-item">
                                                    <div class="text">
                                                        <h3 class="use-text-title2">+<span class="numscroller" data-min="0" data-max="180" data-delay="5" data-increment="8"></span>K</h3>
                                                        <p class="use-text-subtitle"><i class="material-icons">layers</i>Providers</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- ##### END COUNTER #####--><!-- ##### FEATURE #####-->
                            <section class="space-top-feature" id="feature">
                                <div class="root">
                                    <div class="decoration">
                                        <svg class="wave" width="1281px" height="1569px" viewBox="0 0 1281 1569" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g>
                                                <path
                                                    d="M19.7665077,0.586224095 C173.454777,201.024442 338.39951,280.899446 514.600709,240.211239 C778.902507,179.178928 866.477805,607.756375 1041.85353,607.756375 C1158.77068,607.756375 1238.15284,586.837583 1280,545 L1274.18697,1225.96189 C1301.0524,1360.78849 1240.86783,1469.11522 1093.63327,1550.94205 C872.781425,1673.68231 547.694716,1115.83347 356.559941,1115.83347 C229.136757,1115.83347 110.418573,1186.39974 0.405387931,1327.53227 L19.7665077,0.586224095 Z"
                                                ></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="container fixed-width-lg-up" id="feature_parallax">
                                        <div class="item">
                                            <div class="row">
                                                <div class="col-md-6 order-md-last">
                                                    <div class="wow fadeInLeftShort" data-wow-duration="0.4s" data-wow-delay="0.2s" data-wow-offset="-100">
                                                        <div class="desc">
                                                            <div class="title-main align-left">
                                                                <h4>
                                                                    <span>Act on it-all <strong>in one dashboard</strong></span>
                                                                </h4>
                                                            </div>
                                                            <h6 class="use-text-subtitle2 text-center text-lg-start">
                                                                Our audience dashboard shows you pre-built segments like top locations, recent sources of growth, and even customer lifetime value (CLV).
                                                            </h6>
                                                            <a class="btn primary btn-large waves-effect" href="#">See Detail</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 order-md-first">
                                                    <div class="illustration-left">
                                                        <div class="d-lg-none">
                                                            <div class="parallax-screen">
                                                                <div class="viewport">
                                                                    <figure class="figure screen"><img src="{{ theme_asset_url('landing/img/vector_01.png')}}" alt="screen" /></figure>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-none d-lg-block">
                                                            <div class="parallax-screen">
                                                                <div data-enllax-ratio="0.1" data-enllax-type="foreground">
                                                                    <div class="viewport">
                                                                        <figure class="figure screen"><img src="{{ theme_asset_url('landing/img/vector_01.png')}}" alt="screen" /></figure>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="parallax-screen">
                                                                <div data-enllax-ratio="-0.05" data-enllax-type="foreground">
                                                                    <div class="viewport">
                                                                        <figure class="figure graphic"><img src="https://res.cloudinary.com/imajin/image/upload/v1571261871/saas/app-chart_exua6w.jpg" alt="illustration" /></figure>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                        <div class="parallax-wrap">
                                                            <div class="inner-parallax medium">
                                                                <div data-enllax-ratio="0.3" data-enllax-type="foreground">
                                                                    <div class="parallax-figure">
                                                                        <div>
                                                                            <svg class="plus" width="94px" height="94px" viewBox="0 0 94 94" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <g transform="translate(-1453.000000, -4277.000000)" fill="#ECA426" fill-rule="nonzero">
                                                                                        <g transform="translate(-97.000000, 2613.000000)">
                                                                                            <g transform="translate(0.000000, 63.000000)">
                                                                                                <g transform="translate(1505.000000, 1601.000000)">
                                                                                                    <polygon
                                                                                                        points="81.6344411 57.5915493 45 57.5915493 45 36.8812877 81.6344411 36.8812877 81.6344411 0 102.365559 0 102.365559 36.8812877 139 36.8812877 139 57.5915493 102.365559 57.5915493 102.365559 94 81.6344411 94"
                                                                                                    ></polygon>
                                                                                                </g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div data-enllax-ratio="0.2" data-enllax-type="foreground">
                                                                    <div class="parallax-figure">
                                                                        <div>
                                                                            <svg class="circle" width="117px" height="117px" viewBox="0 0 117 117" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <g transform="translate(-2409.000000, -4290.000000)" stroke="#8BC34A" stroke-width="21">
                                                                                        <g transform="translate(-97.000000, 2613.000000)">
                                                                                            <g transform="translate(0.000000, 63.000000)">
                                                                                                <g transform="translate(1505.000000, 1601.000000)"><circle cx="1059.5" cy="71.5" r="47.5"></circle></g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div data-enllax-ratio="0.15" data-enllax-type="foreground">
                                                                    <div class="parallax-figure">
                                                                        <div>
                                                                            <svg class="zigzag" width="219px" height="64px" viewBox="0 0 219 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linejoin="round">
                                                                                    <g transform="translate(-1408.000000, -4943.000000)" stroke="#9C27B0" stroke-width="16">
                                                                                        <g transform="translate(-97.000000, 2613.000000)">
                                                                                            <g transform="translate(0.000000, 63.000000)">
                                                                                                <g transform="translate(1505.000000, 1601.000000)">
                                                                                                    <path
                                                                                                        d="M0,719.909 L22.07,719.909 C38.842,719.909 38.842,675.54 55.613,675.54 C72.381,675.54 72.381,721.548 89.148,721.548 C105.916,721.548 105.916,676.359 122.684,676.359 C139.455,676.359 139.455,720.64 156.227,720.64 C173.008,720.64 173.008,674 189.782,674 L219,674"
                                                                                                    ></path>
                                                                                                </g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="wow fadeInRightShort" data-wow-duration="0.4s" data-wow-delay="0.5s" data-wow-offset="-100">
                                                        <div class="desc">
                                                            <div class="title-main align-right">
                                                                <h4>
                                                                    <span>Act on it-all <strong>unique value proposition</strong></span>
                                                                </h4>
                                                            </div>
                                                            <h6 class="use-text-subtitle2 text-right">With strong technical foundations, has allowed us to leverage business experts to build hundreds of improvements.</h6>
                                                            <div class="text-center text-lg-right"><a class="btn primary btn-large waves-effect" href="#">See Detail</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="illustration-right">
                                                        <div class="d-lg-none">
                                                            <div class="parallax-screen">
                                                                <div class="viewport">
                                                                    <figure class="figure screen"><img src="https://res.cloudinary.com/imajin/image/upload/v1571261793/saas/app-screen2_rt1jqc.jpg" alt="screen" /></figure>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-none d-lg-block">
                                                            <div class="parallax-screen">
                                                                <div data-enllax-ratio="0.1" data-enllax-type="foreground">
                                                                    <div class="viewport">
                                                                        <figure class="figure screen"><img src="{{ theme_asset_url('landing/img/vector_03.png')}}" alt="screen" /></figure>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="parallax-screen">
                                                                <div data-enllax-ratio="-0.05" data-enllax-type="foreground">
                                                                    <div class="viewport">
                                                                        <figure class="graphic"><img src="{{ theme_asset_url('landing/img/vector_03_a.png')}}" alt="illustration" /></figure>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="parallax-wrap">
                                                            <div class="inner-parallax medium">
                                                                <div data-enllax-ratio="0.3" data-enllax-type="foreground">
                                                                    <div class="parallax-figure">
                                                                        <div>
                                                                            <svg class="plus" width="94px" height="94px" viewBox="0 0 94 94" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <g transform="translate(-1453.000000, -4277.000000)" fill="#ECA426" fill-rule="nonzero">
                                                                                        <g transform="translate(-97.000000, 2613.000000)">
                                                                                            <g transform="translate(0.000000, 63.000000)">
                                                                                                <g transform="translate(1505.000000, 1601.000000)">
                                                                                                    <polygon
                                                                                                        points="81.6344411 57.5915493 45 57.5915493 45 36.8812877 81.6344411 36.8812877 81.6344411 0 102.365559 0 102.365559 36.8812877 139 36.8812877 139 57.5915493 102.365559 57.5915493 102.365559 94 81.6344411 94"
                                                                                                    ></polygon>
                                                                                                </g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div data-enllax-ratio="0.2" data-enllax-type="foreground">
                                                                    <div class="parallax-figure">
                                                                        <div>
                                                                            <svg class="circle" width="117px" height="117px" viewBox="0 0 117 117" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <g transform="translate(-2409.000000, -4290.000000)" stroke="#8BC34A" stroke-width="21">
                                                                                        <g transform="translate(-97.000000, 2613.000000)">
                                                                                            <g transform="translate(0.000000, 63.000000)">
                                                                                                <g transform="translate(1505.000000, 1601.000000)"><circle cx="1059.5" cy="71.5" r="47.5"></circle></g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div data-enllax-ratio="0.15" data-enllax-type="foreground">
                                                                    <div class="parallax-figure">
                                                                        <div>
                                                                            <svg class="zigzag" width="219px" height="64px" viewBox="0 0 219 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linejoin="round">
                                                                                    <g transform="translate(-1408.000000, -4943.000000)" stroke="#9C27B0" stroke-width="16">
                                                                                        <g transform="translate(-97.000000, 2613.000000)">
                                                                                            <g transform="translate(0.000000, 63.000000)">
                                                                                                <g transform="translate(1505.000000, 1601.000000)">
                                                                                                    <path
                                                                                                        d="M0,719.909 L22.07,719.909 C38.842,719.909 38.842,675.54 55.613,675.54 C72.381,675.54 72.381,721.548 89.148,721.548 C105.916,721.548 105.916,676.359 122.684,676.359 C139.455,676.359 139.455,720.64 156.227,720.64 C173.008,720.64 173.008,674 189.782,674 L219,674"
                                                                                                    ></path>
                                                                                                </g>
                                                                                            </g>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item last">
                                            <div class="title-main align-center">
                                                <h4>
                                                    <span>Accelerating to Intelligent <strong>Enterprise</strong></span>
                                                </h4>
                                            </div>
                                            <div class="tab">
                                                <div class="row spacing6 justify-content-center">
                                                    <div class="col-md-1 pa-6 d-sm-none"></div>
                                                    <div class="col-md-10 pa-6">
                                                        <ul class="tabs primary">
                                                            <li class="tab"><a class="tab-label active waves-effect" href="#tab-1">Pellentesque</a></li>
                                                            <li class="tab"><a class="tab-label waves-effect" href="#tab-2">Donec</a></li>
                                                            <li class="tab"><a class="tab-label waves-effect" href="#tab-3">Vestibulum</a></li>
                                                        </ul>
                                                        <div class="tab-item" id="tab-1">
                                                            <div class="tab-content">
                                                                <section>
                                                                    <h6 class="text-center use-text-subtitle2">
                                                                        We empowers your marketing, sales and services teams to collaborate across the entire customer lifecycle for more meaningful, memorable experiences.
                                                                    </h6>
                                                                    <div class="illustration-center">
                                                                        <figure class="figure screen"><img src="{{ theme_asset_url('landing/img/vector_04.png')}}" alt="screen" /></figure>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                        </div>
                                                        <div class="tab-item" id="tab-2">
                                                            <div class="tab-content">
                                                                <section>
                                                                    <h6 class="text-center use-text-subtitle2">
                                                                        We empowers your marketing, sales and services teams to collaborate across the entire customer lifecycle for more meaningful, memorable experiences.
                                                                    </h6>
                                                                    <div class="illustration-center">
                                                                        <figure class="figure screen"><img src="{{ theme_asset_url('landing/img/vector_05.png')}}" alt="screen" /></figure>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                        </div>
                                                        <div class="tab-item" id="tab-3">
                                                            <div class="tab-content">
                                                                <section>
                                                                    <h6 class="text-center use-text-subtitle2">
                                                                        We empowers your marketing, sales and services teams to collaborate across the entire customer lifecycle for more meaningful, memorable experiences.
                                                                    </h6>
                                                                    <div class="illustration-center">
                                                                        <figure class="figure screen"><img src="{{ theme_asset_url('landing/img/vector_06.png')}}" alt="screen" /></figure>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="parallax-wrap dots-wrap">
                                                    <div class="inner-parallax large">
                                                        <div data-enllax-ratio="0.3" data-enllax-type="foreground">
                                                            <div class="parallax-figure">
                                                                <div>
                                                                    <svg class="plus" width="94px" height="94px" viewBox="0 0 94 94" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <g transform="translate(-1453.000000, -4277.000000)" fill="#ECA426" fill-rule="nonzero">
                                                                                <g transform="translate(-97.000000, 2613.000000)">
                                                                                    <g transform="translate(0.000000, 63.000000)">
                                                                                        <g transform="translate(1505.000000, 1601.000000)">
                                                                                            <polygon
                                                                                                points="81.6344411 57.5915493 45 57.5915493 45 36.8812877 81.6344411 36.8812877 81.6344411 0 102.365559 0 102.365559 36.8812877 139 36.8812877 139 57.5915493 102.365559 57.5915493 102.365559 94 81.6344411 94"
                                                                                            ></polygon>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div data-enllax-ratio="0.2" data-enllax-type="foreground">
                                                            <div class="parallax-figure">
                                                                <div>
                                                                    <svg class="circle" width="117px" height="117px" viewBox="0 0 117 117" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <g transform="translate(-2409.000000, -4290.000000)" stroke="#8BC34A" stroke-width="21">
                                                                                <g transform="translate(-97.000000, 2613.000000)">
                                                                                    <g transform="translate(0.000000, 63.000000)">
                                                                                        <g transform="translate(1505.000000, 1601.000000)"><circle cx="1059.5" cy="71.5" r="47.5"></circle></g>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div data-enllax-ratio="0.15" data-enllax-type="foreground">
                                                            <div class="parallax-figure">
                                                                <div>
                                                                    <svg class="zigzag" width="219px" height="64px" viewBox="0 0 219 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linejoin="round">
                                                                            <g transform="translate(-1408.000000, -4943.000000)" stroke="#9C27B0" stroke-width="16">
                                                                                <g transform="translate(-97.000000, 2613.000000)">
                                                                                    <g transform="translate(0.000000, 63.000000)">
                                                                                        <g transform="translate(1505.000000, 1601.000000)">
                                                                                            <path
                                                                                                d="M0,719.909 L22.07,719.909 C38.842,719.909 38.842,675.54 55.613,675.54 C72.381,675.54 72.381,721.548 89.148,721.548 C105.916,721.548 105.916,676.359 122.684,676.359 C139.455,676.359 139.455,720.64 156.227,720.64 C173.008,720.64 173.008,674 189.782,674 L219,674"
                                                                                            ></path>
                                                                                        </g>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- ##### END FEATURE #####--><!-- ##### TESTIMONIAL #####-->
                            <section class="space-bottom-testi" id="testimonials">
                                <div class="root">
                                    <div class="container fixed-width-lg-up">
                                        <div class="row spacing6">
                                            <div class="col-md-7 px-6">
                                                <div class="slider-wrap">
                                                    <div class="hidden-sm-down">
                                                        <div class="decoration">
                                                            <svg width="900px" height="618px" viewbox="0 0 900 618" version="1.1">
                                                                <defs>
                                                                    <lineargradient id="linearGradient-1" x1="78.2441494%" y1="65.8737759%" x2="10.5892887%" y2="33.8596367%">
                                                                        <stop stop-color="#6A1B9A" offset="0%"></stop>
                                                                        <stop stop-color="#9C27B0" offset="100%"></stop>
                                                                    </lineargradient>
                                                                </defs>
                                                                <g stroke="none" stroke-width="0" fill="none" fill-rule="evenodd">
                                                                    <path
                                                                        d="M442.972909,617.331576 C569.290851,617.331576 618.618612,525.937324 804.142458,549.304771 C989.666303,572.672218 872.7227,109.743835 732.652282,54.307977 C592.581863,-1.12788075 538.308155,61.549598 304.148084,8.36113994 C69.9880137,-44.8273182 0,167.6782 0,308.489881 C0,450.379879 177.014996,617.331576 442.972909,617.331576 Z"
                                                                        fill="url(#linearGradient-1)"
                                                                    ></path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <h3 class="testi-title use-text-title2 text-center text-lg-start">
                                                        What Our Customers<br />
                                                        <strong>Testimonial</strong>
                                                    </h3>
                                                    <i class="material-icons icon">format_quote</i>
                                                    <div class="carousel">
                                                        <div class="slick-carousel" id="testimonial_carousel">
                                                            <div class="item">
                                                                <div class="inner">
                                                                    <div class="profile">
                                                                        <div class="avatar avatar-img"><img src="https://randomuser.me/api/portraits/men/3.jpg" alt="John Doe" /></div>
                                                                        <h6 class="name">John Doe<span>Chief Digital Officer</span></h6>
                                                                    </div>
                                                                    <p class="use-text-paragraph">
                                                                        Vivamus sit amet interdum elit. Proin lacinia erat ac velit tempus auctor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam nec ex aliquet, aliquam
                                                                        neque non.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="inner">
                                                                    <div class="profile">
                                                                        <div class="avatar avatar-img"><img src="https://randomuser.me/api/portraits/women/8.jpg" alt="Jean Doe" /></div>
                                                                        <h6 class="name">Jean Doe<span>Chief Digital Officer</span></h6>
                                                                    </div>
                                                                    <p class="use-text-paragraph">
                                                                        Vestibulum sit amet tortor sit amet libero lobortis semper at et odio. In eu tellus tellus. Pellentesque ullamcorper aliquet ultrices. Aenean facilisis vitae purus
                                                                        facilisis semper. Nam vitae scelerisque lorem, quis tempus libero.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="inner">
                                                                    <div class="profile">
                                                                        <div class="avatar avatar-img"><img src="https://randomuser.me/api/portraits/women/17.jpg" alt="Jena Doe" /></div>
                                                                        <h6 class="name">Jena Doe<span>Graphic Designer</span></h6>
                                                                    </div>
                                                                    <p class="use-text-paragraph">Cras convallis lacus orci, tristique tincidunt magna consequat in. In vel pulvinar est, at euismod libero.</p>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="inner">
                                                                    <div class="profile">
                                                                        <div class="avatar avatar-img"><img src="https://randomuser.me/api/portraits/women/90.jpg" alt="Jovelin Doe" /></div>
                                                                        <h6 class="name">Jovelin Doe<span>Senior Graphic Designer</span></h6>
                                                                    </div>
                                                                    <p class="use-text-paragraph">Sed imperdiet enim ligula, vitae viverra justo porta vel.</p>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="inner">
                                                                    <div class="profile">
                                                                        <div class="avatar avatar-img"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Jihan Doe" /></div>
                                                                        <h6 class="name">Jihan Doe<span>CEO Software House</span></h6>
                                                                    </div>
                                                                    <p class="use-text-paragraph">Cras convallis lacus orci, tristique tincidunt magna consequat in. In vel pulvinar est, at euismod libero.</p>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="inner">
                                                                    <div class="profile">
                                                                        <div class="avatar avatar-img"><img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Jovelin Doe" /></div>
                                                                        <h6 class="name">Jovelin Doe<span>Senior Graphic Designer</span></h6>
                                                                    </div>
                                                                    <p class="use-text-paragraph">
                                                                        Vestibulum sit amet tortor sit amet libero lobortis semper at et odio. In eu tellus tellus. Pellentesque ullamcorper aliquet ultrices. Aenean facilisis vitae purus
                                                                        facilisis semper. Nam vitae scelerisque lorem, quis tempus libero.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="inner">
                                                                    <div class="profile">
                                                                        <div class="avatar avatar-img"><img src="https://randomuser.me/api/portraits/men/4.jpg" alt="John Doe" /></div>
                                                                        <h6 class="name">John Doe<span>Senior Graphic Designer</span></h6>
                                                                    </div>
                                                                    <p class="use-text-paragraph">Cras convallis lacus orci, tristique tincidunt magna consequat in. In vel pulvinar est, at euismod libero.</p>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="inner">
                                                                    <div class="profile">
                                                                        <div class="avatar avatar-img"><img src="https://randomuser.me/api/portraits/men/3.jpg" alt="John Doe" /></div>
                                                                        <h6 class="name">John Doe<span>Chief Digital Officer</span></h6>
                                                                    </div>
                                                                    <p class="use-text-paragraph">
                                                                        Vivamus sit amet interdum elit. Proin lacinia erat ac velit tempus auctor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam nec ex aliquet, aliquam
                                                                        neque non.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="inner">
                                                                    <div class="profile">
                                                                        <div class="avatar avatar-img"><img src="https://randomuser.me/api/portraits/women/8.jpg" alt="Jean Doe" /></div>
                                                                        <h6 class="name">Jean Doe<span>Chief Digital Officer</span></h6>
                                                                    </div>
                                                                    <p class="use-text-paragraph">Cras convallis lacus orci, tristique tincidunt magna consequat in. In vel pulvinar est, at euismod libero.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 hidden-sm-down px-6">
                                                <div class="logo-wrap" id="logo_nav">
                                                    <div class="figure-btn">
                                                        <a class="waves-effect active" data-index="0"><img src="{{ theme_asset_url('landing/img/snapdeal.png')}}" alt="logo0" /></a>
                                                    </div>
                                                    <div class="figure-btn">
                                                        <a class="waves-effect" data-index="1"><img src="{{ theme_asset_url('landing/img/shopclues.png')}}" alt="logo1" /></a>
                                                    </div>
                                                    <div class="figure-btn">
                                                        <a class="waves-effect" data-index="2"><img src="{{ theme_asset_url('landing/img/myntra.png')}}" alt="logo2" /></a>
                                                    </div>
                                                    <div class="figure-btn">
                                                        <a class="waves-effect" data-index="3"><img src="{{ theme_asset_url('landing/img/flipkart.png')}}" alt="logo3" /></a>
                                                    </div>
                                                    <div class="figure-btn">
                                                        <a class="waves-effect" data-index="4"><img src="{{ theme_asset_url('landing/img/ebay.png')}}" alt="logo4" /></a>
                                                    </div>
                                                    <div class="figure-btn">
                                                        <a class="waves-effect" data-index="5"><img src="{{ theme_asset_url('landing/img/amazon.png')}}" alt="logo5" /></a>
                                                    </div>
                                                    <!-- <div class="figure-btn">
                                                        <a class="waves-effect" data-index="6"><img src="{{ theme_asset_url('landing/img/mobile.png')}}" alt="logo6" /></a>
                                                    </div>
                                                    <div class="figure-btn">
                                                        <a class="waves-effect" data-index="7"><img src="{{ theme_asset_url('landing/img/profile.png')}}" alt="logo7" /></a>
                                                    </div>
                                                    <div class="figure-btn">
                                                        <a class="waves-effect" data-index="8"><img src="{{ theme_asset_url('landing/img/saas.png')}}" alt="logo8" /></a>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- ##### END TESTIMONIAL #####--><!-- ##### PRICING PLANN #####-->
                            <section class="space-top" id="pricing">
                                <div class="root">
                                    <div class="decoration">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px">
                                            <g>
                                                <path
                                                    d="M1280,925c-133.8-192.4-264-288.5-390.5-288.5c-189.8,0-387.2,389.8-606.5,268C136.8,823.2,42.5,750.6,0,686.5V81c114.5,99.3,229.7,148.9,345.8,148.9c174.1,0,228.2-332.1,454.9-198C951.8,121.3,1118.6,137.7,1301,81L1280,925z"
                                                ></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="container fixed-width-lg-up">
                                        <div class="item">
                                            <div class="title-main align-center">
                                                <h4><strong>Pricing &amp; Plan</strong></h4>
                                            </div>
                                        </div>
                                        <p class="subtitle use-text-subtitle2 text-center">The best value designed for your workplace, starting at just &#x20B9;{{$subscription_plans[1]->cost}}/month.</p>
                                        <div class="pricing-wrap">
                                            <section>
                                                @foreach($subscription_plans as $plans)
                                                <div class="wow fadeInUpShort item" data-wow-offset="-10" data-wow-delay="0.4s" data-wow-duration="0.4s">
                                                    <div class="card pricing-card {{$plans->featured == 1 ? 'value':'basic'}}">
                                                        <div class="title-card">
                                                            <p>{{$plans->name}}</p>
                                                            <h4 class="display-1">{{$plans->cost == 0 ? 'Free':'&#x20B9;'.$plans->cost}}</h4>
                                                        </div>
                                                        <ul>
                                                            <li>Best for: {{$plans->best_for}}</li>
                                                            <li>Team Size {{$plans->team_size}}</li>
                                                            <li>Inventory Limit {{$plans->inventory_limit}}</li>
                                                        </ul>
                                                        <div class="btn-area">
                                                            <p class="desc">Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
                                                            <a class="btn button btn-large waves-effect {{$plans->featured == 1 ? 'primary':'secondary'}}" href="#">Choose Plan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- ##### END PRICING PLANN #####--><!-- ##### FAQ #####-->
                            <section class="space-top-short" id="faq">
                                <div class="root">
                                    <div class="container fixed-width">
                                        <div class="row spacing6">
                                            <div class="col-md-6 pa-6">
                                                <div class="title-main align-left">
                                                    <h4><strong>FAQ</strong></h4>
                                                </div>
                                                <p class="text use-text-subtitle2 text-lg-start text-center">Have a question? Check out our frequently asked questions to find your answer.</p>
                                                <div class="hidden-sm-down">
                                                    <div class="illustration">
                                                        
                                                        <img src="{{ theme_asset_url('landing/img/faq.png')}}" alt="illustration" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pa-6">
                                                <div class="accordion">
                                                    <ul class="collapsible">
                                                        @php $count_faq = 1; @endphp
                                                        @foreach($faqs as $faq)
                                                        <li class="accordion-content paper {{$count_faq == 1 ? 'active':''}}">
                                                            <div class="collapsible-header content">
                                                                <p class="heading">{{$faq->question}}</p>
                                                                <i class="material-icons right arrow">expand_more</i>
                                                            </div>
                                                            <div class="collapsible-body detail"><p>{!! $faq->answer !!}</p></div>
                                                        </li>
                                                        @php $count_faq++; @endphp
                                                        @endforeach
                                                        
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- ##### END FAQ #####--><!-- ##### NEWS AND EVENT #####-->
                            <section class="space-top-short" id="news">
                                <div class="root">
                                    <div class="carousel">
                                        <div class="slick-carousel" id="news_carousel">
                                            @foreach($blogs as $blog)
                                            <div>
                                                <div class="item">
                                                    <div class="news-card">
                                                        <figure><img src="{{ get_storage_file_url(optional($blog->image)->path, 'medium') }}" alt="thumb" /></figure>
                                                        <div class="desc">
                                                            <div class="text">
                                                                <p class="type caption">{{$blog->title}}</p>
                                                                {!! substr($blog->content,0,250) !!}
                                                            </div>
                                                            <!-- <a class="btn btn-small btn-flat waves-effect">read more</a> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- ##### END NEWS AND EVENT #####-->
                        </main>
                        <!-- ##### fOOTER #####-->
                        <div id="footer">
                            <div class="footer-deco" style="padding-top: 50px">
                                
                                <div class="action">
                                    <h4 class="use-text-title2">What are you waiting for?</h4>
                                    <a class="btn secondary btn-large waves-effect" href="#">Get Started</a>
                                </div>
                                <footer class="footer">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3 pa-4">
                                                <div class="logo">
                                                    
                                                      <img src="{{theme_asset_url('img/z commerce_icon.png')}}" alt="LOGO" title="LOGO" />
                                                    
                                                    <h6 class="title">Z-Commerce</h6>
                                                </div>
                                                <p class="body-2 show-md-up text-center">&copy; {{ date('Y') }} {{ get_platform_title() }}</p>
                                            </div>
                                            <div class="col-md-6 py-0 px-6">
                                                <ul class="show-sm-down collapsible">
                                                    <li class="accordion-content">
                                                        <div class="collapsible-header">
                                                            <h6 class="title mb-4">Company</h6>
                                                            <i class="material-icons right arrow">expand_more</i>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <ul>
                                                                @foreach($other_page as $page)
                                                                <li>
                                                                    <a href="{{$page->slug}}">{{ucfirst($page->title)}}</a>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    
                                                    <li class="accordion-content">
                                                        <div class="collapsible-header">
                                                            <h6 class="title mb-4">Legal</h6>
                                                            <i class="material-icons right arrow">expand_more</i>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <ul>
                                                                @foreach($copyright_page as $page)
                                                                <li>
                                                                    <a href="{{$page->slug}}">{{ucfirst($page->title)}}</a>
                                                                </li>
                                                                @endforeach
                                                                
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="row show-md-up justify-content-evenly">
                                                    <div class="col-md-6 site-map-item">
                                                        <h6 class="title-nav mb-4">Company</h6>
                                                        <ul>
                                                            @foreach($other_page as $page)
                                                            <li>
                                                                <a href="page/{{$page->slug}}">{{ucfirst($page->title)}}</a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    
                                                    <div class="col-md-6 site-map-item">
                                                        <h6 class="title-nav mb-4">Legal</h6>
                                                        <ul>
                                                            @foreach($copyright_page as $page)
                                                            <li>
                                                                <a href="page/{{$page->slug}}">{{ucfirst($page->title)}}</a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 pa-4">
                                                
                                                <div class="socmed">
                                                    <a class="btn-icon waves-effect"><span class="ion-social-facebook icon"></span></a> <a class="btn-icon waves-effect"><span class="ion-social-twitter icon"></span></a>
                                                    <a class="btn-icon waves-effect"><span class="ion-social-instagram icon"></span></a> <a class="btn-icon waves-effect"><span class="ion-social-linkedin icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </footer>
                            </div>
                        </div>
                        <!-- ##### END fOOTER #####--><!-- ##### PAGE NAV #####-->
                        <div class="hidden-md-down">
                            <div class="page-nav" id="page_nav">
                                <nav class="section-nav">
                                    <div class="scrollnav">
                                        <ul>
                                            <li style="top: 120px;"><a class="tooltipped" href="#feature" data-position="left" data-tooltip="feature"></a></li>
                                            <li style="top: 90px;"><a class="tooltipped" href="#testimonials" data-position="left" data-tooltip="testimonials"></a></li>
                                            <li style="top: 60px;"><a class="tooltipped" href="#pricing" data-position="left" data-tooltip="pricing and plan"></a></li>
                                            <li style="top: 30px;"><a class="tooltipped" href="#faq" data-position="left" data-tooltip="faq"></a></li>
                                        </ul>
                                    </div>
                                </nav>
                                <div class="scrollnav">
                                    <a class="btn-floating btn-large primary tooltipped waves-effect waves-light" href="#home" data-position="left" data-tooltip="To Top"><i class="icon material-icons">arrow_upward</i></a>
                                </div>
                            </div>
                        </div>
                        <!-- ##### END PAGE NAV #####-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Scripts-->
        <script src="{{ theme_asset_url('landing/js/saas-bundle.min.js')}}"></script>
        <script src="{{theme_asset_url('landing/js/side-right.js')}}"></script>
        <script>
    $('.showcasecarousel').owlCarousel({
   navigation : false, // Show next and prev buttons
   responsiveClass:true,
   responsive:{
        0:{
            items:2,
        },
        600:{
            items:3,
        },
        1000:{
            items:5,
        }
    },
   slideSpeed : 600,
   paginationSpeed : 400,
   singleItem: true,
   loop: true,
   autoplay:true,
    autoplayTimeout:1000,
    autoplayHoverPause:true,
    dots: false,
});
</script>
    </body>
</html>
