<?php $__env->startSection('content'); ?>
<div class="container">
<h3 class="title">Category List  <a style="text-decoration:none;" href="<?php echo e(route('category.create')); ?>">+</a></h3>
<table class="table table-striped">
  <thead>
  <tr>
  <th>#</th>
  <th>Name</th>
  <th>Description</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
  <td><?php echo e($category->id); ?></td>
  <td><?php echo e($category->name); ?></td>
  <td><?php echo e($category->description); ?></td>
  <td>
  <a class="btn btn-info btn-sm" href="<?php echo e(route('category.edit',$category->id)); ?>">edit</a>
  
 
  </td>
  </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Apurva\Desktop\LARAVEL\newblog\resources\views/Category/index.blade.php ENDPATH**/ ?>