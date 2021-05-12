<div class="modal-dialog modal-sm">
    <div class="modal-content">
       {!! Form::model($bin, ['method' => 'PUT', 'route' => ['admin.stock.warehouse.update-bin', $bin->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.form.form') }}
        </div>
          <div class="modal-body">
          <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            {!! Form::label('name', trans('app.form.name') . '*') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Bin Name', 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>
        </div>
       
      </div>
      <div class="row">
        <div class="col-md-8 nopadding-right">
          <div class="form-group">
            {!! Form::label('name', 'Code' . '*') !!}
            {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Code', 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-4 nopadding-left">
          <div class="form-group">
            {!! Form::label('active', trans('app.form.status')) !!}
            {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], null, ['class' => 'form-control select2-normal','required', 'placeholder' => trans('app.placeholder.status')]) !!}
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->

