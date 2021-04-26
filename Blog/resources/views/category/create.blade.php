@extends('layouts.app')
@section('content')
<div class="container">
<h3 class="title">Category Create</h3>
<form action="/category/store" method="post">
@csrf()
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name="name" placeholder="name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea class="form-control" name="description" placeholder="description"></textarea>
  </div>
 
  <button type="submit" class="btn btn-primary">Save</button>
</form>
</div>
@endsection