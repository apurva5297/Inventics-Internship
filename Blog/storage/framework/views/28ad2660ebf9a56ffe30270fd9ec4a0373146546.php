<?php $__env->startSection('content'); ?>
<?php
$index=1;
?>
<div class="container">
<h3 class="title">Tag List  <a style="text-decoration:none;" href="<?php echo e(route('tag.create')); ?>">+</a></h3>
<table class="table table-striped">
  <thead>
  <tr>
  <th>#</th>
  <th>Name</th>
  <th>Blogs</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
  <td><?php echo e($index++); ?></td>
  <td><?php echo e($tag->name); ?></td>
  <td>
  <?php $__currentLoopData = $tag->blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <span class="badge badge-warning"><?php echo e($blog->name); ?></span>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </td>
  <td>
  <div class="row">
  <a class="btn btn-info btn-sm" href="<?php echo e(route('tag.edit',$tag)); ?>">edit</a>&nbsp;
  <form action="<?php echo e(route('tag.destroy',$tag)); ?>" method="post">
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Apurva\Desktop\LARAVEL\Inventics-Internship\Blog\resources\views/tag/index.blade.php ENDPATH**/ ?>