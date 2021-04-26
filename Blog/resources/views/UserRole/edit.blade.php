@extends('layouts.app')
@section('content')
<div class="container">
<h3 class="title">UserRole Edit</h3>
<form action="{{route('user.role.update',$user->id)}}" method="post">
@csrf()
@method('put')
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" readonly class="form-control" name="name" value="{{$user->name}}" required placeholder="name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Roles</label>
    <select name="roles[]" class="js-example-basic-multiple form-control" multiple >
    <option value="">--select role--</option>
    @foreach($roles as $role)
    <option 
    @foreach($user->roles as $r)
      @if($r->id==$role->id)
      selected  
      @endif
    @endforeach
     value="{{$role->id}}">{{$role->name}}</option>
    @endforeach
    </select>
    @error('roles')
    <span class="text-danger">{{$message}}</span>
    @enderror
  </div>
 
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>

@endsection