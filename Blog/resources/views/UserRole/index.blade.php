@extends('layouts.app')
@section('content')
@php
$index=1;
@endphp
<div class="container">

<table class="table table-striped">
  <thead>
  <tr>
  <th>#</th>
  <th>Name</th>
  <th>Role</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  @foreach($users as $user)
  <tr>
  <td>{{$index++}}</td>
  <td>{{$user->name}}</td>
  <td style="width:30%;">
  @foreach($user->roles as $role)
    <span class="badge badge-info">{{$role->display_name}}</span>
    @endforeach
  </td>
  <td>
  <div class="row">
  <a class="btn btn-info btn-sm" href="{{route('user.role.edit',$user->id)}}">edit</a>&nbsp;

  </div>
  </td>
  </tr>
  @endforeach
  </tbody>
</table>


</div>
@endsection 