<?php $__env->startSection('content'); ?>
<?php
$perPage=$categories->perPage();
$currentPage=$categories->currentPage()-1;
$index=$perPage*$currentPage+1;
?>
<div class="container">
<h3 class="title">Category List  <a style="text-decoration:none;" href="<?php echo e(route('category.create')); ?>">+</a></h3>
<form action="" method="get">
<div class="row">
<div class="col-md-6"></div>
  <div class="col-md-2" style="margin-left:6%";>
    <input type="text" placeholder="search name" value="<?php echo e($name); ?>"name="searchC" value="" style="margin-bottom:8px"; >
  </div>
  <div class="col-md-2"style="margin-left:8px";>
    <input type="text" placeholder="search description" value="<?php echo e($description); ?>"name="searchD" value="" style="margin-bottom:8px;" >
  </div>
  <div class="col-md-1" style="margin-left:8px";>
    <button type="submit" class="btn btn-info btn-sm">GO</button> 
  </div>
</div>
</form>
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
 
  <td style="width:30%;">
  <?php $__currentLoopData = $category->blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <span class="badge badge-info"><?php echo e($blog->name); ?></span>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </td>
  <td style="width:30%;"><?php echo e($category->description); ?></td>
  <td>

  <div class="row">
  <?php if($category->deleted_at): ?>
  <a class="btn btn-warning btn-sm"href="<?php echo e(route('category.restore',$category->id)); ?>">restore</a>
  <?php endif; ?>
  <a class="btn btn-info btn-sm" href="<?php echo e(route('category.edit',$category->id)); ?>">edit</a>&nbsp;
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Apurva\Desktop\LARAVEL\Inventics-Internship\Blog\resources\views/Category/index.blade.php ENDPATH**/ ?>