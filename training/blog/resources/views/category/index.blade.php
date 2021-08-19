@extends('layouts.app')
@section('content')
{{-- @php
$perPage=$categories->perPage();
$currentPage=$categories->currentPage()-1;
$index=$perPage*$currentPage+1;
@endphp --}}
<div class="container">
<h3 class="title">Category List  <a style="text-decoration:none;" href="">+</a></h3>
<form action="" method="get">
<div class="row">
<div class="col-md-6"></div>
  <div class="col-md-2" style="margin-left:6%";>
    <input type="text" placeholder="search name" value=""name="searchC" value="" style="margin-bottom:8px"; >
  </div>
  <div class="col-md-2"style="margin-left:8px";>
    <input type="text" placeholder="search description" value=""name="searchD" value="" style="margin-bottom:8px;" >
  </div>
  <div class="col-md-1" style="margin-left:8px";>
    <button type="submit" class="btn btn-info btn-sm">GO</button> 
  </div>
</div>
</form>
<table class="table table-striped">
  <thead>
  <tr>
  <th>#</th>
  <th>Name</th>
  <th>Blog</th>
  <th>Description</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  {{-- @foreach($categories as $category) --}}
  <tr>
  <td></td>
  <td></td>
 
  <td style="width:30%;">
  {{-- @foreach($category->blogs as $blog) --}}
  <span class="badge badge-info"></span>
  {{-- @endforeach --}}
  </td>
  <td style="width:30%;"></td>
  <td>

  <div class="row">
  {{-- @if($category->deleted_at) --}}
  <a class="btn btn-warning btn-sm"href="">restore</a>
  {{-- @endif --}}
  <a class="btn btn-info btn-sm" href="{{route('category.edit')}}">edit</a>&nbsp;
  <form action="" method="post">
  @csrf()
  @method('delete')
  <button class="btn btn-danger btn-sm" type="submit">delete</button>
  </form>
  </div>
  </td>
  </tr>
  {{-- @endforeach --}}
  </tbody>
</table>
{{-- {{ $categories->links() }} --}}

</div>
@endsection 