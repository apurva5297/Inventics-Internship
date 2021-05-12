@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('Master Category') }}</h3>
	      <div class="box-tools pull-right">
			
				<a href="{{ route('admin.catalog.mastercategory.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('Add Master Category') }}</a>
	      </div>
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-2nd-short">
	        <thead>
	        <tr>
			  <th>{{ trans('app.cover_image') }}</th>
	          <th>{{ trans('Name') }}</th>
	          <th>Status</th>
	          <th>{{ trans('app.option') }}</th>
	        </tr>
	        </thead>
	        <tbody>
		        @foreach($master_categories as $category )
			        <tr>
			          	<td>
							<img src="{{asset($category->image)}}" class="img-sm" alt="{{ trans('app.image') }}">
			          	</td>
			          	<td>
			          		<h5>
			          			{{ $category->name }}
			          		</h5>
			          	</td>
				        <td>{{$category->status == 1 ? 'Active':'In-Active'}}</td>
				        <td class="row-options">
		                	    <a href="{{ route('admin.catalog.mastercategory.edit', $category->cate_id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
			                    {!! Form::open(['route' => ['admin.catalog.mastercategory.trash', $category->cate_id], 'method' => 'delete', 'class' => 'data-form']) !!}
			                        {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
								{!! Form::close() !!}
						</td>
			        </tr>
		        @endforeach
	        </tbody>
	      </table>
	    </div>
	    <!-- /.box-body -->
	</div>
	<!-- /.box -->
@endsection