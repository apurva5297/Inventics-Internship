@extends('layouts.master_common')
@section('content')
<div class="page-content">
  <div class="holder breadcrumbs-wrap mt-0">
    <div class="container">
      <ul class="breadcrumbs">
        <li><a href="index.html">Home</a></li>
        <li><a href="category.html">Women</a></li>
        <li><span>Leather Pegged Pants</span></li>
      </ul>
    </div>
  </div>
  @include('Product.product_holder')
  @include('Product.text_holder')
  @include('Product.more_details_tabs')
  @include('Product.you_may_also_like')
  

</div>
@endsection