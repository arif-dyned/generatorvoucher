<div class="row">
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"> Home </a></li>
            <li><a href="#">User Manager</a></li>
        </ol>
    </section>
    @include('layout.alert')
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
                    @if(Auth::user()->status !== 'tester' && Auth::user()->status !== 'developer')
                        <a href="{{ url('user-manager/create') }}" style="margin-top:30px">
                            <button class="btn btn-primary" type="submit">Add New Record</button>
                        </a>
                    @endif
                    <br><br>
                    {{--<a href="#" id="btn-import"><span class="btn btn-primary">Add Multiple Record</span></a>--}}
                    {{--{!! Form::open(['url' => '', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'files' => true,'method'=>'post']) !!}--}}
                    {{--{!! Form::file( 'files', ['style' => 'display:block;height:0;width:0;', 'multiple' => false, 'accept' => 'application/excel']) !!}--}}
                    {{--{!! Form::close() !!}--}}

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
                        @if($data->count() == 0)
                            <tr role="row">
                                <td colspan="6" class="text-center"> nothing to show</td>
                            </tr>
                        @endif

                        <?php $i_count = 1; ?>
                        @foreach($data as $user)
                            <tr role="row">
                                <td class="num">{{ $i_count }}</td>
                                <td class="tdmod">{{ $user->username }}</td>
                                <td class="tdmod">{{ $user->status }}</td>
                                <td class="tdmod"> -</td>
                                <td class="tdmod">{{ $user->updated_at }}</td>
                                @if(Auth::user()->status !== 'tester' && Auth::user()->status !== 'developer')
                                    <td class="flex" id="{{ $user->id }}">
                                        <a href="{{ url('user-manager/profile/'.$user->id) }}" name="btn_edit">Edit</a>
                                        |
                                        <a href="#" name="btn_delete"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                @else
                                    <td> not allowed</td>
                                @endif
                            </tr>
                            <?php $i_count += 1; ?>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    </div>
</div>

<!-- /.content -->

@section('footer_script')
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
                    url: "{!! url('user-manager/delete') !!}",
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
@stop