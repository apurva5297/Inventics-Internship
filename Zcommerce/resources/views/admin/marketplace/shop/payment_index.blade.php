@extends('admin.layouts.master')

@section('buttons')
	@can('create', App\Inventory::class)
		@include('admin.marketplace.shop._add')
	@endcan
@endsection

@section('content')

	<div class="box">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs nav-justified">
				<li class="{{ Request::has('tab') ? '' : 'active' }}"><a href="#order_payment" data-toggle="tab">
					<i class="fa fa-shopping-cart hidden-sm"></i>
					{{ trans('Order Payment') }}
				</a></li>
				<li class="{{ Request::input('tab') == 'storage_recall_payment' ? 'active' : '' }}"><a href="#storage_recall_payment" data-toggle="tab">
					<i class="fa fa-money hidden-sm"></i>
					{{ trans('Storeage Recall') }}
				</a></li>
				<li class="{{ Request::input('tab') == 'non_order_spf_payment' ? 'active' : '' }}">
					<a href="#non_order_spf_payment" data-toggle="tab">
						<i class="fa fa-shopping-basket hidden-sm"></i>
						{{ trans('Non Order SPF') }}
					</a>
				</li>

				<li class="{{ Request::input('tab') == 'ads_payment' ? 'active' : '' }}">
					<a href="#ads_payment" data-toggle="tab">
						<i class="fa fa-shopping-basket hidden-sm"></i>
						{{ trans('Ads Payment') }}
					</a>
				</li>

				<li class="{{ Request::input('tab') == 'tax_details' ? 'active' : '' }}">
					<a href="#tax_details" data-toggle="tab">
						<i class="fa fa-shopping-basket hidden-sm"></i>
						{{ trans('Tax Details') }}
					</a>
				</li>

				<li class="{{ Request::input('tab') == 'tcs_recovery_payment' ? 'active' : '' }}">
					<a href="#tcs_recovery_payment" data-toggle="tab">
						<i class="fa fa-shopping-basket hidden-sm"></i>
						{{ trans('Tcs Recovery payment') }}
					</a>
				</li>
			</ul>
			<div class="tab-content">
			    <div class="tab-pane {{ Request::has('tab') ? '' : 'active' }}" id="order_payment">
					<table class="table table-hover table-desc">
						<thead>
							<tr>
								<th>{{ trans('Neft Id') }}</th>
								<th>Neft type</th>
								<th>{{ trans('Date') }}</th>
								<th>{{ trans('Sattlement Value') }}</th>
								<th>{{ trans('order_id') }}</th>
								<th>{{ trans('Sale Amount') }}</th>
								<th>{{ trans('Marketplace Fee') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($order_payments as $order )
								<tr>
									<td>{{ $order->neft_id}}</td>
									<td>{{$order->neft_type}}</td>
							        <td>{{ $order->date }}</td>
									<td>{{ $order->settlement_value }}</td>
									<td>{{ $order->order_id }}</td>
									<td>{{ $order->sale_amount }}</td>
									<td>{{ $order->marketplace_fee }}</td>
									
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			    <div class="tab-pane {{ Request::input('tab') == 'storage_recall_payment' ? 'active' : '' }}" id="storage_recall_payment">
					<table class="table table-hover table-desc">
						<thead>
							<tr>
								<th>{{ trans('Neft Id') }}</th>
								<th>Listing Id</th>
								<th>{{ trans('Date') }}</th>
								<th>{{ trans('Sattlement Value') }}</th>
								<th>{{ trans('Warehouse State Code') }}</th>
								<th>{{ trans('FSN') }}</th>
								<th>{{ trans('Marketplace Fee') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($storeage_recall_payments as $storeage_recall_payment )
								<tr>
									<td>{{ $storeage_recall_payment->neft_id}}</td>
									<td>{{$storeage_recall_payment->listing_id}}</td>
							        <td>{{ $storeage_recall_payment->date }}</td>
									<td>{{ $storeage_recall_payment->settlement_value }}</td>
									<td>{{ $storeage_recall_payment->warehouse_state_code }}</td>
									<td>{{ $storeage_recall_payment->fsn }}</td>
									<td>{{ $storeage_recall_payment->market_place_fee }}</td>
									
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			    <div class="tab-pane {{ Request::input('tab') == 'non_order_spf_payment' ? 'active' : '' }}" id="non_order_spf_payment">
					<table class="table table-hover table-desc">
						<thead>
							<tr>
								<th>{{ trans('neft_id') }}</th>
								<th>{{trans('date')}}</th>
								<th>{{ trans('Satelment Value') }}</th>
								<th>{{ trans('SKU') }}</th>
								<th>{{ trans('FSN') }}</th>
								<th>{{ trans('Selling Price') }}</th>
								<th>{{ trans('Warehouse Id') }}</th>
								
							</tr>
						</thead>
						<tbody>
							@foreach($non_order_spf_payments as $non_order_spf_payment )
							<tr>
								<td>{{ $non_order_spf_payment->neft_id}}</td>
								<td>{{ $non_order_spf_payment->date}}</td>
						        <td>{{ $non_order_spf_payment->satlement_value }}</td>
								<td>{{ $non_order_spf_payment->seller_sku }}</td>
								<td>{{ $non_order_spf_payment->fsn }}</td>
								<td>{{ $non_order_spf_payment->selling_price }}</td>
								<td>{{ $non_order_spf_payment->warehouse_id}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<div class="tab-pane {{ Request::input('tab') == 'ads_payment' ? 'active' : '' }}" id="ads_payment">
					<table class="table table-hover table-desc">
						<thead>
							<tr>
								<th>{{ trans('neft_id') }}</th>
								<th>{{trans('date')}}</th>
								<th>{{ trans('Satelment Value') }}</th>
								<th>{{ trans('Type') }}</th>
								<th>{{ trans('Tax') }}</th>
								
							</tr>
						</thead>
						<tbody>
							@foreach($ads_payments as $ads_payment )
								<tr>
									<td>{{$ads_payment->neft_id}}</td>
									<td>{{$ads_payment->date}}</td>
							        <td>{{ $ads_payment->satlement_value }}</td>
									<td>{{ $ads_payment->type }}</td>
									<td>{{ $ads_payment->taxes }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<div class="tab-pane {{ Request::input('tab') == 'tax_details' ? 'active' : '' }}" id="tax_details">
					<table class="table table-hover table-desc">
						<thead>
							<tr>
								<th>{{ trans('Service Type') }}</th>
								<th>{{ trans('Neft Id') }}</th>
								<th>{{ trans('fee name') }}</th>
								<th>{{ trans('New Fee Amount') }}</th>
								<th>{{ trans('Old fee Amount') }}</th>
								<th>{{ trans('Total Tax') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tax_details as $tax_detail )
								<tr>
									<td>{{ $tax_detail->service_type }}</td>
									<td>{{ $tax_detail->neft_id}}</td>
							        <td>{{ $tax_detail->fee_name }}</td>
									<td>{{ $tax_detail->fee_amount_new }}</td>
									<td>{{ $tax_detail->fee_amount_old }}</td>
									<td>{{ $tax_detail->total_tax }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<div class="tab-pane {{ Request::input('tab') == 'tcs_recovery_payment' ? 'active' : '' }}" id="tcs_recovery_payment">
					<table class="table table-hover table-desc">
						<thead>
							<tr>
								<th>{{ trans('Neft Id') }}</th>
								<th>{{ trans('Sattlement Type') }}</th>
								<th>{{ trans('Sattlement value') }}</th>
								<th>{{ trans('Transaction Id') }}</th>
								<th>{{ trans('Transaction Date') }}</th>
								<th>{{ trans('Recovery Month') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tcs_recovery_payments as $tcs_recovery_payment )
								<tr>
									<td>{{$tcs_recovery_payment->neft_id}}</td>
									<td>{{$tcs_recovery_payment->satlement_type}}</td>
							        <td>{{ $tcs_recovery_payment->satlement_value }}</td>
									<td>{{ $tcs_recovery_payment->transaction_id }}</td>
									<td>{{ $tcs_recovery_payment->transaction_date }}</td>
									<td>{{ $tcs_recovery_payment->recovery_month }}</td>
									
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div> <!-- /.box -->

	<div class="box collapsed-box">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-trash-o"></i> {{ trans('app.trash') }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-2nd-short">
				<thead>
					<tr>
						<th>{{ trans('app.order_number') }}</th>
						<th>{{ trans('app.order_date') }}</th>
						<th>{{ trans('app.grand_total') }}</th>
						<th>{{ trans('app.payment') }}</th>
						<th>{{ trans('app.status') }}</th>
						<th>{{ trans('app.archived_at') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection