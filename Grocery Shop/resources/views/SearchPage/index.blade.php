@extends('Layout.ProductPage.Product')
@section('content')
<div class="page-content">
    @include('SearchPage.destination')
    {{--@include('SearchPage.centerad')--}}
    @include('SearchPage.app')
    @include('CommonContent.youmayalsolike')
</div>

@endsection
