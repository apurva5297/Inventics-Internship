{!! Form::open(['route' => 'admin.stock.inventory.inward-store', 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}

<div class="nav-tabs-custom">
			<div class="tab-content">
			  <div class="row">
			  	<div class="col-md-6">
			  		<div class="admin-user-widget">
					    <span class="admin-user-widget-img">
					        <img src="https://placehold.it/100x100/eee?text=No Image Found" class="thumbnail" alt="Image">
					    </span>
					    <div class="admin-user-widget-content">
					        <span class="admin-user-widget-title">
					            {{$inventory->title}}
					        </span>
					        <span class="admin-user-widget-text text-muted">
					            Sku : {{$inventory->sku}}
					        </span>
					        <span class="admin-user-widget-text text-muted">
					            Stock Quantity: {{$inventory->stock_quantity}}
					        </span>
					        <span class="admin-user-widget-text text-muted">
					            Brand: {{$inventory->brand}}
					        </span>
					    </div>
					</div>
			  	</div>
			  	<input type="hidden" name="inventory_id" value="{{$inventory->id}}">
				  <div class="col-md-6">
				    <div class="" id="add-more-bin">
				    	<div class="row">
				          <div class="col-md-6">
				            <div class="form-group">
				              {!! Form::label('title', 'Qty'.'*') !!}
				              {!! Form::text('qty[]', null, ['class' => 'form-control', 'placeholder' =>'Qty', 'required']) !!}
				              <div class="help-block with-errors"></div>
				            </div>
				          </div>
				            <div class="col-md-6">
				            <div class="form-group">
				              {!! Form::label('title', 'Bin Code'.'*') !!}
				              {!! Form::text('bin[]', null, ['class' => 'form-control', 'placeholder' =>'Bin', 'required']) !!}
				              <div class="help-block with-errors"></div>
				            </div>
				          </div>
				    	</div>
				    	<div class="row">
				          <div class="col-md-6">
				            <div class="form-group">
				              {!! Form::label('title', 'Qty'.'*') !!}
				              {!! Form::text('qty[]', null, ['class' => 'form-control', 'placeholder' =>'Qty', '']) !!}
				              <div class="help-block with-errors"></div>
				            </div>
				          </div>
				            <div class="col-md-6">
				            <div class="form-group">
				              {!! Form::label('title', 'Bin Code'.'*') !!}
				              {!! Form::text('bin[]', null, ['class' => 'form-control', 'placeholder' =>'Bin', '']) !!}
				              <div class="help-block with-errors"></div>
				            </div>
				          </div>
				    	</div>
				    	<div class="row">
				          <div class="col-md-6">
				            <div class="form-group">
				              {!! Form::label('title', 'Qty'.'*') !!}
				              {!! Form::text('qty[]', null, ['class' => 'form-control', 'placeholder' =>'Qty', '']) !!}
				              <div class="help-block with-errors"></div>
				            </div>
				          </div>
				            <div class="col-md-6">
				            <div class="form-group">
				              {!! Form::label('title', 'Bin Code'.'*') !!}
				              {!! Form::text('bin[]', null, ['class' => 'form-control', 'placeholder' =>'Bin', '']) !!}
				              <div class="help-block with-errors"></div>
				            </div>
				          </div>
				    	</div>
				    	<div class="row" id="get-more-bin">
				          <div class="col-md-6">
				            <div class="form-group">
				              {!! Form::label('title', 'Qty'.'*') !!}
				              {!! Form::text('qty[]', null, ['class' => 'form-control', 'placeholder' =>'Qty', '']) !!}
				              <div class="help-block with-errors"></div>
				            </div>
				          </div>
				            <div class="col-md-6">
				            <div class="form-group">
				              {!! Form::label('title', 'Bin Code'.'*') !!}
				              {!! Form::text('bin[]', null, ['class' => 'form-control', 'placeholder' =>'Bin', '']) !!}
				              <div class="help-block with-errors"></div>
				            </div>
				          </div>
				    	</div>
				  </div>
				  <div class="row">
		          <div class="col-md-6">
		            <div class="form-group">
		              <input type="submit" class="btn btn-primary" name="Add">
		            </div>
		          </div>
		            <div class="col-md-6">
		            <div class="form-group"  style="float: right;">
		              <span class="btn btn-primary" onclick="addMoreBinRow(this)">Add More Bin</spna>
		            </div>
		          </div>
		    	</div>
				</div>
			</div>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
 {!! Form::close() !!}	