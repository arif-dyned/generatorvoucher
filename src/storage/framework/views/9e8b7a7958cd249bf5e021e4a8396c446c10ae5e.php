<?php $__env->startSection('title', $data['title']); ?>

<?php $__env->startSection('class-body', 'hold-transition dyned-skins sidebar-mini'); ?>

<?php $__env->startSection('content'); ?>
<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
    <?php //========== Render header =========== ?>
    <?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </header>
    <aside>
    <div id="sidebar" class="nav-collapse">
    <?php //========== Render sidebar =========== ?>
    <?php echo $__env->make('layout.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    </aside>

    <section id="main-content">
        <section class="wrapper">
        <?php //========== Start Content =========== ?>
        <?php echo $content; ?>

        <?php //========== End Content ============= ?>
    </section>
    <br>
    </div>
        <div id="footer" class="nav-collapse">
    <?php //========== Render sidebar =========== ?>
    <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>