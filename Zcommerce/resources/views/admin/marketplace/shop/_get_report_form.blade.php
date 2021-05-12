@extends('admin.layouts.master')

@section('content')
    {!! Form::open(['route' => 'admin.stock.pricelist.marketplace_report', 'files' => true, 'id' => '', 'data-toggle' => 'validator']) !!}

        <div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ isset($inventory) ? trans('app.update_inventory') : trans('app.add_inventory') }}</h3>
      </div> <!-- /.box-header -->
      <div class="box-body">

        <div class="row">
          <div class="col-md-6 nopadding-right">
            <div class="form-group">
              {!! Form::label('Report Type', trans('Report Type').'*', ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.seller_product_condition') }}"></i>
              <select class="form-control select2-normal" onchange="changeReportType(this)">
                <option value="0">Please Select</option>
                <option value="1">Order Report</option>
                <option value="2">Return Report</option>
                <option value="3">Payment Report</option>
              </select>
              <div class="help-block with-errors"></div>
            </div>
              {!! Form::submit(trans('Get Report'), ['class' => 'btn btn-flat btn-lg btn-new pull-right']) !!}  
          </div>
        </div>
        <hr>
        <div class="row report-type-section" style="display: none;">
                <div class="col-md-12">
                <div class="form-group" id="table_field">
                 {{-- {!! Form::label('Report Flied', 'Report Flied') !!}
                    {!! Form::checkbox('rest_of_the_world', 1, null, ['class' => 'icheck']) !!} Order No&nbsp;
                    {!! Form::checkbox('rest_of_the_world', 1, null, ['class' => 'icheck']) !!} Date&nbsp;
                    {!! Form::checkbox('rest_of_the_world', 1, null, ['class' => 'icheck']) !!} Price&nbsp;
                    {!! Form::checkbox('rest_of_the_world', 1, null, ['class' => 'icheck']) !!} Qty&nbsp;--}}
                </div>
              </div>
            </div>
          <hr>
         <div class="row report-type-section" style="display: none;">
               <div class="col-md-6 nopadding-right">
                <div class="form-group">
                  {!! Form::label('starting_time', trans('app.form.starting_time') . '*', ['class' => 'with-help']) !!}
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.starting_time') }}"></i>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    {!! Form::text('starting_time', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.starting_time'), 'required']) !!}
                  </div>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="col-md-6 nopadding-left">
                <div class="form-group">
                  {!! Form::label('ending_time', trans('app.form.ending_time') . '*', ['class' => 'with-help']) !!}
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.ending_time') }}"></i>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    {!! Form::text('ending_time', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.ending_time'), 'required']) !!}
                  </div>
                  <div class="help-block with-errors"></div>
                </div>
                 {!! Form::submit(trans('Generate Report'), ['class' => 'btn btn-flat btn-lg btn-new pull-right']) !!}  
              </div>
            </div>
        </div>
    </div>
  </div><!-- /.col-md-8 -->
</div><!-- /.row -->

    {!! Form::close() !!}
@endsection

@section('page-script')
    @include('plugins.dropzone-upload')
    @include('plugins.dynamic-inputs')
@endsection