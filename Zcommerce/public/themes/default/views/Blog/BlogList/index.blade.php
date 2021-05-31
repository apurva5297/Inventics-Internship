@extends('layouts.master_common')
@section('content')
<div class="page-content">
    <div class="holder breadcrumbs-wrap mt-0">
      <div class="container">
        <ul class="breadcrumbs">
          <li><a href="index.html">Home</a></li>
          <li><span>Our Blog</span></li>
        </ul>
      </div>
    </div>
    <div class="holder">
        <div class="container">
          <div class="page-title text-center">
            <h1>Our Blog</h1>
          </div>
          <div class="row">
           @include('Blog.BlogList.list')
           @include('Blog.sidebar')
          </div>
        </div>
    </div>
      

</div>
@endsection