<?php $__env->startSection('content'); ?>
<style>
a
{
    text-decoration:none;   
}
.post-footer-option li{
    float:left;
    margin-right:50px;
    padding-bottom:15px;
}
.post-footer-option li a{
    color:#AFB4BD;
    font-weight:500;
    font-size:1.3rem;
}
.photo-profile{
    border:1px solid #DDD;    
}
.anchor-username h4{
    font-weight:bold;    
}
.anchor-time{
    color:#ADB2BB;
    font-size:1.2rem;
}
.post-footer-comment-wrapper{
    background-color:#F6F7F8;
}
img {
  margin-left: auto;
  margin-right: auto;
}
.comment
{
    border:2px solid;
    border-top:none;
    border-left:none;
    border-right:none;
    margin-top:-5px; 
    margin-left:-5px; 
    height:50px; 
    width:550px;
    border-radious:100px;
}
</style>
<table class="table table-striped table-dark">
<!--<tr>
<th>Title</th>
<th>Image</th>
<th>Tags</th>
<th>Category</th>
<th>Blog Description</th>
</tr>
-->
<h1 style="text-align:center; font-family:poor richard;color:#008080">'<?php echo e($blog->name); ?> "</h1>
<h4 style="text-align:center;color: #9f6060 ;font-family:colonna mt">-<?php echo e($blog->category->name); ?>-</h4>
    <div style="margin-left:30px;margin-right:30px;">
    <p class="fas fa-hashtag"></p>
<?php $__currentLoopData = $blog->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<h5  class="d-inline p-2 text-grey" style="font-size:14px;" >#<?php echo e($tag->name); ?></h5>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<br>
<center>
<img style="height:60%;width:60%;" src="<?php echo e(asset('image/'.$blog->image)); ?>" alt="">
</center>
<div style="margin-left:30px;margin-right:30px;">
<h3 style="font-family:gabriola"> <p class="fas fa-quote-left"></p>
<?php echo e($blog->description); ?>

<i class="fas fa-quote-right"></i>
</h3>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Apurva\Desktop\LARAVEL\Blog\resources\views/Blog/show.blade.php ENDPATH**/ ?>