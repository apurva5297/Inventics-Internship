<div class="box collapsed-box">
	<div class="box-header with-bcart" style="padding:0px">
		
		<div class="pull-right">
			@if(Request::segment(3)=='listing')
				<a href="{{asset('csv_templates/InventoryFlipkartListingIdMapping.csv')}}" class="btn btn btn-default btn-flat">Download CSV Format</a>
				<a href="{{ route('admin.stock.pricelist.marketplacebulk','listing?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat">Upload Listing ID</a>
				<input type="hidden" name="pricelist_csv_id" id="pricelist_csv_id" value="{{Request::segment(3)}}">

			@elseif(Request::segment(3)== 'marketplace-orders')
				<a href="{{asset('csv_templates/flipkart_order.csv')}}" class="btn btn btn-default btn-flat" style="float:right">CSV Format</a>
				<a href="{{ route('admin.stock.pricelist.marketplacebulk','Orders?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat" style="float:left">Upload Orders</a>

			@elseif(Request::segment(3)== 'marketplace-previous-orders')
				<a href="{{asset('csv_templates/flipkart_previous_order.csv')}}" class="btn btn btn-default btn-flat" style="float:right">CSV Format</a>
				<a href="{{ route('admin.stock.pricelist.marketplacebulk','PreviousOrders?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat" style="float:left">Upload Orders</a>

			@elseif(Request::segment(3)== 'marketplace-return')
				<a href="{{asset('csv_templates/flipkart_return.csv')}}" class="btn btn btn-default btn-flat">CSV Format</a>
				<a href="{{ route('admin.stock.pricelist.marketplacebulk','Return?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat">Upload Return</a>
			@elseif(Request::segment(3)== 'marketplace-payment')
				<div>
					<span style="float:left"><a href="{{asset('csv_templates/flipkart_order_payment.csv')}}" class="btn btn btn-default btn-flat">CSV Order Payment</a></span>
					<span style="float:left"><a href="{{ route('admin.stock.pricelist.marketplacebulk','OrderPayment?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat">Upload Order Payment</a></span>

					<span style="float:left"><a href="{{asset('csv_templates/flipkart_storage_recall_payment.csv')}}" class="btn btn btn-default btn-flat">CSV Storage Recall</a></span>
					<span style="float:left"><a href="{{ route('admin.stock.pricelist.marketplacebulk','StorageRecallPayment?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat">Upload Storage Recall</a></span>

					<span style="float:left"><a href="{{asset('csv_templates/flipkart_non_order_spf.csv')}}" class="btn btn btn-default btn-flat">CSV Non Order SPF</a></span>
					<span style="float:left"><a href="{{ route('admin.stock.pricelist.marketplacebulk','NonOrderSpfPayment?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat">Upload Non Order SPF</a></span>

					<span style="float:left"><a href="{{asset('csv_templates/flipkart_ads.csv')}}" class="btn btn btn-default btn-flat">CSV Ads</a></span>
					<span style="float:left"><a href="{{ route('admin.stock.pricelist.marketplacebulk','AdsPayment?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat">Upload Ads</a></span>

					<span style="float:left"><a href="{{asset('csv_templates/flipkart_tax_details.csv')}}" class="btn btn btn-default btn-flat">CSV Tax Details</a></span>
					<span style="float:left"><a href="{{ route('admin.stock.pricelist.marketplacebulk','TaxDetailsPayment?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat">Upload Tax Details</a></span>

					<span style="float:left"><a href="{{asset('csv_templates/flipkart_tax_details.csv')}}" class="btn btn btn-default btn-flat">CSV Tcs Recovery</a></span>
					<span style="float:left"><a href="{{ route('admin.stock.pricelist.marketplacebulk','TcsRecoveryPayment?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat">Upload Tcs Recovery</a></span>

				</div>



			@elseif(Request::segment(3)== 'marketplace-order-payment')
				<div><span style="float:left"><a href="{{asset('csv_templates/flipkart_order_payment.csv')}}" class="btn btn btn-default btn-flat">CSV Format</a></span>
				<span style="float:left"><a href="{{ route('admin.stock.pricelist.marketplacebulk','OrderPayment?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat">Order Payment</a></span></div>




			@elseif(Request::segment(3)== 'marketplace-report')
				<!-- <a href="{{ route('admin.stock.pricelist.marketplacebulk','Report?marketplace_id='.$_GET['id']) }}" class="btn btn-default btn-flat">Get Report</a> -->
			@else
				<a href="{{ route('admin.stock.marketplace.page','Attribute?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat">Upload CSV</a>
				<!-- <a href="{{asset('csv_templates/AttributeFlipkart.csv')}}" class="btn btn btn-default btn-flat">Attribute CSV Format</a> -->
				<!-- <a href="{{ route('admin.stock.pricelist.marketplacebulk','Attribute?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat">Upload Attribute</a> -->
				<a href="{{asset('csv_templates/FSN.csv')}}" class="btn btn btn-default btn-flat">FSN CSV Format</a>
				<a href="{{ route('admin.stock.pricelist.marketplacebulk','FSNNO?marketplace_id='.$_GET['id']) }}" class="ajax-modal-btn btn btn-default btn-flat">Upload FSN No</a>
				<input type="hidden" name="pricelist_csv_id" id="pricelist_csv_id" value="{{Request::segment(3)}}">
			@endif
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