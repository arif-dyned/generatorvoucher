<?php
if (Request::segment(2) == 'edit') {
    $title = 'Update';
    $link = 'organizations/save/';

} else {
    $title = 'Add New';
    $link = 'organizations/save';
}
?>
<div class="row">
    <section class="container">
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"> Home </a></li>
            <li><a href="{{ url('organizations') }}">Organizations</a></li>
            <li class="active">{{ $title }}</li>
        </ol>
    </section>

    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                {{ $title }} Organization
                <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-cog" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
            </header>
            <div class="panel-body">
                {!! Form::open(['url' => $link, 'class' => 'cmxform form-horizontal', 'id'=>'signupForm','enctype' => 'multipart/form-data', 'files' => true]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group ">
                    <label for="nis" class="control-label col-lg-3">Organization Name</label>
                    <div class="col-lg-6">
                        <input class=" form-control" id="id" name="id" type="hidden"
                               value="{{!empty($data) ? $data->id : '0'}}"/>
                        <input class=" form-control" id="organization_name" name="organization_name" type="text"
                               value="{{!empty($data) ? str_replace('_',' ',$data->organization_name) : old("organization_name") }}"/>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="email" class="control-label col-lg-3">Email</label>
                    <div class="col-lg-6">
                        <input class=" form-control" id="email" name="email" type="email"
                               value="{{!empty($data) ? $data->email : old("email") }}"/>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="nis" class="control-label col-lg-3">Discount (%)</label>
                    {{--<label><input type="radio" id="percent"--}}
                    {{--name="type_discont"--}}
                    {{--{{!empty($data) && ($data->type_discont=='percent') ? 'checked' : old("discont") }} value="percent">--}}
                    {{--Percent (%)</label>--}}
                    {{--<label><input type="radio" id="dollar"--}}
                    {{--name="type_discont"--}}
                    {{--{{!empty($data) && ($data->type_discont=='dollar') ? 'checked' : old("discont") }} value="dollar">--}}
                    {{--Dollar ($)</label>--}}
                    <div class="col-lg-6">
                        <input class=" form-control" id="discont" name="discont" type="number"
                               value="{{!empty($data) ? str_replace('_',' ',$data->discont) : old("discont") }}"/>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="email" class="control-label col-lg-3">Expiration Date</label>
                    <div class="col-lg-3">
                        <prelabel>Start Date</prelabel>
                        <input class=" form-control start_date" id="start_date" name="start_date" type="text"
                               value="{{!empty($data) ? $data->start_date : old("start_date") }}"
                               placeholder="Start Date"/>
                    </div>
                    <div class="col-lg-3">
                        <prelabel>End Date</prelabel>
                        <input class=" form-control end_date" id="end_date" name="end_date" type="text"
                               value="{{!empty($data) ? $data->end_date : old("end_date") }}" placeholder="End Date"/>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="email" class="control-label col-lg-3">Message</label>
                    <div class="col-lg-6">
                        <textarea class=" form-control" id="message"
                                  name="message">{{!empty($data) ? $data->message : old("message") }}</textarea>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="email" class="control-label col-lg-3">Partner ID</label>
                    <div class="col-lg-6">
                        <select name="partner_id" id="partner_id" class="col-lg-12">
                            <option value="NULL"></option>
                            @foreach(\App\Http\Models\Partner::all() as $partner_)
                                <option value="{{$partner_->id}}" {{!empty($data) && ($data->partner_id == $partner_->id) ? 'selected':''}}>{{$partner_->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="email" class="control-label col-lg-3">Subgroup ID</label>
                    <div class="col-lg-6">
                        <select name="sub_group_id" id="sub_group_id" class="col-lg-12">
                        </select>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="control-label col-lg-3">Type Voucher</label>
                    <div class="col-lg-6">
                        <label>Multiple<input type="radio" id="type_voucher" name="type_voucher"
                                              class="form-control type_all"
                                              value="multiple" {{!empty($data) && ($data->type_voucher == 'single') ? 'checked' : '' }}></label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>Single<input type="radio" id="type_voucher" name="type_voucher"
                                            class="form-control type_personal"
                                            value="single" {{!empty($data) && ($data->type_voucher == 'multiple') ? 'checked' : '' }}></label>
                    </div>
                </div>
                <div class="form-group" id="voucher_code" style="display: none;">
                    <label for="email" class="control-label col-lg-3">Voucher Code</label>
                    <div class="col-lg-6">
                        <input class=" form-control" name="voucher_code" type="text"
                               value="{{!empty($data) ? $data->voucher_code : old("voucher_code") }}" readonly/>
                    </div>
                </div>
                <div class="form-group" id="voucher_code">
                    <label for="email" class="control-label col-lg-3">Quota Voucher</label>
                    <div class="col-lg-6">
                        <input class=" form-control" name="quota" type="text"
                               value="{{!empty($data) ? $data->quota : old("quota") }}"/>
                    </div>
                </div>

                <div class="form-group"></div>
                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-6">
                        <button class="btn btn-default" type="reset">Reset</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </section>
    </div>
</div>
@include('organization.modal')
<script src="{{url('js/jquery-1.8.3-clone.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        $('#partner_id').select2()
        $('#sub_group_id').select2()
        $('.type_all').on('change', function () {
            $('#voucher_code').show()
            $('[name=voucher_code]').val(randomString(8, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'))
        })
        $('.type_personal').on('change', function () {
            $('#voucher_code').hide()
            $('[name=voucher_code]').val('')
        })
        if ($('.type_all').prop('checked') == true) {
            $('#voucher_code').show()
        }
        setTimeout(function () {
            $("#partner_id").trigger('change')
        }, 1000)
        $('#partner_id').on('change', function () {
            $('#sub_group_id').html("")
            $("#sub_group_id").select2("val", " ")
            var id = $("#partner_id option:selected").val();

            $.get('{{url("organizations/get_sub_group_id")}}/' + id, function (content) {
                $.each(content, function (key, value) {
                    var idvalue = value.id;
                    var idsub_groupid = {{ !empty($data) ? $data->sub_group_id : ''}}
                    $("#sub_group_id").select2("val", idsub_groupid)
                    $('#sub_group_id').append('<option value=\'' + value.id + '\'>' + value.name + '</option>')
                })
            })
        });
    })
    function randomString(length, chars) {
        var result = '';
        for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
        return result;
    }
</script>