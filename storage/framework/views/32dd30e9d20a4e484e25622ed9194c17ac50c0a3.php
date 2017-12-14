<?php $__env->startSection('title', $data['title']); ?>

<?php $__env->startSection('class-body', ''); ?>

<?php $__env->startSection('content'); ?>
    <?php //========== Render header =========== ?>
    <?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php //========== Render sidebar =========== ?>
    <?php echo $__env->make('layout.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php //========== Render sidebar =========== ?>

    <?php //========== Start Content =========== ?>
        <?php echo $content; ?>

    <?php //========== End Content ============= ?>

    <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>