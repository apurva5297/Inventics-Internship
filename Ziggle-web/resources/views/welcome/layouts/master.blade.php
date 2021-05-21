<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from gfxpartner.com/Zapper/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Mar 2021 09:54:46 GMT -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>

  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="assets/favicon/site.html">

  <!--stylesheet-->
  <link rel="stylesheet" href="assets/js/maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/js/unpkg.com/swiper%406.5.0/swiper-bundle.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <!--preloader start-->
  <div class="preloader">
    <img src="assets/images/loading-img-kiddo.png" alt="image">
  </div>
  <!--preloader end-->

  <!--header section start-->
  <header class="header header-2 ">
    <div class="container">
      <div class="header__wrapper">
        <div class="header__logo" >
          <a href="/welcome">
            <img style="width:50%;height:50%;" src="assets/images/loading-img-kiddo.png" alt="logo">
          </a>
        </div>
        <div class="header__nav ">
          <ul class="header__nav-primary">
            <li><a href="/welcome"><i class="fad fa-home-alt"></i>Home</a></li>
            <li><a href="#benifits">Benifits</a></li>
            <li><a href="#feature">Features</a></li>
            <li><a href="#feedback">Feedbacks</a></li>
            <li><a href="#pricing">Pricing</a></li>
            <li><a href="#preview">Preview</a></li>
            <!-- <li><a href="#contact">Contact Us</a></li> -->
            <li><a href="http://admin.kiddotrack.com/" target="_blank">Login</a></li>
          </ul>
          <span><i class="fas fa-times"></i></span>
        </div>
       
      </div>
    </div>
  </header>
  <!--header section end-->

 @yield('content')
    <!-- contact us end -->
    <!--newsletter section end-->
    
    <!--footer start-->
    <footer class="footer">
        <div class="footer__wrapper">
            <div class="container">
        <div class="row">
            <div class="col-lg-4">
            <div class="footer__info">
              <div class="footer__info--logo">
                <img src="assets/images/loading-img-kiddo.png" alt="image" style="width: 50%">
              </div>
              <div class="footer__info--content">
                <p class="paragraph dark">Email : support@kiddotrack.com <br>Phone : +91 99492 84854</p>
                <div class="social">
                  <ul>
                    <li class="facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li class="linkedin"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    <li class="youtube"><a href="#"><i class="fab fa-youtube"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="footer__content-wrapper">
              <div class="footer__list">
                <ul>
                  <li>Explore</li>
                  <li><a href="{{route('welcome.about')}}">About</a></li>
                  <li><a href="#feature">Features</a></li>
                  <li><a href="#pricing">Pricing</a></li>
                </ul>
              </div>
              <div class="footer__list">
                <ul>
                  <li>Help</li>
                  <li><a href="{{route('welcome.privacy')}}">Privacy Policy</a></li>
                  <li><a href="{{route('welcome.terms')}}">Terms of Service</a></li>
                  <li><a href="#contact">Contact Us</a></li>
                </ul>
              </div>
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
                <!-- <a href="#" class="apple-store">
                  <i class="fab fa-apple"></i>
                  <div class="button-content">
                    <h6>GET IT ON <span>Apple Store</span></h6>
                  </div>
                </a> -->
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="footer__copy">
            <h6>&copy; Kiddotrack</h6>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--footer end-->

  <script src="assets/js/code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="assets/js/cdn.jsdelivr.net/npm/popper.js%401.16.0/dist/umd/popper.min.js"></script>
  <script src="assets/js/stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script>
    $(window).on('load', function () {
      $("body").addClass("loaded");
      setInterval(function(){
        $(".screenshot-nav-next").click(); 
      }, 3000);
      
    });
    </script>
  <script src="assets/js/unpkg.com/swiper%406.5.0/swiper-bundle.min.js"></script>
    <script src="assets/js/script.js"></script> 
</body>


<!-- Mirrored from gfxpartner.com/Zapper/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Mar 2021 09:54:53 GMT -->
</html>