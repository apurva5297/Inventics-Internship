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
				<li class="{{ Request::has('tab') ? '' : 'active' }}"><a href="#all_orders_tab" data-toggle="tab">
					<i class="fa fa-shopping-cart hidden-sm"></i>
					Return Orders
				</a></li>
			</ul>
			<div class="tab-content">
			    <div class="tab-pane {{ Request::has('tab') ? '' : 'active' }}" id="all_orders_tab">
					<table class="table table-hover table-desc">
						<thead>
							<tr>
								<th>{{ trans('app.order_number') }}</th>
								<th>Return Id</th>
								<th>{{ trans('app.order_date') }}</th>
								<th>{{ trans('app.customer') }}</th>
								<th>{{ trans('app.grand_total') }}</th>
								<th>Return</th>
								<th>{{ trans('app.status') }}</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@foreach($orders as $order )
								<tr>
									<td>
										<a href="{{ route('admin.order.order.show', $order->id) }}">
											{{ $order->order_number }}
										</a>
										@if($order->disputed)
											<span class="label label-danger indent5">{{ trans('app.statuses.disputed') }}</span>
										@endif
									</td>
									<td>{{$order->return_order_id}}</td>
							        <td>{{ $order->created_at->toDayDateTimeString() }}</td>
									<td>{{ $order->customer->name }}</td>
									<td>{{ get_formated_currency($order->grand_total) }}</td>
									<td>Refund</td>
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
			</div>
		</div>
	</div> <!-- /.box -->

	<div class="box collapsed-box">
		<div class="box-header with-border" @if((Session::get('return_error_session') != null)) style="background-color: red" @endif>
			<h3 class="box-title" @if((Session::get('return_error_session') != null)) style="color: #fff" @endif><i class="fa fa-eye-o"></i>{{ trans('Error List') }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus" style="color: #000"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove" style="color: #000"></i></button>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-2nd-short">
				<thead>
					<tr>
						<th>{{ trans('Return Id') }}</th>
						<th>{{ trans('Order Item Id') }}</th>
						<th>{{ trans('Return Reason') }}</th>
						<th>{{ trans('Return Type') }}</th>
						<th>Quantity</th>
						<th>Reverse Logistic Track</th>
						<th>SKU</th>
					</tr>
				</thead>
				<tbody>
					@if((Session::get('return_error_session') != null))
					@foreach(Session::get('return_error_session') as $error_list)
					<tr>
						<td>{{ $error_list[0] }}</td>
						<td>{{ $error_list[1] }}</td>
						<td>{{ $error_list[7] }}</td>
						<td>{{ $error_list[8] }}</td>
						<td>{{ $error_list[15] }}</td>
						<td>{{ $error_list[11] }}</td>
						<td>{{ $error_list[12] }}</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection