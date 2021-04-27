<?php $__env->startSection('content'); ?>
<div class="container">
<h3 class="title">Blog Edit</h3>
<form action="<?php echo e(route('blog.update',$blog->id)); ?>" method="post" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<?php echo method_field('put'); ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo e($blog->name); ?>"  placeholder="name">
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Category</label>
    <select name="category" class="js-example-basic-single form-control" >
    <option value="">--select category--</option>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option
    <?php if($category->id==$blog->category_id): ?>
    selected
    <?php endif; ?>
     value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>
  
  <div class="form-group">
  <label for="exampleInputEmail1">Image</label> <br>
<img style="height:15%;width:15%;" src="<?php echo e(asset('image/'.$blog->image)); ?>" alt="">
<input type="file" name="image">
</div>
<a href="<?php echo e(route('blog.delete_image_only',$blog->id)); ?>" class="btn btn-danger"style="margin-bottom:2px";>Delete Image</button> </a>
  <div class="form-group">
    <label for="exampleInputEmail1">Tags</label>
    <select name="tags[]" class="js-example-basic-multiple form-control" multiple >
    <option value="">--select tag--</option>
    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option 
    <?php $__currentLoopData = $blog->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($t->id==$tag->id): ?>
      selected  
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     value="<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = ['tags'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea class="form-control" name="description" placeholder="description"><?php echo e($blog->description); ?></textarea>
    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>
 
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Apurva\Desktop\LARAVEL\Inventics-Internship\Blog\resources\views/Blog/edit.blade.php ENDPATH**/ ?>