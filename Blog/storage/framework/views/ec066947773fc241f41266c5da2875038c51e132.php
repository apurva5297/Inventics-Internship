<?php $__env->startSection('content'); ?>
<?php
$index=1;
?>
<div class="container">
<h3 class="title">Category List </h3>
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
  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
  <td><?php echo e($index++); ?></td>
  <td><?php echo e($category->name); ?></td>
  <td>
  <?php $__currentLoopData = $category->blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <span class="badge badge-info"><?php echo e($blog->name); ?></span>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </td>
  <td style="width:60%;"><?php echo e($category->description); ?></td>
  <td>
  <div class="row">

  <a class="btn btn-warning btn-sm"href="<?php echo e(route('category.restore',$category->id)); ?>">restore</a>

  <form action="<?php echo e(route('category.delete',$category->id)); ?>" method="post">
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
<?php echo e($categories->links()); ?>


</div>
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Apurva\Desktop\LARAVEL\Inventics-Internship\Blog\resources\views/Category/deleted_index.blade.php ENDPATH**/ ?>