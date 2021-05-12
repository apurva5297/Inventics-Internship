@extends('admin.layouts.master')

@section('buttons')
	@can('create', App\Inventory::class)
		@include('admin.marketplace.shop._add')
	@endcan
@endsection

@section('content')


	@php
		$unpaid_orders = $orders->where('payment_status', '<' , App\Order::PAYMENT_STATUS_PAID);
	@endphp

	<div class="box">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs nav-justified">
				<li class="{{ Request::has('tab') ? '' : 'active' }}"><a href="#all_orders_tab" data-toggle="tab">
					<i class="fa fa-shopping-cart hidden-sm"></i>
					{{ trans('app.all_orders') }}
				</a></li>
				<!--
				<li class="{{ Request::input('tab') == 'unpaid' ? 'active' : '' }}"><a href="#unpaid_tab" data-toggle="tab">
					<i class="fa fa-money hidden-sm"></i>
					{{ trans('app.statuses.unpaid') }}
				</a></li>
				<li class="{{ Request::input('tab') == 'unfulfilled' ? 'active' : '' }}"><a href="#unfulfilled_tab" data-toggle="tab">
					<i class="fa fa-shopping-basket hidden-sm"></i>
					{{ trans('app.statuses.unfulfilled') }}
				</a></li> -->
			</ul>
			<div class="tab-content">
			    <div class="tab-pane {{ Request::has('tab') ? '' : 'active' }}" id="all_orders_tab">
					<table class="table table-hover table-desc">
						<thead>
							<th>Order Id</th>
								<th>{{ trans('app.order_date') }}</th>
								<th>{{ trans('Order Status') }}</th>
								<th>{{ trans('SKU') }}</th>
								<th>{{ trans('FSN') }}</th>
						</thead>
						<tbody>
							@foreach($orders as $order )
							<tr>
								<td>{{$order->order_id}}</td>
						        <td>{{ $order->created_at->toDayDateTimeString() }}</td>
								<td>{{ $order->order_item_status }}</td>
								<td>{{ $order->sku}}</td>
								<td>{{ $order->fsn }}</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div> <!-- /.box -->

	<div class="box collapsed-box">
		<div class="box-header with-border" style="background-color: orange">
			<h3 class="box-title"><i class="fa fa-eye-o"></i>{{ trans('Error List') }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus" style="color: #000"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove" style="color: #000"></i></button>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-2nd-short">
				<thead>
					<tr>
						<th>Order Id</th>
						<th>{{ trans('app.order_date') }}</th>
						<th>{{ trans('Order Status') }}</th>
						<th>{{ trans('SKU') }}</th>
						<th>{{ trans('FSN') }}</th>
					</tr>
				</thead>
				<tbody>
					@if((Session::get('previous_order_error_session') != null))
					@foreach(Session::get('previous_order_error_session') as $error_list)
					<tr>
						<td>{{$error_list[1]}}</td>
						<td>{{$error_list[4]}}</td>
						<td>{{$error_list[6]}}</td>
						<td>{{$error_list[7]}}</td>
						<td>{{$error_list[8]}}</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection