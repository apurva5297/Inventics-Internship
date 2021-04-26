<?php $__env->startSection('content'); ?>
<?php
$index=1;
?>
<div class="container">
<h3 class="title">Blog List  <a style="text-decoration:none;" href="<?php echo e(route('blog.create')); ?>">+</a></h3>
<div class="row">
<div class="col-md-2" style=""> </div>
<div class="col-md-2"><?php echo e($blogs->links()); ?></div>
<div class="col-md-4"></div>
<div class="col-md-4" style="margin-bottom:8px";>
<form action="">
<div class="row">
<input class="col-md-6 form-control" style="width" name="searchB" value="<?php echo e($name); ?>" type="text" placeholder="search blog">
<button class=" btn btn-info btn-sm" style="margin-left:8px";>GO</button>
</div>
</form>
</div>
</div>
<table class="table table-striped">
  <thead>
  <tr>
  <th>#</th>
  <th>Name</th>
  <th>Category</th>
  <th>Tags</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
  <td><?php echo e($index++); ?></td>
  <td><?php echo e($blog->name); ?></td>
  <td><?php if($blog->category): ?><?php echo e($blog->category->name); ?><?php endif; ?></td>
  <td>
  <?php $__currentLoopData = $blog->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <span class="badge badge-warning"><?php echo e($tag->name); ?></span>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </td>

  <td>
  <div class="row">
  <?php if(Auth::user()): ?>
  <a class="btn btn-info btn-sm" href="<?php echo e(route('blog.edit',$blog->id)); ?>">edit</a>&nbsp;
  <a class="btn btn-info btn-sm" href="<?php echo e(route('blog.show',$blog)); ?>">show</a>&nbsp;
    <form action="<?php echo e(route('blog.destroy',$blog->id)); ?>" method="post">
    <?php echo csrf_field(); ?>
    <?php echo method_field('delete'); ?>
    <button class="btn btn-danger btn-sm" type="submit">delete</button>
    </form>
  <?php endif; ?>
  </div>
  </td>
  </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Apurva\Desktop\LARAVEL\Blog\resources\views/Blog/index.blade.php ENDPATH**/ ?>