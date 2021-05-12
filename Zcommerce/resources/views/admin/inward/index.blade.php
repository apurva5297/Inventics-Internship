@extends('admin.layouts.master')

@section('content')
	@can('create', App\Inventory::class)
		@include('admin.inward._add')
	@endcan

		<div class="form-group">
          <div class="input-group input-group-lg">
            <span class="input-group-addon"> <i class="fa fa-search text-muted"></i> </span>
            {!! Form::text('searchProduct', null, ['id' => 'binsearchInventory', 'class' => 'form-control', 'placeholder' => 'Search a Inventory by its SKU, ListingId or Title']) !!}
          </div>
        </div>
        <div id="productFounds"></div>
    <?php if(False){?>
	 <div class="box collapsed-box">
		<div class="box-header with-bcart">
			<h3 class="box-title"><i class="fa fa-cubes"></i> </h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-new btn-flat" data-widget="collapse"><i class="fa fa-plus"></i> Inward Inventory</button>
			</div>
		</div> <!-- /.box-header -->

		<div class="box-body">

	        @if(auth()->user()->shop->canAddMoreInventory())
		        <div class="form-group">
		          <div class="input-group input-group-lg">
		            <span class="input-group-addon"> <i class="fa fa-search text-muted"></i> </span>
		            {!! Form::text('searchProduct', null, ['id' => 'binsearchInventory', 'class' => 'form-control', 'placeholder' => trans('app.placeholder.search_product')]) !!}
		          </div>
		        </div>
		        <div id="productFounds"></div>
	        @else
	        	<!-- @include('admin.partials._max_inventory_limit_notice') -->
	        	<div class="form-group">
		          <div class="input-group input-group-lg">
		            <span class="input-group-addon"> <i class="fa fa-search text-muted"></i> </span>
		            {!! Form::text('searchProduct', null, ['id' => 'binsearchInventory', 'class' => 'form-control', 'placeholder' => trans('app.placeholder.search_product')]) !!}
		          </div>
		        </div>
		        <div id="productFounds"></div>
	    	@endif
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
	<?php } ?>
	<div class="box" id="inventoryFounds">
@endsection