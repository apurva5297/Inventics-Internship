@extends('layouts.app')
@section('content')
@php
$index=1;
@endphp
<div class="container">
<h3 class="title">Role List  <a style="text-decoration:none;" href="{{route('role.create')}}">+</a></h3>

<table class="table table-striped">
  <thead>
  <tr>
  <th>#</th>
  <th>Name</th>
  <th>Permissions</th>
  <th>Description</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  @foreach($roles as $role)
  <tr>
  <td>{{$index++}}</td>
  <td>{{$role->name}}</td>
  <td style="width:30%;">
  @foreach($role->permissions as $permission)
    <span class="badge badge-info">{{$permission->display_name}}</span>
    @endforeach
  </td>
  <td style="width:30%;">{{$role->description}}</td>
  <td>
  <div class="row">
  @if($role->deleted_at)
  <a class="btn btn-warning btn-sm"href="{{route('role.restore',$role->id)}}">restore</a>
  @endif
  <a class="btn btn-info btn-sm" href="{{route('role.edit',$role->id)}}">edit</a>&nbsp;
  <form action="{{route('role.delete',$role->id)}}" method="post">
  @csrf()
  @method('delete')
  <button class="btn btn-danger btn-sm" type="submit">delete</button>
  </form>
  </div>
  </td>
  </tr>
  @endforeach
  </tbody>
</table>


</div>
@endsection 