@extends('layouts.app')
@section('content')
<div class="container">
<h3 class="title">Tag Create</h3>
<form action="{{route('tag.store')}}" method="post">
@csrf()
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name="name" placeholder="name">
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
</div>
@endsection