@extends('admin.layouts.master')

@section('content')
	@can('create', App\Inventory::class)
		@include('admin.marketplace.shop._add')
	@endcan
	<div class="box">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs nav-justified">
				<li class="{{ Request::has('tab') ? '' : 'active' }}"><a href="#active_inventory_tab" data-toggle="tab">
					<i class="fa fa-superpowers hidden-sm"></i>
					Markte Place Inventory
				</a></li>
			</ul>
			<div class="tab-content">
			    <div class="tab-pane {{ Request::has('tab') ? '' : 'active' }}" id="active_inventory_tab">
					<table class="table table-hover" id="marketplace_inventory">
						<thead>
							<tr>
								<th>{{ trans('app.image') }}</th>
								<th>{{ trans('app.sku') }}</th>
								<th>{{ trans('app.title') }}</th>
								<th>Sub Cateogry</th>
								<th>MRP</th>
								<th>Your Price</th>
								<th>Usual Price</th>
								<th>Flipkart Listing Id</th>
								<!-- <th>Attribute</th> -->
								<th>FSN</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div> <!-- /.box-body -->
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
						<th>{{ trans('app.image') }}</th>
						<th>{{ trans('app.sku') }}</th>
						<th>{{ trans('app.title') }}</th>
						<th>Sub Cateogry</th>
						<th>MRP</th>
						<th>Your Price</th>
						<th>Usual Price</th>
						<th>Flipkart Listing Id</th>
						<!-- <th>Attribute</th> -->
						<th>FSN</th>
					</tr>
				</thead>
				<tbody>
					@if((Session::get('listing_error_session') != null))
					@foreach(Session::get('listing_error_session') as $error_list)
					<tr>
						<th></th>
						<th>{{$error_list[5]}}</th>
						<th>{{$error_list[3]}}</th>
						<th>{{$error_list[2]}}</th>
						<th>{{$error_list[5]}}</th>
						<th>{{$error_list[6]}}</th>
						<th>{{$error_list[7]}}</th>
						<th>{{$error_list[0]}}</th>
						<!-- <th>Attribute</th> -->
						<th>{{$error_list[1]}}</th>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection