<div class="box collapsed-box">
	<div class="box-header with-bcart">
		<h3 class="box-title"><i class="fa fa-cubes"></i> </h3>
		<div class="box-tools pull-right">
			<a href="{{ route('admin.stock.inventory.inward_bulk') }}" class="ajax-modal-btn btn btn-default btn-flat">{{ trans('app.bulk_import') }}</a>
			<a href="{{ route('admin.stock.inventory.inward_csv') }}" class="btn btn-default btn-flat">Download CSV</a>
			{{--<button type="button" class="btn btn-new btn-flat" data-widget="collapse"><i class="fa fa-plus"></i> {{ trans('app.add_inventory') }}</button>--}}
		</div>
	</div> <!-- /.box-header -->
