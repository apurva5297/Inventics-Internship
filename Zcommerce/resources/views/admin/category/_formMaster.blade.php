<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.category_name').'*') !!}
      {!! Form::text('name', null, ['class' => 'form-control makeSlug', 'placeholder' => trans('app.placeholder.category_name'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('active', trans('app.form.status').'*') !!}
      {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="form-group">
  {!! Form::label('exampleInputFile', trans('app.form.cover_img'), ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.cover_img', ['page' => trans('app.category')]) }}"></i>
  @if(isset($master_category) && Storage::exists(($master_category->image)))
    <img src="{{ get_storage_file_url(($category->image), 'small') }}" width="" alt="{{ trans('app.cover_image') }}">
    <span style="margin-left: 10px;">
      {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
    </span>
  @endif
	<div class="row">
      <div class="col-md-9 nopadding-right">
        <input id="uploadFile" placeholder="{{ trans('app.placeholder.category_image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
        <div class="help-block with-errors">{{ trans('help.cover_img_size') }}</div>
      </div>
      <div class="col-md-3 nopadding-left">
  			<div class="fileUpload btn btn-primary btn-block btn-flat">
  			    <span>{{ trans('app.form.upload') }} </span>
  			    <input type="file" name="image" id="uploadBtn" class="upload" />
  			</div>
      </div>
    </div>
</div>
<p class="help-block">* {{ trans('app.form.required_fields') }}</p>