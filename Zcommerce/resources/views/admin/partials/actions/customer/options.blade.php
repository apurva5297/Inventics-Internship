@can('view', $customer)
    <a href="{{ route('admin.admin.customer.show', $customer->id) }}" class="ajax-modal-btn modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.profile') }}" class="fa fa-user-circle-o"></i></a>&nbsp;
@endcan

@can('update', $customer)
    <a href="{{ route('admin.admin.customer.edit', $customer->id) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
@endcan

@can('view', $customer)
    <a href="#" onclick="Update_Credit(this)" data-toggle="modal" data-target="#myModal" cuid="{{ $customer->id }}" cu_name="{{ $customer->name }}"><i  title="{{ trans('Credit') }}" class="fa fa-dollar"></i></a>&nbsp;
@endcan

@can('view', $customer)
	@if($customer->primaryAddress)
		<a href="{{ route('address.addresses', ['customer', $customer->id]) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.show_addresses') }}" class="fa fa-address-card-o"></i></a>&nbsp;
	@else
		<a href="{{ route('address.create', ['customer', $customer->id]) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.add_address') }}" class="fa fa-plus-square-o"></i></a>&nbsp;
	@endif
@endcan

@can('delete', $customer)
    {!! Form::open(['route' => ['admin.admin.customer.trash', $customer->id], 'method' => 'delete', 'class' => 'data-form']) !!}
        {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
	{!! Form::close() !!}
@endcan

{!! Form::open(['route' => ['admin.admin.customer.custcredit', $customer->id], 'method' => 'post', 'class' => 'data-form']) !!}
  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" style="text-align: center;">Update Wallet Amount</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" style="text-align: left;">
        	 
          <div class="form-group">
              <label for="name" class="col-md-4 control-label">Customers</label>
              <div class=" col-md-8">
          {!! Form::text('cust_name',  '', array('class'=>'form-control', 'id'=>'cus_name', 'disabled' => 'disabled')) !!}
          {!! Form::hidden('customers_id',  '', array('class'=>'form-control', 'id'=>'cusid')) !!}

        </div>
      </div>
<br>
<br>
        <div class="form-group">
              <label for="name" class="col-md-4 control-label" >Amount</label>
              <div class="col-md-8" >
               {!! Form::number('amt',  '', array('class'=>'form-control margin-l', 'id'=>'amt','required'))  !!}
               </div>       
        </div>
        <div class="form-group">
              <label for="name" class="col-md-4 control-label" >How Many % Use</label>
              <div class="col-md-8" >
               {!! Form::number('use',  '', array('class'=>'form-control margin-2', 'id'=>'use','required'))  !!}
               </div>       
        </div>
       
      </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        	<button type="submit" class="btn btn-suceess" style="background-color: #4CAF50 !important;border: none !important;color: white !important;padding: 7px 20px !important;text-align: center !important;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;
            cursor: pointer;">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
 {!! Form::close() !!}

  <script>
  	 function Update_Credit(e) {

    var cuid = $(e).attr('cuid');
    var cu_name = $(e).attr('cu_name');
    $("#cusid").val(cuid);
    $("#cus_name").val(cu_name);

    //alert(cuid);
}
  </script>
  <style>
  	.margin-l{margin-left: 5px;}
    .margin-2{margin-left: -9px;}
  </style>