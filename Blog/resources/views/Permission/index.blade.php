@extends('layouts.app')
@section('content')
@php
$index=1;
@endphp
<div class="container">
<h3 class="title">Permission List  <a style="text-decoration:none;" href="{{route('permission.create')}}">+</a></h3>

<table class="table table-striped">
  <thead>
  <tr>
  <th>#</th>
  <th>Name</th>
  <th>Role</th>
  <th>Description</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  @foreach($permissions as $permission)
  <tr>
  <td>{{$index++}}</td>
  <td>{{$permission->name}}</td>
  <td style="width:30%;">
  @foreach($permission->roles as $role)
    <span class="badge badge-info">{{$role->name}}</span>
    @endforeach
  </td>
  <td style="width:30%;">{{$permission->description}}</td>
  <td>
  <div class="row">
  @if($permission->deleted_at)
  <a class="btn btn-warning btn-sm"href="{{route('permission.restore',$permission->id)}}">restore</a>
  @endif
  <a class="btn btn-info btn-sm" href="{{route('permission.edit',$permission->id)}}">edit</a>&nbsp;
  <form action="{{route('permission.delete',$permission->id)}}" method="post">
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