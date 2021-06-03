<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SHOP</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
  <!-- Vendor CSS -->
  <link href="{{ theme_asset_url('css/vendor/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ theme_asset_url('css/vendor/vendor.min.css')}}" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href= "{{ theme_asset_url('css/style.css') }}"rel="stylesheet">
  <!-- Custom font -->
  <link href="{{ theme_asset_url('fonts/icomoon/icons.css')}}" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open%20Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body class="has-smround-btns has-loader-bg equal-height">
 
  <!--header-->
  @include('layouts.header-3')
 
  <!-- main content -->
  @yield('content')
  <!-- main content end -->

  <!-- footer -->  
    @include('layouts.footer')

  <!--added to sticky cart-->
    @include('layouts.sticky_addtocart')

  <!-- payment note -->  
    @include('layouts.payment_note')
    
    @include('scripts.cartjs')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="{{ theme_asset_url('js/vendor-special/lazysizes.min.js')}}"></script>
  <script src="{{ theme_asset_url('js/vendor-special/ls.bgset.min.js')}}"></script>
  <script src="{{ theme_asset_url('js/vendor-special/ls.aspectratio.min.js')}}"></script>
  <script src="{{ theme_asset_url('js/vendor-special/jquery.min.js')}}"></script>
  <script src="{{ theme_asset_url('js/vendor-special/jquery.ez-plus.js')}}"></script>
  <script src="{{ theme_asset_url('js/vendor/vendor.min.js')}}"></script>
  <script src="{{ theme_asset_url('js/app-html.js')}}"></script>
</body>

</html>