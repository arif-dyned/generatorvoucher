<!DOCTYPE html>
<html>
    <head>
    	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <?php
            //set headers to NOT cache a page
            header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT'); 
            header("Cache-Control:no-store, no-cache, must-revalidate"); //HTTP 1.1
            header("Cache-Control:post-check=0, pre-check=0", false); 
            header("Pragma: no-cache"); //HTTP 1.0
            //header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        ?>

        <?php //========== Website Meta Data =========== ?>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="content-language" content="en" />
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <meta name="author" content="DynEd">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google" value="notranslate" content="notranslate">
        <meta name="robots" content="noindex, nofollow">

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>">
        <link rel="apple-touch-icon" href="<?php echo e(asset('icon/icon.png')); ?>"/>

        <?php //========== Render CSS =========== ?>
        <?php $__currentLoopData = $data['css']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $asset): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php echo Html::style($asset); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

        <?php //========== Render Js in Header =========== ?>
        <?php if(!empty($data['js_assets_head'])): ?>
            <?php $__currentLoopData = $data['js_assets_head']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $asset): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <?php echo Html::script($asset); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        <?php endif; ?>
        <?php //========== Header Script =========== ?>
        <?php echo $__env->yieldContent('header_script'); ?>

    </head>
    <body class='fixed sidebar-mini <?php echo $__env->yieldContent('class-body'); ?>' <?php echo $__env->yieldContent('id-body'); ?>>
        <?php //========== Start Content =========== ?>
        <?php echo $__env->yieldContent('content'); ?>

        <?php //========== Render Js =========== ?>
        <?php if(isset($data['js'])): ?>
        <?php $__currentLoopData = $data['js']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $asset): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php echo Html::script($asset); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        <?php endif; ?>

        <?php //========== Render App_js =========== ?>
        <?php echo $__env->make('layout/app_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php //========== Footer Script =========== ?>
        <?php echo $__env->yieldContent('footer_script'); ?>
        
    </body>
</html>