<div class="modal-dialog modal-md">
    <div class="modal-content">
    	{!! Form::open(['route' => 'admin.stock.marketplace_sync.upload', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.form.upload_csv') }}
        </div>
        <div class="modal-body">
            <span class="spacer20"></span>
            <div class="row">
                <div class="col-md-9 nopadding-right">
                    flipkart
                </div>
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('sync'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}   
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->
