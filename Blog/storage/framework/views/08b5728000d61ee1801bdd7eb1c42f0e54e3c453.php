<?php $__env->startSection('content'); ?>
<div class="container">
<h3 class="title">Category Edit</h3>
<form action="<?php echo e(route('category.update',$category->id)); ?>" method="post">
<?php echo csrf_field(); ?>
<?php echo method_field('put'); ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo e($category->name); ?>" required placeholder="name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea class="form-control" name="description" placeholder="description"><?php echo e($category->description); ?></textarea>
  </div>
 
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Apurva\Desktop\LARAVEL\Blog\resources\views/Category/edit.blade.php ENDPATH**/ ?>