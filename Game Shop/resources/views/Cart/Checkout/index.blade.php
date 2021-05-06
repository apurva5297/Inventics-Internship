  
@extends('layouts.master_common')
@section('content')
<div class="page-content">
    <div class="holder breadcrumbs-wrap mt-0">
        <div class="container">
          <ul class="breadcrumbs">
            <li><a>Home</a></li>
            <li><span>Checkout</span></li>
          </ul>
        </div>
      </div>
    <div class="holder">
      <div class="container">
        <h1 class="text-center">Checkout page</h1>
        <div class="row">
          <div class="col-md-9">
            @include('Cart.Checkout.shippingaddress')
            @include('Cart.Checkout.billing')
          </div>
          <div class="col-md-9 mt-2 mt-md-0">
             @include('Cart.Checkout.delivery')
            <div class="mt-2"></div>
            @include('Cart.Checkout.payment')
            <div class="mt-2"></div>
            @include('Cart.Checkout.comment')
          </div>
        </div>
        <div class="mt-3"></div>
        <h2 class="custom-color">Order Summary</h2>
        <div class="row">
          @include('Cart.Checkout.summary')
          @include('Cart.Checkout.promo')
        </div>
      </div>
    </div>
  </div>
  
  
@endsection