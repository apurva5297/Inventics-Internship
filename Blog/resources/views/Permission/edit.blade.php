@extends('layouts.app')
@section('content')
<div class="container">
<h3 class="title">Permission Edit</h3>
<form action="{{route('permission.update',$permission->id)}}" method="post">
@csrf()
@method('put')
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name="name" value="{{$permission->name}}" required placeholder="name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Display Name</label>
    <input type="text" class="form-control" name="display_name" value="{{$permission->name}}" required placeholder="name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea class="form-control" name="description" placeholder="description">{{$permission->description}}</textarea>
  </div>
 
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>

@endsection