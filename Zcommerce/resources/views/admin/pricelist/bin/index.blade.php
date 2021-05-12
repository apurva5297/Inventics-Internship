@extends('admin.layouts.master')

@section('content')
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Bin</h3>
			<div class="box-tools pull-right">
				<a href="{{ route('admin.stock.warehouse.bin_csv_bulk',isset($warehouseZoneGroup[0]['id'])?$warehouseZoneGroup[0]['id']:'0') }}" class="ajax-modal-btn btn btn-default btn-flat">{{ trans('app.bulk_import') }}</a>
			<a href="{{ route('admin.stock.warehouse.bin_csv') }}" class="btn btn-default btn-flat">Download CSV</a>
				@can('create', App\Warehouse::class)
					<a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-new btn-flat">Create Bin</a>
				@endcan
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-2nd-short">
				<thead>
					<tr>
						<th>{{ trans('app.name') }}</th>
						<th>Code</th>
						<th>Zone Name</th>
						<th>{{ trans('app.status') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($bins as $bin )
					<tr>
						<td>
							<!-- <img src="{{ get_storage_file_url(optional($bin->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.image') }}">
							<p class="indent10"> -->
								{{ $bin->name }}
							</p>
						</td>
						<td>{{$bin->code}}</td>
						<td>{{$zonegroup->name}}</td>
						<td>{{ ($bin->active) ? trans('app.active') : trans('app.inactive') }}</td>
						<td class="row-options">
				
								<!-- <a href="{{ route('admin.stock.warehouse.create-zone-group', $bin->id) }}"><i data-toggle="tooltip" data-placement="top" title="Create Bin" class="fa fa-plus"></i></a>&nbsp; -->

								<a href="{{ route('admin.stock.warehouse.edit-bin', $bin->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
								{!! Form::open(['route' => ['admin.stock.warehouse.delete-bin', $bin->id], 'method' => 'delete', 'class' => 'data-form']) !!}
									{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => 'Delete', 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
								{!! Form::close() !!}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
<!-- Model -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Bin</h4>
        </div>
        {!! Form::open(['route' => 'admin.stock.warehouse.create-bin', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-body">
        	<div class="row">
			  <div class="col-md-12">
			    <div class="form-group">
			    	<input type="hidden" name="warehouse_zone_group_id" value="{{ isset($zonegroup->id)?$zonegroup->id:0 }}">
			      {!! Form::label('name', trans('app.form.name') . '*') !!}
			      {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Bin Name', 'required']) !!}
			      <div class="help-block with-errors"></div>
			    </div>
			  </div>
			 
			</div>
			<div class="row">
			  <div class="col-md-8 nopadding-right">
			    <div class="form-group">
			      {!! Form::label('name', 'Code' . '*') !!}
			      {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Code', 'required']) !!}
			      <div class="help-block with-errors"></div>
			    </div>
			  </div>
			  <div class="col-md-4 nopadding-left">
			    <div class="form-group">
			      {!! Form::label('active', trans('app.form.status')) !!}
			      {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], null, ['class' => 'form-control select2-normal','required', 'placeholder' => trans('app.placeholder.status')]) !!}
			      <div class="help-block with-errors"></div>
			    </div>
			  </div>
			</div>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        {!! Form::close() !!}
      </div>
      
    </div>
  </div>

@endsection