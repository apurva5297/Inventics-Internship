@extends('admin.layouts.master')

@section('content')
	@can('create', App\Inventory::class)
		@include('admin.pricelist.inventory._add')
	@endcan

	<div class="box">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs nav-justified">
				<li class="{{ Request::has('tab') ? '' : 'active' }}"><a href="#active_inventory_tab" data-toggle="tab">
					<i class="fa fa-superpowers hidden-sm"></i>
					Purchase Price List
				</a></li>
			</ul>
			<div class="tab-content">
			    <div class="tab-pane {{ Request::has('tab') ? '' : 'active' }}" id="active_inventory_tab">
					<table class="table table-hover" id="pricelist_inventory">
						<thead>
							<tr>
								<th>{{ trans('app.image') }}</th>
								<th>{{ trans('app.sku') }}</th>
								<th>{{ trans('app.title') }}</th>
								<th>{{ trans('app.condition') }}</th>
								<th>{{ trans('app.price') }} <small>( {{ trans('app.excl_tax') }} )</small> </th>
								<th>{{ trans('app.quantity') }}</th>
								<th>{{ trans('app.option') }}</th>
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
		
	</div> <!-- /.box -->
@endsection