<div class="modal-dialog modal-md">
    <div class="modal-content">
        {!! Form::model($state, ['method' => 'PUT', 'route' => ['admin.setting.state.update', $state->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
            @include('admin.state._form')
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->