@extends('admin.layouts.master')

@section('content')
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
		
	</div> <!-- /.box -->
@endsection