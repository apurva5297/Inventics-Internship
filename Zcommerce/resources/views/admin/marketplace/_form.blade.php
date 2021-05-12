<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.full_name').'*') !!}
      {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.full_name'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('active', trans('app.form.status').'*') !!}
      {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('nice_name', trans('app.form.nice_name') ) !!}
      {!! Form::text('nice_name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.nice_name')]) !!}
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('email', trans('app.form.email_address').'*' ) !!}
      {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.valid_email'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>


<div class="form-group">
  <label for="exampleInputFile">{{ trans('app.form.avatar') }}</label>
  @if(isset($customer) && Storage::exists(optional($customer->image)->path))
  <label>
    <img src="{{ get_storage_file_url(optional($customer->image)->path, 'small') }}" width="" alt="{{ trans('app.avatar') }}">
    <span style="margin-left: 10px;">
      {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_avatar') }}
    </span>
  </label>
  @endif
  <div class="row">
    <div class="col-md-9 nopadding-right">
      <input id="uploadFile" placeholder="{{ trans('app.placeholder.avatar') }}" class="form-control" disabled="disabled" style="height: 28px;" />
    </div>
    <div class="col-md-3 nopadding-left">
      <div class="fileUpload btn btn-primary btn-block btn-flat">
          <span>{{ trans('app.form.upload') }}</span>
          <input type="file" name="image" id="uploadBtn" class="upload" />
      </div>
    </div>
  </div>
</div>
<p class="help-block">* {{ trans('app.form.required_fields') }}</p>