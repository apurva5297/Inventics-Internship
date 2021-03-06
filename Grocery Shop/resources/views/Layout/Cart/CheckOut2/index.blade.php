@extends('Layout.ProductPage.Product')
@section('content')
<div class="page-content">
    @include('Layout.Cart.CheckOut2.destination')
    <div class="holder">
      <div class="container">
        <h1 class="text-center">Checkout wizard</h1>
        <div class="row">
            @include('Layout.Cart.CheckOut2.addresssteps')
          <div class="col-md-8 pl-lg-8 mt-2 mt-md-0">
            @include('Layout.Cart.CheckOut2.ordersummary')
            <div class="mt-2"></div>
            @include('Layout.Cart.CheckOut2.applypromo')
            <div class="mt-2"></div>
            @include('Layout.Cart.CheckOut2.subtotal')
            <div class="mt-2"></div>
            @include('Layout.Cart.CheckOut2.ordercomments')
          </div>
        </div>
      </div>
    </div>
  </div>


<script>
var payment_method_id=6;
$(document).ready(function () {
    //for shipping
  $(".address_box").click(function () {
    $(".address_box").removeClass("highlight");
      $(this).addClass("highlight");
      let address_val=$(this).find('.address_id').val();
      let cart_val=$(this).find('.cart_id').val();
      saveShippingAddress(address_val,cart_val);
  });

  //for billing
  $(".address_box_billing").click(function () {
    $(".address_box_billing").removeClass("highlight_billing");
      $(this).addClass("highlight_billing");
      let address_val=$(this).find('.address_id').val();
      let cart_val=$(this).find('.cart_id').val();
      saveBillingAddress(address_val,cart_val);
  });

  //for billing
  $("#formcheckoutRadio4").change(function () {
      let radioValue=$(this).val();
      payment_method_id=radioValue;
      document.getElementById("payment-instructions").innerHTML="Start from today";
  });
   $("#formcheckoutRadio5").change(function () {
      let radioValue=$(this).val();
      payment_method_id=radioValue;
      document.getElementById("payment-instructions").innerHTML="You will be redirected to Paytm";
  });

  //for placeOrder
  $(".place_order_btn").click(function () {
      let cart_id=$(this).find('#cart_id').val();
      // placeOrder(cart_id);
  });


});

function saveShippingAddress(address_id,cart_id)
  {

    $.ajax({
      url: "{{route('saveShippingIdForCheckOut')}}",
      type: 'POST',
      // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
      data: {
        addressId: address_id,
        cartId: cart_id,
        _token:'{{ csrf_token() }}'
      },
         success: function(response){
          console.log(response);
            //successfully updated shipping id
             if(response=="success")
                 customLoadAndShowMSG("success","successfully updated shipping address");

         }
      });
  }

  function saveBillingAddress(address_id,cart_id)
  {

    $.ajax({
      url: "{{route('saveBillingIdForCheckOut')}}",
      type: 'POST',
      // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
      data: {
        addressId: address_id,
        cartId: cart_id,
        _token:'{{ csrf_token() }}'
      },
         success: function(response){
          console.log(response);
            //successfully updated shipping id
             if(response=="success")
                 customLoadAndShowMSG("success","successfully updated billing address");

         }
      });
  }

  function placeOrder(cart_id)
  {
      var payment_method_id=6;

    // alert("hello");
    $.ajax({
      url: "{{route('placeOrder')}}",
      type: 'POST',
      // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
      data: {
        cartId: cart_id,
        paymentMethodId:payment_method_id,
        _token:'{{ csrf_token() }}'
      },

         success: function(response){
          console.log(response);
            //successfully updated shipping id
            alert("order is placed");
             customLoadAndShowMSG("success","your order is placed");
            window.location = "{{route('Account','orders')}}";
          }
      });
  }
</script>


@endsection
