@extends('layouts.master_common')
@section('content')
<div class="page-content">
        <div class="holder breadcrumbs-wrap mt-0">
          <div class="container">
            <ul class="breadcrumbs">
              <li><a href="index.html">Home</a></li>
              <li><span>Gallery</span></li>
            </ul>
          </div>
        </div>
      @include('Gallery.content')
        <div class="d-flex mt-3 mt-md-5 justify-content-center align-items-start">
          <ul class="pagination mt-0">
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
          </ul>
        </div>
</div>

    
@endsection