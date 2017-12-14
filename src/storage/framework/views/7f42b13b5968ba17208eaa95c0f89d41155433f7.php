<div class="row">
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>"> Home </a></li>
            <li><a href="#">Organizations</a></li>
        </ol>
    </section>
    <?php echo $__env->make('layout.alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Master Organizations
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
                    <a href="<?php echo e(url('organizations/add')); ?>">
                        <button class="btn btn-primary" type="submit">Add New Record</button>
                    </a>
                    <a href="#" id="btn-import"><span class="btn btn-primary">Add Multiple Record</span></a>
                    <?php echo Form::open(['url' => '', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'files' => true,'method'=>'post']); ?>

                    <?php echo Form::file( 'files', ['style' => 'display:block;height:0;width:0;', 'multiple' => false, 'accept' => 'application/excel']); ?>

                    <?php echo Form::close(); ?>


                </div>
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered"
                           id="patner">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Voucher</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </section>
    </div>
</div>


<script src="<?php echo e(url('js/jquery-1.8.3-clone.min.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#patner').DataTable({
            serverSide: true,
            processing: true,
            ajax: "<?php echo e(url('trtempl/employee/'.Request::segment(3))); ?>",
            columns: [
                {data: null, orderable: false, 'title': 'No'},
                {data: 'employee_name', orderable: true},
                {data: 'email', orderable: true},
                {data: 'voucher_code', orderable: true},
                {
                    data: 'id', orderable: false, 'title': 'Action', "render": function (data, type, row) {
                    return '' +
                        '<a href="<?php echo e(url('organizations/detail')); ?>/' + row.id + '">Detail |</a>&nbsp;&nbsp;&nbsp;' +
                        '<a href="<?php echo e(url('organizations/edit')); ?>/' + row.id + '">Edit |</a>&nbsp;&nbsp;&nbsp;' +
                        '<a href="#" name="btn_delete" onclick="deleteOrganization(' + row.id + ')">Delete</a>';
                }
                }],
            'columnDefs': [
                {
                    'targets': 0,
                    'createdCell': function (td, cellData, rowData, row, col) {
                        $(td).text(row + 1);
                    }
                }, {
                    'targets': 1,
                    'createdCell': function (td, cellData, rowData, row, col) {
                        var str = rowData.employee_name;
                        $(td).text(str.replace(/_/g, " "));
                        $(td).attr('id', rowData.id);
                        $(td).attr('name', 'btnPreview');
                        $(td).attr('style', 'cursor:pointer');
                    }
                },
                {
                    'targets': 3,
                    'createdCell': function (td, cellData, rowData, row, col) {
                        $(td).attr('id', rowData.id);
                    }
                }
            ]

        });
    })
    function deleteOrganization(id) {
        r = confirm("Are You Sure Want to Remove This?");
        if (r == true) {
            $.ajax({
                url: "<?php echo e(url('organizations/delete-organization')); ?>",
                type: "POST",
                data: {
                    id: id
                },
                error: function (data) {
                    console.log(data.responseJSON)
                }
            }).done(function (data) {
                if (data.desc == "ok") {
                    $('#patner').DataTable().ajax.reload()
                    alert('Success Deleted')
                }
            })
        }
    }

    $('#btn-import').on('click', function (e) {
        e.preventDefault()
        $('input[type=file]').trigger('click');
    });
    $(document).on('change', 'input[name=files][type=file]', function (e) {
        e.preventDefault();
        $('.progress').show();
        $('#loading').show();
        $('#loadingspiner').show();
        $('.fixed')[0].id = "disablingDiv";
        var files = event.target.files;

        var data = new FormData();
        $.each(files, function (key, value) {
            data.append(key, value);
        });

        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');

        $.ajax({
            url: "<?php echo url('organizations/upload'); ?>",
            type: "POST",
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
//            beforeSend: function () {
//                $('#prog').attr('value', '0');
//                status.empty();
//                var percentVal = '0%';
//                bar.width(percentVal)
//                percent.html('Please Wait...');
//            },
            xhr: function () {
                var xhr = jQuery.ajaxSettings.xhr();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 99;
                        bar.width(percentComplete);
                    }
                    $('#myModal').modal('show');
                    $('#myModal').find('.c100').show()
                    $('#myModal').find('#percent').text(percentComplete.toFixed(0) + '%')
                    console.log(percentComplete.toFixed(0));
                }, false);
                return xhr;
            },
            error: function (data) {
                alert('something goes wrong ' + data.message);
                $('input[type=file]').val('')
                $('#import-info').hide('display')
            }
        }).done(function (data) {
            var percentVal = '100%';
            bar.width(percentVal)
            percent.html(percentVal);
            if (data.message == 'success') {
                alert('Import Successfull');
                $('#patner').DataTable().ajax.reload()
                $('#myModal').modal('hide');
            } else {
                alert('something goes wrong ' + data.message);
                $('input[type=file]').val('')
                $('#import-info').hide('display')
                $('#myModal').modal('hide');

            }
            if (data.desc == 'errors') {
                alert('something goes wrong');
                $('input[type=file]').val('')
                $('#import-info').hide('display')
            }
        });
    });

</script>