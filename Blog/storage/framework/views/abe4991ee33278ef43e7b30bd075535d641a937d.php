<?php $__env->startSection('content'); ?>
<div class="container">
<h3 class="title">Category Create</h3>
<form action="/category/store" method="post">
<?php echo csrf_field(); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Apurva\Desktop\LARAVEL\Blog\resources\views/Category/create.blade.php ENDPATH**/ ?>