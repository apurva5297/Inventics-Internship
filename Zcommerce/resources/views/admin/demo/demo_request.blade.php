@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('Demo Request') }}</h3>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
			<table class="table table-hover table-2nd-short">
				<thead>
					<tr>
					  <th>{{ trans('Name') }}</th>
					  <th>{{ trans('Company Name') }}</th>
					  <th>{{ trans('app.email') }}</th>
					  <th>{{ trans('app.phone') }}</th>
					  <th>{{ trans('Schedule Date') }}</th>
					</tr>
				</thead>
				<tbody>
				    @foreach($demo_requests as $row )
				        <tr>
							<td>{{$row->name}}</td>
							<td>{{ $row->company_name }}</td>
							<td>{{ $row->email }}</td>
							<td>{{ $row->phone }}</td>
				          	<td>@if($row->schedule_date)
				          			{{ date('d M Y H:i:s',strtotime($row->schedule_date))}}
				          		@else
				          			Any Time
				          		@endif
				          	</td>
				        </tr>
				    @endforeach
				</tbody>
			</table>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->

	
@endsection