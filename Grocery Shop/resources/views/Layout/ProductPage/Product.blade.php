<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Foxic HTML Template - Product Page</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <!-- Vendor CSS -->
    <link href="{{asset('css/vendor/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/vendor/vendor.min.css')}}" rel="stylesheet">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- Custom font -->
    <link href="{{asset('fonts/icomoon/icons.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open%20Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<style>

    .highlight {
        background-color: #D6EAF8 ;
    }
    .highlight_billing {
        background-color: #FCF3CF ;
    }
</style>

<body class="template-collection has-smround-btns has-loader-bg equal-height has-sm-container">
<div>
    @if(session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{session('warning')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('danger')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>


    @include('Layout.ProductPage.Header.Header')


@yield('content')

    @include('Layout.ProductPage.Footer.Footer')
@include('Layout.ProductPage.CommonJsFunction')

{{-- @include('layout.paymentnotification') --}}
@include('Layout.customnotification')




    <script src="{{asset('js/vendor-special/lazysizes.min.js')}}"></script>
  <script src="{{asset('js/vendor-special/ls.bgset.min.js')}}"></script>
  <script src="{{asset('js/vendor-special/ls.aspectratio.min.js')}}"></script>
  <script src="{{asset('js/vendor-special/jquery.min.js')}}"></script>
  <script src="{{asset('js/vendor-special/jquery.ez-plus.js')}}"></script>
  <script src="{{asset('js/vendor/vendor.min.js')}}"></script>
  <script src="{{asset('js/app-html.js')}}"></script>
</body>
</html>
