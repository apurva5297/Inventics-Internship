<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.collection_name').'*') !!}
      <div class="input-group">
        {!! Form::text('name', $catalog->catalog_name, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.collection_name'), 'required']) !!}
        <span class="input-group-addon" id="basic-addon1">
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.collection_name') }}"></i>
        </span>
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
    {!! Form::label('active', trans('app.form.status').'*', ['class' => 'with-help']) !!}
      <div class="input-group">
      {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], !isset($catalog) ? 1 : null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>