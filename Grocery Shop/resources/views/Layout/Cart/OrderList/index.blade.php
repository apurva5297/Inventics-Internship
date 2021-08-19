@extends('Layout.ProductPage.Product')
@section('content')
<div class="page-content">
    @include('Layout.Cart.OrderList.destination')
    <div class="holder">
      <div class="container">
        <div class="page-title text-center">
          <h1>Order List</h1>
        </div>

          @include('Layout.Cart.OrderList.orderlist')

      </div>
    </div>
  </div>

@endsection
