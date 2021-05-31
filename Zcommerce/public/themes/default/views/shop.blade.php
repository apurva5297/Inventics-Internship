@extends('layouts.main')
@section('content')
<div class="page-content">
    @include('shop.slider', ['shop' => $shop]) 
    {{-- @include('shop.collection_grid')
    @include('shop.brand_grid')    --}}
    @include('shop.collection')
    @include('shop.new_arrival')
    {{-- @include('shop.blog')   --}}
    @include('shop.newsletter')  
  
</div>
    
@endsection