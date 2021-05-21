@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Transaction List</h3>
	     
	    </div> <!-- /.box-header -->
	    <div class="box-body">
			<table class="table table-hover table-2nd-no-sort">
            <thead>
					<tr>
						<th>ID</th>
						<th>Transaction ID</th>
						<th>Source</th>
						<th>Amount</th>
						<th>Trans. Type</th>
						<th>Status</th>
					</tr>
				</thead>
		        <tbody>
				   @foreach($transactions as $transaction)
                   <tr>
                   <td>{{$transaction->id}}</td>
                    <td>{{$transaction->transaction_id}}</td>
                    <td>{{$transaction->source}}</td>
                    <td>{{$transaction->amount}}</td>
                    @if($transaction->trans_type == 'credit')
                    <td><span class="label label-success">Credit&nbsp;<i class="fa fa-arrow-up"></i></span></td>
                    @else
                    <td><span class="label label-danger">Debit&nbsp;<i class="fa fa-arrow-down"></i></span></td>
                    @endif
                    @if($transaction->status == 'pending')
                    <td>Pending</td>
                    @else
                    <td>Approved</td>
                    @endif
                   </tr>
                   @endforeach
				</tbody>
			</table>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->

	
@endsection