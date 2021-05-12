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
				<li class="{{ Request::input('tab') == 'unpaid' ? 'active' : '' }}"><a href="#unpaid_tab" data-toggle="tab">
					<i class="fa fa-money hidden-sm"></i>
					{{ trans('app.statuses.unpaid') }}
				</a></li>
				<li class="{{ Request::input('tab') == 'unfulfilled' ? 'active' : '' }}"><a href="#unfulfilled_tab" data-toggle="tab">
					<i class="fa fa-shopping-basket hidden-sm"></i>
					{{ trans('app.statuses.unfulfilled') }}
				</a></li>
			</ul>
			<div class="tab-content">
			    <div class="tab-pane {{ Request::has('tab') ? '' : 'active' }}" id="all_orders_tab">
					<table class="table table-hover table-desc">
						<thead>
							<tr>
								<th>{{ trans('app.order_number') }}</th>
								<th>Order Id</th>
								<th>{{ trans('app.order_date') }}</th>
								<th>{{ trans('app.customer') }}</th>
								<th>{{ trans('app.grand_total') }}</th>
								<th>{{ trans('app.payment') }}</th>
								<th>{{ trans('app.status') }}</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@foreach($orders as $order )
								<tr>
									<td>
										@can('view', $order)
											<a href="{{ route('admin.order.order.show', $order->id) }}">
												{{ $order->order_number }}
											</a>
										@else
											{{ $order->order_number }}
										@endcan
										@if($order->disputed)
											<span class="label label-danger indent5">{{ trans('app.statuses.disputed') }}</span>
										@endif
									</td>
									<td>{{$order->order_id}}</td>
							        <td>{{ $order->created_at->toDayDateTimeString() }}</td>
									<td>{{ $order->customer->name }}</td>
									<td>{{ get_formated_currency($order->grand_total) }}</td>
									<td>{!! $order->paymentStatusName() !!}</td>
									<td>
										<span class="label label-outline" style="background-color: {{ optional($order->status)->label_color }}">
											{{ $order->status ? strToupper(optional($order->status)->name) : trans('app.statuses.new') }}
										</span>
									</td>
									<td class="row-options">
										@can('archive', $order)
											{!! Form::open(['route' => ['admin.order.order.archive', $order->id], 'method' => 'delete', 'class' => 'data-form']) !!}
												{!! Form::button('<i class="fa fa-archive text-muted"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.order_archive'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
											{!! Form::close() !!}
										@endcan
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			    <div class="tab-pane {{ Request::input('tab') == 'unpaid' ? 'active' : '' }}" id="unpaid_tab">
					<table class="table table-hover table-desc">
						<thead>
							<tr>
								<th>{{ trans('app.order_number') }}</th>
								<th>Order Id</th>
								<th>{{ trans('app.order_date') }}</th>
								<th>{{ trans('app.customer') }}</th>
								<th>{{ trans('app.grand_total') }}</th>
								<th>{{ trans('app.payment') }}</th>
								<th>{{ trans('app.status') }}</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@foreach($unpaid_orders as $order )
								<tr>
									<td>
										@can('view', $order)
											<a href="{{ route('admin.order.order.show', $order->id) }}">
												{{ $order->order_number }}
											</a>
										@else
											{{ $order->order_number }}
										@endcan
										@if($order->disputed)
											<span class="label label-danger indent5">{{ trans('app.statuses.disputed') }}</span>
										@endif
									</td>
									<td>{{$order->order_id}}</td>
							        <td>{{ $order->created_at->toDayDateTimeString() }}</td>
									<td>{{ $order->customer->name }}</td>
									<td>{{ get_formated_currency($order->grand_total )}}</td>
									<td>{!! $order->paymentStatusName() !!}</td>
									<td>
										<span class="label label-outline" style="background-color: {{ optional($order->status)->label_color }}">
											{{ $order->status ? strToupper(optional($order->status)->name) : trans('app.statuses.new') }}
										</span>
									</td>
									<td class="row-options">
										@can('archive', $order)
											{!! Form::open(['route' => ['admin.order.order.archive', $order->id], 'method' => 'delete', 'class' => 'data-form']) !!}
												{!! Form::button('<i class="fa fa-archive text-muted"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.order_archive'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
											{!! Form::close() !!}
										@endcan
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			    <div class="tab-pane {{ Request::input('tab') == 'unfulfilled' ? 'active' : '' }}" id="unfulfilled_tab">
					<table class="table table-hover table-desc">
						<thead>
							<tr>
								<th>{{ trans('app.order_number') }}</th>
								<th>Order Id</th>
								<th>{{ trans('app.order_date') }}</th>
								<th>{{ trans('app.customer') }}</th>
								<th>{{ trans('app.grand_total') }}</th>
								<th>{{ trans('app.payment') }}</th>
								<th>{{ trans('app.status') }}</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@foreach($orders as $order )
								@unless($order->isFulfilled())
									<tr>
										<td>
											@can('view', $order)
												<a href="{{ route('admin.order.order.show', $order->id) }}">
													{{ $order->order_number }}
												</a>
											@else
												{{ $order->order_number }}
											@endcan
											@if($order->disputed)
												<span class="label label-danger indent5">{{ trans('app.statuses.disputed') }}</span>
											@endif
										</td>
										<td>{{$order->order_id}}</td>
								        <td>{{ $order->created_at->toDayDateTimeString() }}</td>
										<td>{{ $order->customer->name }}</td>
										<td>{{ get_formated_currency($order->grand_total )}}</td>
										<td>{!! $order->paymentStatusName() !!}</td>
										<td>
											<span class="label label-outline" style="background-color: {{ optional($order->status)->label_color }}">
												{{ $order->status ? strToupper(optional($order->status)->name) : trans('app.statuses.new') }}
											</span>
										</td>
										<td class="row-options">
											@can('archive', $order)
												{!! Form::open(['route' => ['admin.order.order.archive', $order->id], 'method' => 'delete', 'class' => 'data-form']) !!}
													{!! Form::button('<i class="fa fa-archive text-muted"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.order_archive'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
												{!! Form::close() !!}
											@endcan
										</td>
									</tr>
								@endunless
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
						<th>{{ trans('Invoice Number') }}</th>
						<th>Order Id</th>
						<th>{{ trans('app.order_date') }}</th>
						<th>{{ trans('app.customer') }}</th>
						<th>{{ trans('app.grand_total') }}</th>
						<th>{{ trans('FSN') }}</th>
						<th>{{ trans('SKU') }}</th>
					</tr>
				</thead>
				<tbody>
					@if((Session::get('order_error_session') != null))
					@foreach(Session::get('order_error_session') as $error_list)
					<tr>
						<th>{{ $error_list['invoice_no'] }}</th>
						<th>{{ $error_list['order_id'] }}</th>
						<th>{{ date('d-m-Y', strtotime($error_list['ordered_on'])) }}</th>
						<th>{{ $error_list['buyer_name'] }}</th>
						<th>{{ $error_list['invoice_amount'] }}</th>
						<th>{{ $error_list['fsn'] }}</th>
						<th>{{ $error_list['sku'] }}</th>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection