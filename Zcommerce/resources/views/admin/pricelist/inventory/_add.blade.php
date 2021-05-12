<div class="box collapsed-box">
	<div class="box-header with-bcart">
		<h3 class="box-title"><i class="fa fa-cubes"></i> </h3>
		<div class="box-tools pull-right">
			<a href="{{ route('admin.stock.pricelist.bulk',Request::segment(4)) }}" class="ajax-modal-btn btn btn-default btn-flat">{{ trans('app.bulk_import') }}</a>
			<a href="{{ route('admin.stock.pricelist.pricelist_csv',Request::segment(4)) }}" class="btn btn-default btn-flat">Download CSV</a>
			<input type="hidden" name="pricelist_csv_id" id="pricelist_csv_id" value="{{Request::segment(4)}}">
		</div>
	</div> <!-- /.box-header -->
	<div class="box-body">

        @if(auth()->user()->shop->canAddMoreInventory())
	        <div class="form-group">
	          <div class="input-group input-group-lg">
	            <span class="input-group-addon"> <i class="fa fa-search text-muted"></i> </span>
	            {!! Form::text('searchProduct', null, ['id' => 'searchProduct', 'class' => 'form-control', 'placeholder' => trans('app.placeholder.search_product')]) !!}
	          </div>
	        </div>
	        <div id="productFounds"></div>
        @else
        	@include('admin.partials._max_inventory_limit_notice')
    	@endif
	</div> <!-- /.box-body -->
</div> <!-- /.box -->