@extends('admin.layouts.master')

@section('content')
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('product mapping') }}</h3>

		    <div class="pull-right" style="margin-left:5px;">
				<button class=" btn btn-new btn-flat" id="mappnow">{{ trans('map product') }}</button>
			</div>
			<div class="pull-right">
				<div class="form-group">
		          {!! Form::select('category_list[]', $category , Null, ['class' => 'form-control select2-normal', 'multiple' => 'multiple', 'required']) !!}
		          <div class="help-block with-errors"></div>
		    	</div>
		    </div>
		</div> <!-- /.box-header -->
		<div class="box-body">
		    <table class="table table-hover" id="all-mapping-table">
		        <thead>
					<tr>
						<th>{{ trans('app.name') }}</th>
						<th>{{ trans('app.gtin') }}</th>
						<th>{{ trans('app.model_number') }}</th>
						<th width="20%">{{ trans('app.category') }}</th>
						<th>{{ trans('app.listing') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
		        </thead>
		        <tbody>
		        </tbody>
		    </table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection
