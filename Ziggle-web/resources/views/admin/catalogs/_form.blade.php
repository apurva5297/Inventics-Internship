<div class="box-body">
	        <div class="form-group">
	          <div class="input-group input-group-lg">
	            <span class="input-group-addon"> <i class="fa fa-search text-muted"></i> </span>
	            {!! Form::text('searchProducts',null, ['id' => 'searchProducts', 'class' => 'form-control', 'placeholder' => trans('app.placeholder.search_product')]) !!}
				<input type="hidden" id="catalog_id" value="{{ $catalog->id }}">
	          </div>
	        </div>
	        <div id="productFounds"></div>
	</div> <!-- /.box-body -->


<!-- <p class="help-block">* {{ trans('app.form.required_fields') }}</p> -->