@extends('layouts.app')

@@section('content')
    <div id="EnterLoginOtp" style="display:none;">
        {!! Form::open(['route' => 'login', 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="form-group has-feedback">
            {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('app.form.email_address'), 'required']) !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
            {!! Form::password('password', ['class' => 'form-control input-lg', 'id' => 'password', 'placeholder' => trans('app.form.password'), 'data-minlength' => '6', 'required']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>
        <div class="row">
            <input type="hidden" name="login_type" value="verifyOTP">
            <div class="col-xs-5">
                {!! Form::submit(trans('app.form.login'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div id="RequestLoginOtp">
        <div class="form-group has-feedback">
            <input type="number" id="phone" name="phone" class="form-control input-lg" >
        </div>
        <div class="row has-feedback">
            <a href ="#" class="btn" id="request_otp"> verify number</a>
        </div>
    </div>
@endsection

