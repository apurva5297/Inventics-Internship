@extends('admin.layouts.master')

@section('content')
	@can('create', App\Inventory::class)
		@include('admin.recall._add')
	@endcan

	<div class="box">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs nav-justified">
				<li class="{{ Request::has('tab') ? '' : 'active' }}"><a href="#active_inventory_tab" data-toggle="tab">
					<i class="fa fa-superpowers hidden-sm"></i>
					Pick List
				</a></li>
			</ul>
			<div class="tab-content">
			    <div class="tab-pane {{ Request::has('tab') ? '' : 'active' }}" id="active_inventory_tab">
					<table class="table table-hover table-2nd-short">
						<thead>
							<tr>
								<th>Picklist id</th>
								<th>Total Qty</th>
								<th>Date</th>
								<th>{{ trans('app.option') }}</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($recall as $row) { ?>
								<tr>
									<td>{{ $row->picklist }}</td>
									<td>{{ $row->total_qty }}</td>
									<td>{{ $row->created_at }}</td>
									<td><a href="{{ route('admin.stock.inventory.get_recall',$row->picklist) }}" class="btn btn-success">Download Picklist</a></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection