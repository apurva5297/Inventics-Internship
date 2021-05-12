@extends('layouts.main')

@section('content')
<div class="theme-page">
  <div class="clearfix">

    <!--Section 2 --->
    <div class="row padding-bottom-100">
        <div class="column column-1-1">
          <div class="row mobile-paddings" id="section-to-print">
            <div class="column column-1-3" id="payment_status">
              <ul class="services-list services-icons margin-top-25 clearfix">
                <li class="column column-1-3">
                   <span class="service-icon big features-wallet"></span>
                   <p>Transaction was failed ! Go to &nbsp; > <a href="{{ url('/myaccount/wallet') }}">MyWallet</a></p><!-- 
                   <p>Got to  &nbsp; > <a href="{ url('/myaccount') }}">Myaccount</a></p> -->
                </li>
              </ul>
              <?php $data=json_decode($order->RESPONSE);?>
              <table class="gray-first">
                <tbody>
                  <tr>
                    <td>Request ID</td>
                    <td>#{{ $data->ORDERID }}</td>
                  </tr>
                  <tr>
                    <td>Amount</td>
                    <td>Rs {{ $data->TXNAMOUNT }} /-</td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>{{ $data->STATUS }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <p>Print Reciept : <button onclick="myFunction()">Print</button> </p>
        </div>
    </div>
    <!--Section 2 end --->

  </div>
  <!--clearfix end -->
</div>
@endsection

