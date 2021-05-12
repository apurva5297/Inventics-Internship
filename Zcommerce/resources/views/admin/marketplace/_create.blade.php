<style>
.datepicker{
    z-index: 1200 !important;
}
</style>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
    	{!! Form::open(['route' => 'admin.admin.marketplace.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
	        @include('admin.marketplace._form')
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->


