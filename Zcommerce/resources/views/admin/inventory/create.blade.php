@extends('admin.layouts.master')

@section('content')
@if(Session::has('message'))
<h5 class="alert alert-danger">{{ Session::get('message') }}</h5>
@endif
    {!! Form::open(['route' => 'admin.stock.inventory.store', 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}

        @include('admin.inventory._form')

    {!! Form::close() !!}
@endsection

@section('page-script')
    @include('plugins.dropzone-upload')
    @include('plugins.dynamic-inputs')
@endsection