<?php $__env->startSection('title', $data['title']); ?>
<?php $__env->startSection('id-body', 'id="login"'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layout.alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<section class="login">
	<div class="centering">
		<div class="fix">
			<img src="images/DSA-01.svg" alt="" height="100" />
			<div class="line"></div>

			<?php echo Form::open(['url' => 'login', 'class' => 'form-horizontal']); ?>

				<h1 class="dt">
					Sign in
				</h1>

				<figcaption class="fig-s">Email / Username</figcaption>
				<input type="text" placeholder="username?" value="<?php echo e(old('username')); ?>" class="form-control" name="username" required/>

				<figcaption class="fig-s">Password</figcaption>
				<input type="password" class="form-control" name="password" required/>

				<button type="submit" class="btn btn-content-inv" style="width:100%;margin-top:15px;margin-bottom:15px;">Sign in
				</button>
				<p class="foot">© 2016 DynEd Study Apps. <a href="#">Privacy Policy</a></p>
			<?php echo Form::close(); ?>

		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>