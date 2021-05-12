@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Matket Place</h3>
	      <div class="box-tools pull-right">
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
		        			<td><img src="{{ get_storage_file_url(optional($row->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.image') }}">
							<p class="indent10">
								{{ $row->name }}
							</p></td>
		        			<td>{{$row->nice_name}}</td>
		        			<td>{{$row->email}}</td>
		        			<td>{{$row->active}}</td>
		        			<td class="row-options">
		        				<!-- <a href="{{ route('admin.stock.pricelist.marketplace-pricelist') }}?id={{$row->id}}"><i data-toggle="tooltip" data-placement="top" title="Price List" class="fa fa-money"></i></a>&nbsp; -->
		        				<!-- <a href="{{ url('admin/stock/listing') }}?id={{$row->id}}" ><i data-toggle="tooltip" data-placement="top" title="Listing" class="fa fa-gg"></i></a>&nbsp; -->
		        				<a href="{{ route('admin.stock.pricelist.marketplace-warehouse') }}?id={{$row->id}}"  class=""><i data-toggle="tooltip" data-placement="top" title="WareHouse" class="fa fa-file-word-o"></i></a>&nbsp;
		        				<a href="{{ url('admin/stock/marketplace-inventory') }}?id={{$row->id}}"  class=""><i data-toggle="tooltip" data-placement="top" title="Inventory" class="fa fa-cart-arrow-down"></i></a>&nbsp;
		        				<a href="{{ url('admin/stock/marketplace-orders') }}?id={{$row->id}}"  class=""><i data-toggle="tooltip" data-placement="top" title="Orders" class="fa fa-shopping-bag"></i></a>&nbsp;
		        				<a href="{{ url('admin/stock/marketplace-previous-orders') }}?id={{$row->id}}"  class=""><i data-toggle="tooltip" data-placement="top" title="Previous Orders" class="fa fa-gg"></i></a>&nbsp;
		        				<a href="{{ url('admin/stock/marketplace-return') }}?id={{$row->id}}"  class=""><i data-toggle="tooltip" data-placement="top" title="Return" class="fa fa-archive"></i></a>&nbsp;
		        				<a href="{{ url('admin/stock/marketplace-payment') }}?id={{$row->id}}"  class=""><i data-toggle="tooltip" data-placement="top" title="Payment" class="fa fa-credit-card"></i></a>&nbsp;
		        				<a href="{{ url('admin/stock/marketplace-report') }}?id={{$row->id}}"  class=""><i data-toggle="tooltip" data-placement="top" title="Report" class="fa fa-database"></i></a>&nbsp;
						</td>
		        		</tr>
		        	@endforeach
		        </tbody>
		    </table>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection