<div class="modal-dialog modal-sm">
  <div class="modal-content">
    {!! Form::model($paytm, ['method' => 'PUT', 'route' => ['admin.setting.paytm.update', $paytm], 'id' => 'form', 'data-toggle' => 'validator']) !!}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        {{ trans('app.form.config') . ' Paytm' }}
    </div>
    <div class="modal-body">
        <div class="form-group">
          {!! Form::label('m_id', trans('MID') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('M ID') }}"></i>
          {!! Form::text('m_id', Null, ['class' => 'form-control', 'placeholder' => trans('M ID'), 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          {!! Form::label('m_key', trans('M Key') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('M Key') }}"></i>
          {!! Form::text('m_key', Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.m_key'), 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          {!! Form::label('channel_id', trans('Channel Id') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('Channel Id') }}"></i>
          {!! Form::text('channel_id', Null, ['class' => 'form-control', 'placeholder' => trans('Channel Id'), 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="modal-footer">
        {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
    </div>
    {!! Form::close() !!}
  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->