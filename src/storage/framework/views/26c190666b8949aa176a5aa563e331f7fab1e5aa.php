<?php
if (Request::segment(2) == 'edit') {
    $title = 'Update';
    $link = 'employee/save/';
    $readonly = '';
} else if (Request::segment(2) == 'detail') {
    $title = 'Detail';
    $link = 'employee/save';
    $readonly = 'disabled';
} else {
    $title = 'Add New';
    $link = 'employee/save';
    $readonly = 'disabled';
}
?>
<div class="row">
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>"> Home </a></li>
            <li><a href="<?php echo e(url('organizations')); ?>">Organization</a></li>
            <li><a href="<?php echo e(url('organizations/detail/'.$data->organization_id)); ?>">Voucher</a></li>
            <li class="active"><?php echo e($title); ?></li>
        </ol>
    </section>

    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <?php echo e($title); ?> Employee
                <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-cog" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
            </header>
            <div class="panel-body">
                <?php echo Form::open(['url' => $link, 'class' => 'cmxform form-horizontal', 'id'=>'signupForm','enctype' => 'multipart/form-data', 'files' => true]); ?>

                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                <div class="form-group ">
                    <label for="email" class="control-label col-lg-3">Email</label>
                    <div class="col-lg-6">
                        <input class=" form-control" id="email" name="email" type="email"
                               value="<?php echo e(!empty($data) ? $data->email : old("email")); ?>" <?php echo e($readonly); ?>/>
                        <input class=" form-control" id="id" name="id" type="hidden"
                               value="<?php echo e(!empty($data) ? $data->id : '0'); ?>"/>
                        <input class=" form-control" id="organization_id" name="organization_id" type="hidden"
                               value="<?php echo e($data->organization_id); ?>"/>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="nis" class="control-label col-lg-3">Discount</label>
                    
                    
                    <div class="col-lg-6">
                        <input class=" form-control" id="discont" name="discont" type="text"
                               value="<?php echo e(!empty($data) ? str_replace('_',' ',$data->discont) : old("discont")); ?>" <?php echo e($readonly); ?>/>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="email" class="control-label col-lg-3">Expiration Date</label>
                    <div class="col-lg-3">
                        <prelabel>Start Date</prelabel>
                        <input class=" form-control start_date" id="start_date" name="start_date" type="text"
                               value="<?php echo e(!empty($data) ? $data->start_date : old("start_date")); ?>"
                               placeholder="Start Date" <?php echo e($readonly); ?>/>
                    </div>
                    <div class="col-lg-3">
                        <prelabel>End Date</prelabel>
                        <input class=" form-control end_date" id="end_date" name="end_date" type="text"
                               value="<?php echo e(!empty($data) ? $data->end_date : old("end_date")); ?>"
                               placeholder="End Date" <?php echo e($readonly); ?>/>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="email" class="control-label col-lg-3">Message</label>
                    <div class="col-lg-6">
                        <textarea class=" form-control" id="message"
                                  name="message" <?php echo e($readonly); ?>><?php echo e(!empty($data) ? $data->message : old("message")); ?></textarea>
                    </div>
                </div>
                <div class="form-group"
                     id="voucher_code" style="<?php echo e($organization->type_voucher == "all" ? 'display: none' :"s"); ?>">
                    <label for="email" class="control-label col-lg-3">Voucher Code</label>
                    <div class="col-lg-6">
                        <input class=" form-control" name="voucher_code" type="text"
                               value="<?php echo e(!empty($data) ? $data->voucher_code : old("voucher_code")); ?>" readonly/>
                    </div>
                    <a href="#" name="generate" class="btn" <?php echo e($readonly); ?>>Generate</a>
                </div>

                <div class="form-group"></div>
                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-6">
                        <a href="<?php echo e(url('organizations/detail/'.$data->organization_id)); ?>">
                            <button class="btn btn-default" type="button">Cancel</button>
                        </a>
                        <button class="btn btn-primary" type="submit" <?php echo e($readonly); ?>>Save</button>
                    </div>
                </div>

                <?php echo Form::close(); ?>

            </div>
        </section>
    </div>
</div>
<?php echo $__env->make('organization.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script src="<?php echo e(url('js/jquery-1.8.3-clone.min.js')); ?>"></script>
<script type="text/javascript">
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }
    today = yyyy + '' + mm + '' + dd;
    $(function () {
        $('.type_all').on('change', function () {
            $('#voucher_code').show()
            $('[name=voucher_code]').val(randomString(8, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' + today))
        })
        $('.type_personal').on('change', function () {
            $('#voucher_code').hide()
            $('[name=voucher_code]').val('')
        })
        if ($('.type_all').prop('checked') == true) {
            $('#voucher_code').show()
        }
    })
    $('[name=generate]').on('click', function (e) {
        e.preventDefault();
        $('[name=voucher_code]').val(randomString(8, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' + today))
    })
    function randomString(length, chars) {
        var result = '';
        for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
        return result;
    }
</script>