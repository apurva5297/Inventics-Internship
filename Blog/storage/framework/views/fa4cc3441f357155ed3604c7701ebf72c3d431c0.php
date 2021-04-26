<?php $__env->startSection('content'); ?>
<?php
$index=1;
?>
<div class="container">
<h3 class="title">Role List  <a style="text-decoration:none;" href="<?php echo e(route('role.create')); ?>">+</a></h3>

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
  <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
  <td><?php echo e($index++); ?></td>
  <td><?php echo e($role->name); ?></td>
  <td style="width:30%;">
  <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <span class="badge badge-info"><?php echo e($permission->display_name); ?></span>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </td>
  <td style="width:30%;"><?php echo e($role->description); ?></td>
  <td>
  <div class="row">
  <?php if($role->deleted_at): ?>
  <a class="btn btn-warning btn-sm"href="<?php echo e(route('role.restore',$role->id)); ?>">restore</a>
  <?php endif; ?>
  <a class="btn btn-info btn-sm" href="<?php echo e(route('role.edit',$role->id)); ?>">edit</a>&nbsp;
  <form action="<?php echo e(route('role.delete',$role->id)); ?>" method="post">
  <?php echo csrf_field(); ?>
  <?php echo method_field('delete'); ?>
  <button class="btn btn-danger btn-sm" type="submit">delete</button>
  </form>
  </div>
  </td>
  </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>


</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Apurva\Desktop\LARAVEL\Blog\resources\views/Role/index.blade.php ENDPATH**/ ?>