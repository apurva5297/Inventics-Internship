<?php $__env->startSection('content'); ?>
<div class="container">
<h3 class="title">UserRole Edit</h3>
<form action="<?php echo e(route('user.role.update',$user->id)); ?>" method="post">
<?php echo csrf_field(); ?>
<?php echo method_field('put'); ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" readonly class="form-control" name="name" value="<?php echo e($user->name); ?>" required placeholder="name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Roles</label>
    <select name="roles[]" class="js-example-basic-multiple form-control" multiple >
    <option value="">--select role--</option>
    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option 
    <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($r->id==$role->id): ?>
      selected  
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = ['roles'];
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Apurva\Desktop\LARAVEL\Blog\resources\views/UserRole/edit.blade.php ENDPATH**/ ?>