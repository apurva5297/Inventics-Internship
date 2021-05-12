@extends('admin.layouts.master')

@section('content')
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Price List</h3>
			<div class="box-tools pull-right">
					<a href="{{ route('admin.stock.pricelist.create_new') }}" class="ajax-modal-btn btn btn-new btn-flat">Add Price List</a>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-2nd-short">
				<thead>
					<tr>
						<th>Price Type</th>
						<th>Stock</th>
						<th>{{ trans('app.status') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<img src="https://placehold.it/30x30/eee?text=No Image Found" class="img-circle img-sm" alt="{{ trans('app.image') }}">
							<p class="indent10">
								Sale Price
							</p>
						</td>
						<td>{{ App\Helpers\ListHelper::inventory_stock() }}</td>
						<td>{{ true ? trans('app.active') : trans('app.inactive') }}</td>
						<td class="row-options">
							<a href="{{ route('admin.stock.pricelist.add-price-list', 'sale') }}"><i data-toggle="tooltip" data-placement="top" title="Add Price List" class="fa fa-plus"></i></a>&nbsp;
						</td>
					</tr>
					<tr>
						<td>
							<img src="https://placehold.it/30x30/eee?text=No Image Found" class="img-circle img-sm" alt="{{ trans('app.image') }}">
							<p class="indent10">
								Purchase Price
							</p>
						</td>
						<td>{{ App\Helpers\ListHelper::inventory_stock() }}</td>
						<td>{{ true ? trans('app.active') : trans('app.inactive') }}</td>
						<td class="row-options">
							<a href="{{ route('admin.stock.pricelist.add-price-list', 'purchase') }}"><i data-toggle="tooltip" data-placement="top" title="Add Price List" class="fa fa-plus"></i></a>&nbsp;
						</td>
					</tr>
					@foreach($pricelist as $list )
					<tr>
						<td>
							<img src="{{ get_storage_file_url(optional($list->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.image') }}">
							<p class="indent10">
								{{ $list->name }}
							</p>
						</td>
						<td>{{ App\Helpers\ListHelper::inventory_stock() }}</td>
						<td>{{ ($list->active) ? trans('app.active') : trans('app.inactive') }}</td>
						<td class="row-options">
								<a href="{{ route('admin.stock.pricelist.add-price-list', $list->id) }}"><i data-toggle="tooltip" data-placement="top" title="Add Price List" class="fa fa-plus"></i></a>&nbsp;

								<a href="{{ route('admin.stock.pricelist.edit', $list->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
								{!! Form::open(['route' => ['admin.stock.pricelist.trash', $list->id], 'method' => 'delete', 'class' => 'data-form']) !!}
									{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
								{!! Form::close() !!}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->

	<div class="box collapsed-box">
		
	</div> <!-- /.box -->
@endsection