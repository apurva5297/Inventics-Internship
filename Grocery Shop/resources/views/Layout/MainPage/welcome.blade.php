
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Foxic HTML Template - Index Page - Food</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <!-- Vendor CSS -->
    <link href="{{asset('css/vendor/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/vendor/vendor.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- Custom font -->
    <link href="{{asset('fonts/icomoon/icons.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&nbsp;Condensed:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <style>
        .title-wrap .title-tabs-text .title-tabs-bg {
            -webkit-mask: url(images/skins/food/brush-shape.svg) no-repeat 50%;
            -webkit-mask-size: contain;
        }

        .countdown-box-bg .countdown>span:after {
            -webkit-mask: url(images/skins/food/brush-shape-square.svg) no-repeat 50%;
            -webkit-mask-size: cover;
        }
    </style>
</head>
<body class="template-collection has-smround-btns has-loader-bg equal-height has-sm-container">

<div>
    @include('Layout.MainPage.Header.Header')
    @include('Layout.MainPage.NavBar.MainSlider')

</div>
@if(session('success'))
    <div class="alert alert-warning">{{session('success')}}</div>
@endif


@yield('content')
<div>
@include('Layout.MainPage.Cart.AddToCart')
    @include('Layout.ProductPage.CommonJsFunction')
    @include('CommonContent.quickview')

    @include('Layout.MainPage.Footer.Footer')

</div>

{{--$("#request_otp").click(function(){--}}
{{--var type='EnterOTP';--}}
{{--var mobile=$("#phone").val();--}}
{{--console.log(mobile);--}}
{{--$.ajax({--}}
{{--type:'POST',--}}
{{--url:"{{ route('login') }}",--}}
{{--data:{--}}
{{--_token:'{{ csrf_token() }}',--}}
{{--login_type: type,--}}
{{--phone: mobile,--}}

{{--},--}}
{{--success: function(response){--}}
{{--console.log(response);--}}
{{--//$("#dropdonAccountlogin").html(response); //testing purpose only--}}
{{--if(response.data=='enter otp')--}}
{{--{--}}
{{--var phone=parseInt(response.phone);--}}
{{--$("#EnterLoginOtp").show();--}}
{{--$("#RequestLoginOtp").hide();--}}
{{--$("#verifyphone").attr('value',phone);--}}
{{--}--}}
{{--else if(response.data=='please register')--}}
{{--{--}}
{{--registerCustomer();--}}
{{--//$("#notRegistered").html('You may not have account with us');--}}
{{--}--}}

{{--}--}}
{{--})--}}
{{--})--}}

<script src="{{asset('js/vendor-special/lazysizes.min.js')}}"></script>
<script src="{{asset('js/vendor-special/ls.bgset.min.js')}}"></script>
<script src="{{asset('js/vendor-special/ls.aspectratio.min.js')}}"></script>
<script src="{{asset('js/vendor-special/jquery.min.js')}}"></script>
<script src="{{asset('js/vendor-special/jquery.ez-plus.js')}}"></script>
<script src="{{asset('js/vendor/vendor.min.js')}}"></script>
<script src="{{asset('js/app-html.js')}}"></script>
</body>
