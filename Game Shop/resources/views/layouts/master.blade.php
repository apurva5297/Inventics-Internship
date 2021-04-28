<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Game Shop</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
  <!-- Vendor CSS -->
  <link href="css/vendor/bootstrap.min.css" rel="stylesheet">
  <link href="css/vendor/vendor.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style-games.css" rel="stylesheet">
  <!-- Custom font -->
  <link href="fonts/icomoon/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body class="has-squared-btns has-loader-bg equal-height has-btn-not-upper">
@include('layouts.header')
@include('layouts.mobile_menu')
@include('layouts.cart')
@include('layouts.youtubevideo') 
@include('layouts.holder')
@include('layouts.topworldgames')   
@include('layouts.gameoftheyear')
@include('layouts.game_news')  
@include('layouts.subscribe')
@include('layouts.footer')
@include('layouts.payment_note')


  
  <script src="js/vendor-special/lazysizes.min.js"></script>
  <script src="js/vendor-special/ls.bgset.min.js"></script>
  <script src="js/vendor-special/ls.aspectratio.min.js"></script>
  <script src="js/vendor-special/jquery.min.js"></script>
  <script src="js/vendor-special/jquery.ez-plus.js"></script>
  <script src="js/vendor/vendor.min.js"></script>
  <script src="js/app-html.js"></script>
</body>

</html>