@extends('layouts.app')
@section('content')
@php
$index=1;
@endphp
<div class="container">
<h3 class="title">Blog List  <a style="text-decoration:none;" href="">+</a></h3>
<div class="row">
<div class="col-md-2" style=""> </div>
<div class="col-md-2"></div>
<div class="col-md-4"></div>
<div class="col-md-4" style="margin-bottom:8px";>
<form action="">
<div class="row">
<input class="col-md-6 form-control" style="width" name="searchB" value="" type="text" placeholder="search blog">
<button class=" btn btn-info btn-sm" style="margin-left:8px";>GO</button>
</div>
</form>
</div>
</div>
<table class="table table-striped">
  <thead>
  <tr>
  <th>#</th>
  <th>Name</th>
  <th>Category</th>
  <th>Tags</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  @foreach($blogs as $blog)
  <tr>
  <td></td>
  <td></td>
  <td></td>
  <td>
 
  <span class="badge badge-warning"></span>
  
  </td>

  <td>
  <div class="row">
 
  <a class="btn btn-info btn-sm" href="">edit</a>&nbsp;
  <a class="btn btn-info btn-sm" href="">show</a>&nbsp;
    <form action="" method="post">
    @csrf()
    @method('delete')
    <button class="btn btn-danger btn-sm" type="submit">delete</button>
    </form>
 
  </div>
  </td>
  </tr>
  
  </tbody>
</table>
</div>
@endsection
