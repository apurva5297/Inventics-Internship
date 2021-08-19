@extends('layout.ProductPage.Product')
@section('content')
    <div class="page-content">
        @include('Gallery.directory')
        @include('Gallery.content')
        @include('Gallery.pagination')
    </div>

@endsection
