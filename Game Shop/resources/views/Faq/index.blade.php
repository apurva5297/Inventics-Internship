@extends('layouts.master_common')
@section('content')
<div class="page-content">
        <div class="holder breadcrumbs-wrap mt-0">
          <div class="container">
            <ul class="breadcrumbs">
              <li><a href="index.html">Home</a></li>
              <li><span>FAQS</span></li>
            </ul>
          </div>
        </div>
      @include('Faq.content')
</div>

    
@endsection