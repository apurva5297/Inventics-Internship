<!-- CONTENT SECTION -->

<section>
  	<div class="container">
      	<div class="row">
        	<div class="col-md-12 nopadding">
				<table class="table" id="buyer-payment-detail-table">
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
				</table>

				<div class="clearfix space20"></div>

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
			                            {{--
			                            <ul class="order-info-properties">
			                                <li>Size: <span>L</span></li>
			                                <li>Color: <span>RED</span></li>
			                            </ul> --}}
			                        </div>
			                    </td>
		                    	@if($loop->first)
				                    <td rowspan="{{ $loop->count }}" class="order-actions">
			    	                    <a href="{{ route('order.track', $order) }}" class="btn btn-default btn-sm btn-block flat">@lang('theme.button.track_order')</a>
						                @if($order->goods_received)
				    	                    <a href="{{ route('order.feedback', $order) }}" class="btn btn-primary btn-sm btn-block flat">@lang('theme.button.give_feedback')</a>
						                @else
									        {!! Form::model($order, ['method' => 'PUT', 'route' => ['goods.received', $order]]) !!}
						                        {!! Form::button(trans('theme.button.confirm_goods_received'), ['type' => 'submit', 'class' => 'confirm btn btn-primary btn-block flat', 'data-confirm' => trans('theme.confirm_action.goods_received')]) !!}
									        {!! Form::close() !!}
						                @endif
					                    <a href="{{ route('dispute.open', $order) }}" class="confirm btn btn-link btn-block" data-confirm="@lang('theme.confirm_action.open_a_dispute')">@lang('theme.button.open_dispute')</a>
				                    </td>
		                      	@endif
			                </tr> <!-- /.order-body -->
			            @endforeach

			            
				    </tbody>
				</table>
            </div><!-- /.col-md-12 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</section>

<!-- END CONTENT SECTION -->

<div class="clearfix space20"></div>