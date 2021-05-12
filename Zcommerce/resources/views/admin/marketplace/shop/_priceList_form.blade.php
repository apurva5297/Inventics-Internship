<div class="modal-dialog modal-md">
    <div class="modal-content">
    	{!! Form::open(['route' => 'admin.stock.pricelist.marketplace_pricelist', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
			<div class="row">
			  <div class="col-md-8 nopadding-right">
			    <div class="form-group">
			    	<input type="hidden" name="marketpalce_id" value="{{$marketpalce_id}}">
			      {!! Form::label('name', 'Price List' . '*') !!}
			      <select class="form-control" name="pricelist_id" required="">
			      	<option value="0">Sale Price</option>
			      	<option value="00">Purchase Price</option>
			      	@foreach($pricelist as $price)
			      		<option value="{{$price->id}}">{{$price->name}}</option>
			      	@endforeach
			      </select>
			      <div class="help-block with-errors"></div>
			    </div>
			  </div>
			  <div class="col-md-4 nopadding-left">
			    <div class="form-group">
			      {!! Form::label('active', trans('app.form.status')) !!}
			      {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status')]) !!}
			    </div>
			  </div>
			</div>  
			<div class="form-group">
				  {!! Form::label('description', trans('app.form.description')) !!}
				  {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'placeholder' => trans('app.placeholder.description')]) !!}
				</div>          
        </div>
        <div class="modal-footer">
             {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->
