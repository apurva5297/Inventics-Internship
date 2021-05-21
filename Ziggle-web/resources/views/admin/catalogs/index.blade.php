@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.collection') }}</h3>
	      <div class="box-tools pull-right">
			@can('create', App\Attribute::class)
				<a href="javascript:void(0)" data-link="{{ route('admin.catalog.catalogs.create') }}" class="ajax-modal-btn btn btn-new btn-flat">Add Collection</a>
			@endcan
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-2nd-no-sort" id="sortable" data-action="{{ Route('admin.catalog.attribute.reorder') }}">
	        <thead>
		        <tr>
                    <th class="massActionWrapper">
                        <!-- Check all button -->
                        <div class="btn-group ">
                            <button type="button" class="btn btn-xs btn-default checkbox-toggle">
                                <i class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="{{ trans('app.select_all') }}"></i>
                            </button>
                            <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">{{ trans('app.toggle_dropdown') }}</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="javascript:void(0)" data-link="{{ route('admin.catalog.attribute.massTrash') }}" class="massAction " data-doafter="reload"><i class="fa fa-trash"></i> {{ trans('app.trash') }}</a></li>
                                <li><a href="javascript:void(0)" data-link="{{ route('admin.catalog.attribute.massDestroy') }}" class="massAction " data-doafter="reload"><i class="fa fa-times"></i> {{ trans('app.delete_permanently') }}</a></li>
                            </ul>
                        </div>
                    </th>
					<th>{{ trans('app.name') }}</th>
					
					<th>{{ trans('app.products') }}</th>
					<th>{{ trans('app.status') }}</th>
					<th>{{ trans('app.option') }}</th>
		        </tr>
	        </thead>
	        <tbody id="massSelectArea">
		        @foreach($catalogs as $catalog )
			        <tr id="{{ $catalog->id }}">
						<td><input id="{{ $catalog->id }}" type="checkbox" class="massCheck"></td>
						<td>{{ $catalog->catalog_name }}</td>
						<td>
							@foreach($catalog->products as $product)
							<span class="label label-default">{{ $product->gtin }}</span>
							@endforeach
						</td>
						@if($catalog->active == 1)
						<td>Active</td>
						@else
						<td>Inactive</td>
						@endif
						<td class="row-options">
                        <a href="javascript:void(0)" data-link="{{ route('admin.catalog.catalogs.products', $catalog->id) }}" class="ajax-modal-btn btn btn-new btn-flat"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.products') }}" class="fa fa-plus"></i></a>&nbsp;
						{!! Form::open(['route' => ['admin.catalog.catalogs.destroy', $catalog->id], 'method' => 'delete', 'class' => 'data-form']) !!}
								    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
						{!! Form::close() !!}
						<a href="javascript:void(0)" data-link="{{ route('admin.catalog.catalogs.edit', $catalog->id) }}"  class="ajax-modal-btn btn btn-new btn-flat"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
						</td>
			        </tr>
		        @endforeach
	        </tbody>
	      </table>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->

@endsection

@section('page-script')
	@include('plugins.drag-n-drop')
@endsection