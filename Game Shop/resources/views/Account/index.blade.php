@extends('layouts.master_common')
@section('content')
<div class="page-content">
  <div class="holder breadcrumbs-wrap mt-0">
    <div class="container">
      <ul class="breadcrumbs">
        <li><a href="index.html">Home</a></li>
        <li><span>My account</span></li>
      </ul>
    </div>
  </div>
  <div class="holder">
    <div class="container">
      <div class="row">
       @include('Account.list-menu')
       @include('Account.account-details')
 
  

</div>
@endsection