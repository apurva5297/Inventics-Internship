@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Wallets</h3>
	     
	    </div> <!-- /.box-header -->
	    <div class="box-body">
			<table class="table table-hover table-2nd-no-sort">
				<thead>
					<tr>
						<td>ID</td>
						<th>{{ trans('app.full_name') }}</th>
						<th>{{ trans('app.phone') }}</th>
						<th>{{ trans('app.email') }}</th>
						<th>Balance</th>
						<th>Options</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
		        <tbody id="massSelectArea">
				    @foreach($wallets as $wallet )
				        <tr>
							<td>{{ $wallet->id }}</td>
							<td>{{ $wallet->name }}</td>
							<td>{{ $wallet->mobile }}</td>
							<td>{{ $wallet->email }}</td>
							<td>
								<span class="label label-outline">	&#8377;&nbsp;{{ $wallet->balance }}</span>
							</td>
							<td>
								<a class="btn btn-primary btn-sm" href="{{ route('admin.admin.wallets.list', $wallet->id) }}" role="button">Transaction List</a>
							</td>
							<td>&nbsp;</td>
				        </tr>
				    @endforeach
				</tbody>
			</table>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->

	
@endsection