@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Matket Place</h3>
	      <div class="box-tools pull-right">
			@can('create', App\Customer::class)
				
				<a href="{{ url('admin/admin/marketplace-module-mapping/create') }}" class="ajax-modal-btn btn btn-new btn-flat">Add Marketplace Mapping</a>
			@endcan
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
		    <table class="table table-hover table-option">
		        <thead>
			        <tr>
			          <th>{{ trans('app.name') }}</th>
			          <th>{{ trans('Marketplace') }}</th>
			          <th>{{ trans('app.status') }}</th>
			          <th>{{ trans('app.option') }}</th>
			        </tr>
		        </thead>
		        <tbody>
		        	@foreach($marketplace_module as $row)
		        		<tr>
		        			<td>{{$row->MarketplaceModule->name}}</td>
		        			<td>{{$row->Marketplace->name}}</td>
		        			<td>{{$row->status == 1 ? 'Active':'In-Active'}}</td>
		        			<td class="row-options">
		        				
								<a href="{{ url('admin/admin/marketplace-module-mapping/edit', $row->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
								<!-- {!! Form::open(['route' => ['admin.stock.warehouse.delete-bin', $row->id], 'method' => 'delete', 'class' => 'data-form']) !!}
									{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => 'Delete', 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
								{!! Form::close() !!} -->
						</td>
		        		</tr>
		        	@endforeach
		        </tbody>
		    </table>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection