<div class="row">
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>"> Home </a></li>
            <li><a href="#">Position</a></li>
        </ol>
    </section>
    <?php echo $__env->make('layout.alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Master Position Employee
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
                    <button class="btn btn-primary" type="button" name="new">Add New Record</button>
                </div>
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered"
                           id="patner">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Modal -->
<div id="myModals" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_id" id="_id">
                Name
                <input type="text" name="_name" class="form-control" id="_name">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" name="save">Save</button>
            </div>
        </div>

    </div>
</div>

<script src="<?php echo e(url('js/jquery-1.8.3-clone.min.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#patner').DataTable({
            serverSide: true,
            processing: true,
            ajax: "<?php echo e(route('trtempl.position')); ?>",
            columns: [
                {data: 'id', orderable: false, 'title': 'No'},
                {data: 'position_name', orderable: true},
                {
                    data: 'id', orderable: false, 'title': 'Action', "render": function (data, type, row) {
                    return '' +
                        '<a href="#" data-id="' + row.id + '" data-name="' + row.position_name.replace(/_/g, " ") + '" name="detail">Detail |</a>&nbsp;&nbsp;&nbsp;' +
                        '<a href="#" data-id="' + row.id + '" data-name="' + row.position_name.replace(/_/g, " ") + '" name="edit">Edit |</a>&nbsp;&nbsp;&nbsp;' +
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
                        var str = rowData.position_name;
                        $(td).text(str.replace(/_/g, " "));
                        $(td).attr('id', rowData.id);
                        $(td).attr('name', 'btnPreview');
                        $(td).attr('style', 'cursor:pointer');
                    }
                }
            ]

        });
    })
    function deleteOrganization(id) {
        r = confirm("Are You Sure Want to Remove This?");
        if (r == true) {
            $.ajax({
                url: "<?php echo e(url('position/delete-organization')); ?>",
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

    $(document).on('click', '[name=new]', function () {
        $('#myModals').find('.modal-title').text('New Position')
        $('#myModals').find('[name=_id]').removeAttr('readonly')
        $('#myModals').find('[name=_name]').removeAttr('readonly')
        $('#myModals').find('button[name=save]').attr('style', '')

        var _id = this.getAttribute('data-id')
        var _name = this.getAttribute('data-name')
        $('#myModals').modal('show');
        $('#myModals').find('[name=_id]').val(_id)
        $('#myModals').find('[name=_name]').val(_name)
    })
    $(document).on('click', '[name=detail]', function () {
        $('#myModals').find('.modal-title').text('Detail Position')
        $('#myModals').find('[name=_id]').attr('readonly', '')
        $('#myModals').find('[name=_name]').attr('readonly', '')

        $('#myModals').find('button[name=save]').attr('style', 'display:none;')
        var _id = this.getAttribute('data-id')
        var _name = this.getAttribute('data-name')
        $('#myModals').modal('show');
        $('#myModals').find('[name=_id]').val(_id)
        $('#myModals').find('[name=_name]').val(_name)
    })

    $(document).on('click', '[name=edit]', function () {
        $('#myModals').find('.modal-title').text('Edit Position')
        $('#myModals').find('[name=_id]').removeAttr('readonly')
        $('#myModals').find('[name=_name]').removeAttr('readonly')
        $('#myModals').find('button[name=save]').attr('style', '')

        var _id = this.getAttribute('data-id')
        var _name = this.getAttribute('data-name')
        $('#myModals').modal('show');
        $('#myModals').find('[name=_id]').val(_id)
        $('#myModals').find('[name=_name]').val(_name)
    })

    $(document).on('click', '[name=save]', function () {
        $.ajax({
            url: "<?php echo url('position/save'); ?>",
            type: "POST",
            data: {
                'id': $('#myModals').find('[name=_id]').val(),
                'name': $('#myModals').find('[name=_name]').val()
            }, error: function (data) {
                console.log(data.responseText)
            }
        }).done(function (data) {
            if (data.desc == "ok") {
                alert('Success Update')
                $('#patner').DataTable().ajax.reload()
                $('#myModals').modal('hide')
            } else {
                console.log(data.responseText)
                $('#patner').DataTable().ajax.reload()
                $('#myModals').modal('hide')
            }
        })
    })

    function deleteOrganization(id) {
        r = confirm("Are You Sure Want to Remove This?");
        if (r == true) {
            $.ajax({
                url: "<?php echo e(url('position/delete')); ?>",
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


</script>