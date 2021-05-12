@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Matket Place</h3>
	      <div class="box-tools pull-right">
			@can('create', App\Customer::class)
				{{--<a href="{{ route('admin.admin.customer.bulk') }}" class="ajax-modal-btn btn btn-default btn-flat">{{ trans('app.bulk_import') }}</a>--}}
				<a href="{{ route('admin.admin.marketplace.create') }}" class="ajax-modal-btn btn btn-new btn-flat">Add Market Place</a>
			@endcan
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
		    <table class="table table-hover table-option">
		        <thead>
			        <tr>
			          <th>{{ trans('app.name') }}</th>
			          <th>{{ trans('app.nice_name') }}</th>
			          <th>{{ trans('app.email') }}</th>
			          <th>{{ trans('app.status') }}</th>
			          <th>{{ trans('app.option') }}</th>
			        </tr>
		        </thead>
		        <tbody>
		        	@foreach($marketplace as $row)
		        		<tr>
		        			<td>{{$row->name}}</td>
		        			<td>{{$row->nice_name}}</td>
		        			<td>{{$row->email}}</td>
		        			<td>{{$row->active}}</td>
		        			<td class="row-options">
		        				<a href="{{ route('admin.admin.marketplace.edit', $row->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="Rupee" class="fa fa-rupee"></i></a>&nbsp;
								<a href="{{ route('admin.admin.marketplace.edit', $row->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
								{!! Form::open(['route' => ['admin.stock.warehouse.delete-bin', $row->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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