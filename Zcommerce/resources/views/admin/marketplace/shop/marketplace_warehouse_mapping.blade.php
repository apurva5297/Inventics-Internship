@extends('admin.layouts.master')

@section('content')
	<div class="box collapsed-box">
		<div class="box-header with-bcart">
			<h3 class="box-title"><i class="fa fa-cubes"></i> </h3>
			<div class="box-tools pull-right">
				<a href="{{ route('admin.stock.pricelist.marketplacewarehouse',$_GET['id']) }}" class="ajax-modal-btn btn btn-primary btn-flat">Add Warehouse</a>
			</div>
		</div> <!-- /.box-header -->
	</div> <!-- /.box -->
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Matket Place Warehouse Mapping</h3>
	      <div class="box-tools pull-right">
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
		    <table class="table table-hover table-option">
		        <thead>
			        <tr>
			          <th>Market Place</th>
			          <th>Warehouse Name</th>
			          <th>Description</th>
			          <th>Status</th>
			          <th>{{ trans('app.option') }}</th>
			        </tr>
		        </thead>
		        <tbody>
		        	@foreach($warehouse as $row)
		        		<tr>
		        			<td>
							<p class="indent10">
								{{ $row->marketplace_name }}
							</p></td>
		        			<td>{{ $row->warehouses_name }}</td>
		        			<td>{!! htmlspecialchars_decode($row->description) !!}</td>
		        			<td>{{$row->active}}</td>
		        			<td class="row-options">
		        				{!! Form::open(['route' => ['admin.stock.pricelist.marketplaceWarehouseDelete', $row->map_warehouse_id], 'method' => 'delete', 'class' => 'data-form']) !!}
									{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => 'Delete', 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
								{!! Form::close() !!}
						</td>
		        		</tr>
		        	@endforeach
		        </tbody>
		    </table>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection