@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Withdraw Requests</h3>
	     
	    </div> <!-- /.box-header -->
	    <div class="box-body">
			<table class="table table-hover table-2nd-no-sort">
				<thead>
					<tr>
						<td>Wallet Id</td>
						<th>{{ trans('app.full_name') }}</th>
						<th>{{ trans('app.phone') }}</th>
						<th>{{ trans('app.email') }}</th>
						<th>Balance</th>
						<th>Check Bank Details</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
		        <tbody id="massSelectArea">
				    @foreach($withdraw as $key )
				        <tr>
							<td>{{ $key->wallet_id }}</td>
							<td>{{ $key->name }}</td>
							<td>{{ $key->mobile }}</td>
							<td>{{ $key->email }}</td>
							<td>
								<span class="label label-outline">	&#8377;&nbsp;{{ $key->amount }}</span>
							</td>
							<td>
								<a href="javascript:void(0)" data-link="{{ route('admin.admin.bank_details', $key->customer_id) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="Bank Details" class="fa fa-list"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td><span  class="label label-outline">	{{ $key->status }}</span></td>
							<td>
                            @if($key->status == 'pending' || $key->status == 'declined')
                                <div id="button_delete_id<?=$key->transaction_id?>">
                                <button type="submit"  class="btn bg-green btn-flat" onclick="decline({{$key->transaction_id}})"> <span > Approve </span></button>
                                </div>
                                @else
                                <div id="button_id<?=$key->transaction_id?>">
                                <button type="submit"  class="btn bg-red btn-flat" onclick="approved({{$key->transaction_id}})"><span > Decline</span> </button>
                                </div>
                            @endif   
                            </td>
				        </tr>
				    @endforeach
				</tbody>
			</table>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection
<script>

function approved(bank_id)
{ 
    $.ajax({
				type : "GET",
				data : {bank_id:bank_id},
                url : "/admin/admin/withdraw/test",
				success:function(response)
				{
				//	console.log(response);
                $("#button_id"+bank_id).html("<div id='button_delete_id"+bank_id+"'><button type='submit' class='btn bg-red btn-flat' onclick='decline("+bank_id+")'><span >Decline</span></button></div>");
                }
			});

}
function decline(bank_id)
{
    $.ajax({
				type : "GET",
				data : {bank_id:bank_id},
                url : "/admin/admin/withdraw/test_delete",
				success:function(response)
				{
				//	console.log(response);
               // $("#button_delete_id"+bank_id).html("Add to Catalogs");
               $("#button_delete_id"+bank_id).html("<div id='button_id"+bank_id+"'><button type='submit' class='btn bg-green btn-flat' onclick='approved("+bank_id+")'><span>Approve</span></button></div>");
                }
			});
}
</script>