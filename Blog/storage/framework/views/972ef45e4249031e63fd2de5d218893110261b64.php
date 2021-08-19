<?php $__env->startSection('content'); ?>
<div class="container">
<h3 class="title">Role Edit</h3>
<form action="<?php echo e(route('role.update',$role->id)); ?>" method="post">
<?php echo csrf_field(); ?>
<?php echo method_field('put'); ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo e($role->name); ?>" required placeholder="name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Display Name</label>
    <input type="text" class="form-control" name="display_name" value="<?php echo e($role->display_name); ?>" required placeholder="name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea class="form-control" name="description" placeholder="description"><?php echo e($role->description); ?></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Permission</label>
    <select name="permissions[]" class="js-example-basic-multiple form-control" multiple >
    <option value="">--select permission--</option>
    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option 
    <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

      <?php if($pr->id==$permission->id): ?>

      selected  
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     value="<?php echo e($permission->id); ?>"><?php echo e($permission->display_name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Apurva\Desktop\LARAVEL\Inventics-Internship\Blog\resources\views/role/edit.blade.php ENDPATH**/ ?>