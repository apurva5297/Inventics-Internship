@extends('layouts.app')
@section('content')

<div class="container">
<h3 class="title">Blog Create</h3>
<form action="" method="post" enctype="multipart/form-data">
@csrf()
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name="name"  placeholder="name">
  </div>
  @error('name')
    <span class="text-danger"></span>
@enderror

  <div class="form-group">
    <label for="exampleInputEmail1">Category</label>
    <select name="category" class="js-example-basic-single form-control" >
    <option value="">--select category--</option>
   
    <option value="</option>
   
    </select>
    @error('category')
    <span class="text-danger"></span>
    @enderror
  </div>
  <div class="form-group">
  <label for="exampleInputEmail1">Image</label>
  <input type="file" class="form-control" name="image">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Tags</label>
    <select name="tags[]" class="js-example-basic-multiple form-control" multiple >
    <option value="">--select tag--</option>
  
    <option value=""</option>
   
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
 
  <button type="submit" class="btn btn-primary">Save</button>
</form>
</div>

@endsection
