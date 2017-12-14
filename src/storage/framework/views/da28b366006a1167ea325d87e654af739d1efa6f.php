<?php

$default = ['administrator' => 'Administrator', 'developer' => 'Developer', 'tester' => 'Tester'];

if (Request::segment(2) == 'profile') {
    $title = 'Update';
    $link = 'user-manager/profile/' . Request::segment(3);

    $status = Auth::user()->status == 'master' ? ['master' => 'Master'] : $default;
    $status = Request::segment(3) !== NULL ? $default : $status;
    $status = Auth::user()->status == 'developer' ? ['developer', 'Developer'] : $status;
    $status = Auth::user()->status == 'tester' ? ['tester', 'Tester'] : $status;

} else {
    $title = 'Create';
    $link = 'user-manager/create';

    $status = $default;
}
?>

<!-- Content Header (Page header) -->
<div class="row">
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>">Home </a></li>
            <li><a href="<?php echo e(url('user-manager')); ?>">User Manager</a></li>
            <li class="active"><?php echo e($title); ?> User</li>
        </ol>
    </section>
</div>
<?php echo $__env->make('layout.alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- Main content -->
<section class="panel">
    <header class="panel-heading">
        User Manager
        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-cog" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
    </header>
    <!-- Your Page Content Here -->
    <div class="panel-body">
        <div class="user-create col-lg-12" style="color:#3c8dbc;">
            <?php echo Form::open(['url' => $link, 'class' => 'form-horizontal']); ?>

            <div class="form-group">
                <?php echo Form::label('username', 'Username', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-4">
                    <?php echo Form::text('username', isset($data) ? $data->username : old('username'), ['class' =>  'form-control', 'placeholder' => 'username', 'required']); ?>

                </div>
                <div class="col-sm-5 error-input" style="color:red">
                    <!-- describe error input -->
                    <?php if($errors->has('username')): ?>
                        <label class="control-label"><?php echo $errors->first('username'); ?></label>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Form::label('full_name', 'Full Name', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-4">
                    <?php echo Form::text('full_name', isset($data) ? $data->full_name : old('full_name'), ['class' =>  'form-control', 'placeholder' => 'name', 'required']); ?>

                </div>
                <div class="col-sm-5 error-input" style="color:red">
                    <!-- describe error input -->
                    <?php if($errors->has('full_name')): ?>
                        <label class="control-label"><?php echo $errors->first('full_name'); ?></label>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Form::label('status', 'Status', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-4">
                    <label class="select">
                        <?php echo Form::select('status', $status, isset($data) ? $data->status : old('status'), ['placeholder' => 'Select Status', 'class' => 'form-control', 'required']); ?>

                    </label>
                </div>
                <div class="col-sm-5 error-input" style="color:red">
                    <!-- describe error input -->
                    <?php if($errors->has('status')): ?>
                        <label class="control-label"><?php echo $errors->first('status'); ?></label>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-4">
                    <?php echo Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required']); ?>

                </div>
                <div class="col-sm-3 error-input">
                    <h6 style="margin-top:0;color:#aeaeae">Password Strength : <span id="pass-strength"
                                                                                     class="has-danger"> - </span></h6>
                    <div class="progress" style="height:5px;background-color:#cecece;margin-bottom: 0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                             aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php echo Form::label('password_confirmation', 'Retype Password', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-4">
                    <?php echo Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Re Password', 'required']); ?>

                </div>
                <div class="col-sm-5 error-input" style="color:red">
                    <!-- describe error input -->
                    <?php if($errors->has('password')): ?>
                        <label class="control-label"><?php echo $errors->first('password'); ?></label>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary"
                            style="width:100px"><?php echo e(isset($data) ? 'EDIT' : 'ADD'); ?></button>
                </div>
            </div>
            <?php echo Form::close(); ?>


        </div>
    </div>
    <br>
</section>
<!-- /.content -->

<?php $__env->startSection('footer_script'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            var strength = {
                0: "Bad",
                1: "Weak",
                2: "Good",
                3: "Strong"
            }

            var color = {
                0: "red",
                1: "OrangeRed",
                2: "orange",
                3: "green"
            }

            var password = $('#password')

            $('#password').on('keypress', function (event) {
                if ((event.which == 32)) return false;
            });
            $('#re-password').on('keypress', function (event) {
                if ((event.which == 32)) return false;
            });

            $('#password').on('input', function (e) {
                var val = password.val();
                var result = zxcvbn(val);

                if ($(this).val() !== '') {
                    $('#pass-strength').css('color', color[result.score])
                    $('#pass-strength').html(strength[result.score])
                    $('.progress-bar').css('background-color', color[result.score])
                    $('.progress-bar').css('width', ((((result.score + 1) * 10) + ((result.score) * 12.5))).toString() + '%')
                } else {
                    $('#pass-strength').html('')
                    $('.progress-bar').css('width', '0%')
                }
            })
        });
    </script>
<?php $__env->stopSection(); ?>