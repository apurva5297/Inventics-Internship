@extends('layouts.main')

@section('content')
    <!-- HEADER SECTION -->
    @include('headers.order_detail')
<section>
  	<div class="container">
      	<div class="row">
        	<div class="col-md-12 nopadding">
				<!-- <table class="table" id="buyer-payment-detail-table">
					<thead>
			          	<tr><th colspan="6">@lang('theme.payment_detail')</th></tr>
					</thead>
					<tbody>
						<tr class="buyer-payment-info-head">
							<td>@lang('theme.price')</td>
							<td>@lang('theme.shipping_cost')</td>
							<td>@lang('theme.packaging_cost')</td>
							<td>@lang('theme.taxes')</td>
							<td>@lang('theme.discount')</td>
							<td>@lang('theme.total')</td>
						</tr>

						<tr class="buyer-payment-info-body">
							<td>{{ get_formated_currency($order->total) }}</td>
							<td>{{ get_formated_currency($order->shipping + $order->handling) }}</td>
							<td>{{ get_formated_currency($order->packaging) }}</td>
							<td>{{ get_formated_currency($order->taxes) }}</td>
							<td>{{ get_formated_currency($order->discount) }}</td>
							<td>{{ get_formated_currency($order->grand_total) }}</td>
						</tr>
						<tr><td colspan="6"></td></tr>
						<tr class="buyer-payment-info-head">
							<td colspan="2">@lang('theme.amount')</td>
							<td colspan="2">@lang('theme.payment_method')</td>
							<td colspan="2">@lang('theme.status')</td>
						</tr>

						<tr class="buyer-payment-info-body">
							<td colspan="2">{{ get_formated_currency($order->grand_total) }}</td>
							<td colspan="2">{{ $order->paymentMethod->name }}</td>
							<td colspan="2">{!! $order->paymentStatusName() !!}</td>
						</tr>
					</tbody>
				</table> -->

				<div class="clearfix space20"></div>
				<form method="get" action="{{ route('order.return_order') }}" accept-charset="UTF-8">
					
				
				<table class="table" id="buyer-order-table" name="buyer-order-table">
			      	<thead>
			          	<tr>
			            	<th colspan="3">@lang('theme.order_detail')</th>
			          	</tr>
			      	</thead>
				    <tbody>
			            <tr class="buyer-payment-info-head">
			            	<td>@lang('theme.shipping_address'):</td>
			            	<td colspan="2">@lang('theme.billing_address'):</td>
			            </tr>
			            <tr>
			            	<td>{!! $order->shipping_address !!}</td>
			            	<td colspan="2">{!! $order->billing_address !!}</td>
			            </tr>
			            <tr class="order-info-head">
			                <td width="55%">
			                  	<h5><span>@lang('theme.order_id'): </span>{{ $order->order_number }}</h5>
			                  	<h5><span>@lang('theme.order_time_date'): </span>{{ $order->created_at->toDayDateTimeString() }}</h5>
			                </td>
			                <input type="hidden" name="order_id" value="{{$order->id}}">
			                <input type="hidden" name="order_number" value="{{$order->order_number}}">
			                <input type="hidden" name="customer_id" value="{{$order->customer_id}}">
			                <input type="hidden" name="shop_id" value="{{$order->shop_id}}">
			                <td width="25%" class="store-info">
			                  	<h5>
			                    	<span>@lang('theme.store'):</span>
			                    	@if($order->shop)
				                    	<a href="{{ route('show.store', $order->shop->slug) }}"> {{ $order->shop->name }}</a>
				                    @else
			                      		@lang('theme.store_not_available')
			                    	@endif
			                  	</h5>
			                  	<h5>
				                    <span>@lang('theme.status')</span>
				                    {{ optional($order->status)->name }}
			                  	</h5>
			                </td>
			                <td width="20%" class="order-amount">
			                  	<h5><span>@lang('theme.order_amount'): </span>{{ get_formated_currency($order->grand_total) }}</h5>
			                </td>
			            </tr> <!-- /.order-info-head -->

			            @foreach($order->inventories as $item)
			                <tr class="order-body">
			                    <td colspan="2">
			                        <div class="product-img-wrap">
			                          <img src="{{ get_storage_file_url(optional($item->image)->path, 'small') }}" alt="{{ $item->slug }}" title="{{ $item->slug }}" />
			                        </div>
			                        <div class="product-info">
			                            <a href="{{ route('show.product', $item->slug) }}" class="product-info-title">{{ $item->pivot->item_description }}</a>
			                            <div class="order-info-amount">
			                                <span>{{ get_formated_currency($item->pivot->unit_price) }} x {{ $item->pivot->quantity }}</span>
			                            </div>
			                             <div class="order-info-amount">
			                             	Set Size:  
			                                <span>{{ $item->set_size }}</span>
			                            </div>
			                            {{--
			                            <ul class="order-info-properties">
			                                <li>Size: <span>L</span></li>
			                                <li>Color: <span>RED</span></li>
			                            </ul> --}}
			                        </div>
			                    </td>
			                    	<input type="hidden" name="product_id[]" value="{{$item->id}}" class="product_id">
				                    <td class="order-actions">

				                   @if($return_detail)
				                   <!-- {{$item->id}} -->
	                               <?php
				                    	$product=json_decode($return_detail->product_details,true);

				                     	print_r($product[$item->id].' pc ');
				                    	
				                    	?>
				                    @else
			                      		 Quantity (between 1 and {{$item->set_size}}): <input type="number" name="quantity[]" min="0" max="{{$item->set_size}}" value="0" class="que">
			                    	@endif
				                    </td>
		                      
			                </tr> <!-- /.order-body -->
			              
			            @endforeach
			            	
			          	  <tr>
			              @if($return_detail)
			              <td>
			              	Request Date:<?php
			              	echo date("F d, Y h:i:s A",  strtotime($return_detail->created_at));
			              	?>
			              </td>
			            		<td colspan="2" align="right">
			            			<span style="color: green; font-style: bold;font-size: 16px;font-family: 'Open Sans', arial, helvetica, sans-serif">
			            				{{$return_detail->status}}
			            			</span>
			            			
			            		</td>
			            	 @else
			            	 <td colspan="3">
			            			<input type="submit" name="" value="Return" class="btn btn-danger" style="float: right;" onclick="myFunction()">
			            		</td>
			            	 @endif
			            	</tr>
				    </tbody>
				</table>
				</form>
            </div><!-- /.col-md-12 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</section>

<!-- END CONTENT SECTION -->

<div class="clearfix space20"></div>
 @include('sliders.browsing_items')
@endsection
