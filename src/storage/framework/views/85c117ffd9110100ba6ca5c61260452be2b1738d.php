<div class="row">
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>"> Home </a></li>
            <li><a href="#">User Manager</a></li>
        </ol>
    </section>
    <?php echo $__env->make('layout.alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Setting User Managers
                <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
            </header>
            <div class="panel-body">
                <div class="pull-right">
                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="c100 p25 big blue circle-percent" style="display:none;">
                                    <span id="percent"></span>
                                    <div class="slice">
                                        <div class="bar"></div>
                                        <div class="fill"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(Auth::user()->status !== 'tester' && Auth::user()->status !== 'developer'): ?>
                        <a href="<?php echo e(url('user-manager/create')); ?>" style="margin-top:30px">
                            <button class="btn btn-primary" type="submit">Add New Record</button>
                        </a>
                    <?php endif; ?>
                    <br><br>
                    
                    
                    
                    

                </div>
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered"
                           id="patner">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Access</th>
                            <th>Last Login</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($data->count() == 0): ?>
                            <tr role="row">
                                <td colspan="6" class="text-center"> nothing to show</td>
                            </tr>
                        <?php endif; ?>

                        <?php $i_count = 1; ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <tr role="row">
                                <td class="num"><?php echo e($i_count); ?></td>
                                <td class="tdmod"><?php echo e($user->username); ?></td>
                                <td class="tdmod"><?php echo e($user->status); ?></td>
                                <td class="tdmod"> -</td>
                                <td class="tdmod"><?php echo e($user->updated_at); ?></td>
                                <?php if(Auth::user()->status !== 'tester' && Auth::user()->status !== 'developer'): ?>
                                    <td class="flex" id="<?php echo e($user->id); ?>">
                                        <a href="<?php echo e(url('user-manager/profile/'.$user->id)); ?>" name="btn_edit">Edit</a>
                                        |
                                        <a href="#" name="btn_delete"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                <?php else: ?>
                                    <td> not allowed</td>
                                <?php endif; ?>
                            </tr>
                            <?php $i_count += 1; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    </div>
</div>

<!-- /.content -->

<?php $__env->startSection('footer_script'); ?>
    <script type="text/javascript">

        $(document).on("click", "[name=btn_delete]", function (event) {
            event.preventDefault()

            var id = $(this).parent().attr('id')
            var $model = $(this).parents('section').attr('id')

            r = confirm("Are You Sure Want to Remove This?");

            // when user is confirmed to delete
            if (r == true) {

                // run the ajax post function
                $.ajax({
                    url: "<?php echo url('user-manager/delete'); ?>",
                    type: "POST",
                    data: {
                        id: id
                    },
                    error: function (data) {
                        console.log(data.responseText)
                    }
                }).done(function (data) {
                    document.location.reload(true)
                })
            }
        })
    </script>
<?php $__env->stopSection(); ?>