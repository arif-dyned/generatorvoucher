<div class="row">
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"> Home </a></li>
            <li><a href="{{ url('organizations') }}">Organizations</a></li>
            <li><a href="{{Request::segment(3)}}">Users</a></li>
        </ol>
    </section>
    @include('layout.alert')
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Master Users
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
                    <a href="{{url('employee/add/'.Request::segment(3))}}">
                        <button class="btn btn-primary" type="submit">Add New Record</button>
                    </a>
                    <a href="#" id="btn-import"><span class="btn btn-primary">Add Multiple Record</span></a>
                    {!! Form::open(['url' => '', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'files' => true,'method'=>'post']) !!}
                    {!! Form::file( 'files', ['style' => 'display:block;height:0;width:0;', 'multiple' => false, 'accept' => 'application/excel']) !!}
                    {!! Form::close() !!}

                </div>
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered"
                           id="patner">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Voucher</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </section>
    </div>
</div>


<script src="{{url('js/jquery-1.8.3-clone.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#patner').DataTable({
            serverSide: true,
            processing: true,
            ajax: "{{ url('trtempl/employee/'.Request::segment(3)) }}",
            columns: [
                {data: 'id', orderable: false, 'title': 'No'},
                {data: 'email', orderable: true},
                {data: 'voucher_code', orderable: true},
                {data: 'status', orderable: true},
                {
                    data: 'id', orderable: false, 'title': 'Action', "render": function (data, type, row) {
                    return '' +
                        '<a href="{{ url('employee/detail') }}/' + row.id + '">Detail |</a>&nbsp;&nbsp;&nbsp;' +
                        '<a href="{{ url('employee/edit') }}/' + row.id + '">Edit |</a>&nbsp;&nbsp;&nbsp;' +
                        '<a href="#" name="btn_delete" onclick="deleteOrganization(' + row.id + ')">Delete</a>';
                }
                },
                {
                    data: 'id',
                    orderable: false,
                    'title': 'Set Disable a Voucher',
                    "render": function (data, type, row) {
                        if (row.status == 'disable') {
                            var checkboxselect = "Checked";
                        } else {
                            var checkboxselect = "";
                        }
                        return '' +
                            '<label><input type="checkbox" value="' + row.id + '" ' + checkboxselect + ' status="' + row.status + '"> Yes</label>';
                    }
                }],
            'columnDefs': [
                {
                    'targets': 0,
                    'createdCell': function (td, cellData, rowData, row, col) {
                        $(td).text(row + 1);
                    }
                },
                {
                    'targets': 5,
                    'createdCell': function (td, cellData, rowData, row, col) {
                        $(td).attr('id', rowData.id);
                    }
                }
            ]

        });
        $.fn.dataTable.ext.errMode = 'none';
    })
    function deleteOrganization(id) {
        r = confirm("Are You Sure Want to Remove This?");
        if (r == true) {
            $.ajax({
                url: "{{url('employee/delete-employee')}}",
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

    $(document).on('change', '[type=checkbox]', function (e) {
        e.preventDefault()
        console.log('awas rusak')
        if (this.checked) {

            var id = $(this).val()
            var tabl = $(this).parents('table')
            var cc = tabl.find('input[type=checkbox]:checked')

            r = confirm("Are You Sure Want to Set Disable?");
            console.log(id)

            // when user is confirmed to delete
            if (r == true) {

                // run the ajax post function
                $.ajax({
                    url: "{!! url('employee/delete') !!}",
                    type: "POST",
                    data: {
                        id: id
                    },
                    error: function (data) {
                        console.log(data.responseText)
                    }
                }).done(function (data) {
                    $('#patner').DataTable().ajax.reload()
                })
            } else {
                $(this).removeAttr('checked')
            }
        } else {
            var id = $(this).val()
            r = confirm("Are You Sure Want to Set Enable?");

            if (r == true) {

                $.ajax({
                    url: "{!! url('employee/deletes') !!}",
                    type: "POST",
                    data: {
                        id: id
                    },
                    error: function (data) {
                        console.log(data.responseText)
                    }
                }).done(function (data) {
                    $('#patner').DataTable().ajax.reload()
                })
            } else {
                $(this).attr('checked', '')
            }
        }
    })

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
            url: "{!! url('organizations/upload/'.Request::segment(3)) !!}",
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
//                location.reload();
                console.log(data)
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
                location.reload();
            }
        });
    });

</script>