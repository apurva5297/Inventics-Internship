<?php $__env->startSection('content'); ?>
<div class="container">
<h3 class="title">Permission Edit</h3>
<form action="<?php echo e(route('permission.update',$permission->id)); ?>" method="post">
<?php echo csrf_field(); ?>
<?php echo method_field('put'); ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo e($permission->name); ?>" required placeholder="name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Display Name</label>
    <input type="text" class="form-control" name="display_name" value="<?php echo e($permission->name); ?>" required placeholder="name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea class="form-control" name="description" placeholder="description"><?php echo e($permission->description); ?></textarea>
  </div>
 
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Apurva\Desktop\LARAVEL\Inventics-Internship\Blog\resources\views/permission/edit.blade.php ENDPATH**/ ?>