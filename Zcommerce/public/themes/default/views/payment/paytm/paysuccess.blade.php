@extends('layouts.main')

@section('content')

@include('headers.order_detail')

<section>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <p class="lead">@lang('theme.notify.order_placed_thanks')</p>
          <?php $data=json_decode($order->RESPONSE);?>
              <table class="table table-bordered">
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
                    <td>Payment Mode</td>
                    <td>{{ $data->BANKNAME }}</td>
                  </tr>
                  <tr>
                    <td>Txn Reference ID</td>
                    <td>#{{ $data->BANKTXNID }}</td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>{{ $data->STATUS }}</td>
                  </tr>
                </tbody>
              </table>
        </p>
        </div><!-- /.col-md-8 -->
    </div><!-- /.row -->
    </div> <!-- /.container -->
</section>

@include('sliders.browsing_items')
@endsection


