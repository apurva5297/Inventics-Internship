@extends('layouts.app')
@section('content')
<div class="container">
<h3 class="title">Blog Edit</h3>
<form action="" method="post" enctype="multipart/form-data">
@csrf()
@method('put')
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name="name" value=""  placeholder="name">
    @error('name')
    <span class="text-danger"></span>
    @enderror
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Category</label>
    <select name="category" class="js-example-basic-single form-control" >
    <option value="">--select category--</option>
   
    <option
   
    selected
   
     value=""></option>

    </select>
    @error('category')
    <span class="text-danger"></span>
    @enderror
  </div>
  
  <div class="form-group">
  <label for="exampleInputEmail1">Image</label> <br>
<img style="height:15%;width:15%;" src="" alt="">
<input type="file" name="image">
</div>
<a href="" class="btn btn-danger"style="margin-bottom:2px";>Delete Image</button> </a>
  <div class="form-group">
    <label for="exampleInputEmail1">Tags</label>
    <select name="tags[]" class="js-example-basic-multiple form-control" multiple >
    <option value="">--select tag--</option>
  
    <option 
  
 
 


     value=""></option>

    </select>
    @error('tags')
    <span class="text-danger"></span>
    @enderror
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea class="form-control" name="description" placeholder="description"></textarea>
    @error('description')
    <span class="text-danger"></span>
    @enderror
  </div>
 
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>

@endsection
