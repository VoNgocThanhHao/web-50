@extends('master-admin')
@section('title') Quản lý người dùng @endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Quản lý tài khoản người dùng</b>
            </h3>
            <br>
            <button type="button" class="btn btn-outline-success btnInsert" style="width: 100px; margin-top: 10px">
                <i class="fas fa-user-plus"></i> Thêm
            </button>
        </div>
        <!-- /.card-header -->

        <div class="content">
            <div class="card-body">

                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1"
                                   class="table table-hover dataTable dtr-inline"
                                   role="grid"
                                   aria-describedby="example1_info" style="text-align: center">
                                <thead>
                                <tr role="row">
                                    <th class="" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        style=""> Tên đăng nhập
                                    </th>
                                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        style=""> Mật khẩu
                                    </th>
                                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        style=""> Email
                                    </th>
                                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        style="width: 60px"> Xác thực
                                    </th>
                                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        style="width: 100px"> Loại tài khoản
                                    </th>
                                    <th style="width:130px">

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>





    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm tài khoản người dùng</h4>
                </div>

                <div class="container">
                    <div class="row">

                        <div class="input-group col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control username" placeholder="Tên đăng nhập">
                        </div>
                        <div class="mb-3 col-md-12" style="margin-left: 40px">
                            <span style="color: red" class="alert-username"></span>
                        </div>

                        <div class="input-group col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control password" placeholder="Mật khẩu">
                        </div>
                        <div class="mb-3 col-md-12" style="margin-left: 40px">
                            <span style="color: red" class="alert-password"></span>
                        </div>

                        <div class="input-group col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control email" placeholder="Email">
                        </div>
                        <div class="mb-3 col-md-12" style="margin-left: 40px">
                            <span style="color: red" class="alert-email"></span>
                        </div>

                        <div class="form-group mb-3 col-md-5">
                            <label>Loại tài khoản</label>
                            <select class="form-control" id="permission">
                                <option value="2">Admin</option>
                                <option value="1" selected>Nhân viên</option>
                                <option value="0">Khách hàng</option>
                            </select>
                        </div>

                        <div class="form-group mb-3 col-md-2"></div>

                        <div class="form-group mb-3 mt-3 col-md-5">
                            <div class="custom-control mt-3 custom-checkbox">
                                <input class="custom-control-input email_verified" type="checkbox" id="customCheckbox2" checked>
                                <label for="customCheckbox2" class="custom-control-label">Đã xác thực Email</label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger btnClose">Đóng</button>
                    <button type="button" class="btn btn-outline-primary btnSave">Thêm</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection
@section('dataTable')
    "serverSide": true,
    "ajax": GET_DATA,
    "columns": [
    {"data": "username"},
    {"data": "hint_password"},
    {"data": "email"},
    {"data": "email_verified_at"},
    {"data": "permission"},
    {"data": null},
    ],
    "columnDefs": [
    {className: 'text-left', targets: [0,1,2]},
    {className: 'text-center', targets: [-1,-2,-3]},
    {
    "targets": -1,
    "data": null,
    "orderable":false,
    "render": function (data, type, row, meta) {
    return '\
    <div class="btn btn-outline-secondary btn-sm btnEdit" href="#" \
         _id = "'+ row.id +'"\
         username = "'+ row.username +'"\
        password = "'+ row.hint_password +'"\
        permission = "'+ row.permission +'"\
        email = "'+ row.email +'"\
        verified = "'+ row.email_verified_at +'">\
        <i class="fas fa-user-edit"></i> Sửa \
    </div>\
    <div class="btn btn-outline-danger btn-sm btnDelete" href="#"\
         data = "'+ row.id +'"\
    >\
        <i class="fas fa-user-minus"></i> Xóa \
    </div>';
    }
    },
    {
    "targets": -3,
    "data": null,
    "render": function (data, type, row, meta) {
    if (data != null)
        return '<i class="fas fa-check-square"></i>';
    return '___';
    }
    },
    {
    "targets": -2,
    "data": null,
    "render": function (data, type, row, meta) {
    if (data === 2)
        return '<span class="badge bg-success">Admin</span>';
    else if (data === 1)
        return '<span class="badge bg-primary">Nhân viên</span>';
    return '<span class="badge">Khách hàng</span>';
    }
    },

    ],
@endsection
@section('script')
    <script type="text/javascript">

        var check_username = 'Tên đăng nhập không được bỏ trống!';
        var check_password = 'Mật khẩu không được bỏ trống!';
        var check_email = 'Email không được bỏ trống!';
        var timeout = null;

        var GET_DATA = '{{ action('App\Http\Controllers\usersController@getData') }}';
        var INSERT = '{{ action('App\Http\Controllers\usersController@insert') }}';
        var DELETE = '{{ action('App\Http\Controllers\usersController@delete') }}';
        var UPDATE = '{{action('App\Http\Controllers\usersController@update')}}';

        var CHECK_USERNAME = '{{ action('App\Http\Controllers\usersController@checkUsername') }}';
        var CHECK_USERNAME_UPDATE = '{{ action('App\Http\Controllers\usersController@checkUsername_update') }}';


        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })


        $(document).ready(function () {

            $('.btnClose').click(function () {
                $('#myModal').modal('hide');
            });

            $('.username').keyup(function (){
                var _this = $(this);

                clearTimeout(timeout);
                timeout = setTimeout(function ()
                {

                    if ($('.btnSave').attr('type')==='insert'){
                        if (_this.val().length === 0 ){
                            _this.attr('class', 'form-control username');
                            $('.alert-username').hide();
                            check_username = 'Tên đăng nhập không được bỏ trống!';
                            return;
                        }

                        $.ajax({
                            url: CHECK_USERNAME,
                            type: "POST",
                            data: {
                                'username': $('.username').val(),
                            },
                            success: function (result) {
                                if (result){
                                    $('.username').attr('class', 'form-control is-invalid username');
                                    $('.alert-username').html('Tên đăng nhập đã tồn tại');
                                    $('.alert-username').show();
                                    check_username = 'Tên đăng nhập đã có người sử dụng!';
                                }else{
                                    $('.username').attr('class', 'form-control is-valid username');
                                    $('.alert-username').hide();
                                    check_username = 'true';
                                }

                            }
                        });
                    }else if ($('.btnSave').attr('type')==='update'){
                        if (_this.val().length === 0 ){
                            _this.attr('class', 'form-control username');
                            $('.alert-username').hide();
                            check_username = 'Tên đăng nhập không được bỏ trống!';
                            return;
                        }

                        $.ajax({
                            url: CHECK_USERNAME_UPDATE,
                            type: "POST",
                            data: {
                                'id' : $('.btnSave').attr('data'),
                                'username': $('.username').val(),
                            },
                            success: function (result) {
                                if (result){
                                    $('.username').attr('class', 'form-control is-invalid username');
                                    $('.alert-username').html('Tên đăng nhập đã tồn tại');
                                    $('.alert-username').show();
                                    check_username = 'Tên đăng nhập đã có người sử dụng!';
                                }else{
                                    $('.username').attr('class', 'form-control is-valid username');
                                    $('.alert-username').hide();
                                    check_username = 'true';
                                }

                            }
                        });
                    }

                }, 500);




            });

            $('.password').keyup(function (){
                // if ($('.btnSave').attr('type')==='insert'){
                    if ($(this).val().length === 0 ){
                        $(this).attr('class', 'form-control password');
                        $('.alert-password').hide();
                        check_password = 'Mật khẩu không được bỏ trống!';
                        return;
                    }

                    if ($(this).val().length <= 6 ){
                        $(this).attr('class', 'form-control is-invalid password');
                        $('.alert-password').html('Mật khẩu phải trên 6 ký tự');
                        $('.alert-password').show();
                        check_password = 'Mật khẩu phải trên 6 ký tự!';
                        return;
                    }

                    $(this).attr('class', 'form-control is-valid password');
                    $('.alert-password').hide();
                    check_password = 'true';
                // }

            });

            $('.email').keyup(function (){
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                // if ($('.btnSave').attr('type')==='insert'){
                    if ($(this).val().length === 0 ){
                        $(this).attr('class', 'form-control email');
                        $('.alert-email').hide();
                        check_email = 'Email không được bỏ trống!';
                        return;
                    }

                    if (!regex.test($(this).val())){
                        $(this).attr('class', 'form-control is-invalid email');
                        $('.alert-email').html('Email không hợp lệ!');
                        $('.alert-email').show();
                        check_email = 'Email không hợp lệ!';
                        return;
                    }

                    $(this).attr('class', 'form-control is-valid email');
                    $('.alert-email').hide();
                    check_email = 'true';
                // }

            });

            $('.btnInsert').click(function () {
                $('.username, .password, .email').val('');
                $('#myModal .modal-title').text('Thêm tài khoản người dùng');
                $('#permission').val('1');
                $('.email_verified').prop('checked', true);
                $('.btnSave').attr('type', 'insert');
                $('.btnSave').html('Thêm');

                $('.alert-username').hide();
                $('.alert-password').hide();
                $('.alert-email').hide();
                $('.username').attr('class', 'form-control username');
                $('.password').attr('class', 'form-control password');
                $('.email').attr('class', 'form-control email');
                check_username = 'Tên đăng nhập không được bỏ trống!';
                check_password = 'Mật khẩu không được bỏ trống!';
                check_email = 'Email không được bỏ trống!';

                $('#myModal').modal('show');
            });

            $(document).on('click','.btnEdit',function (){
                $('.username').val($(this).attr('username'));
                $('.password').val($(this).attr('password'));
                $('.email').val($(this).attr('email'));
                $('#permission').val($(this).attr('permission'));
                $('.email_verified').prop('checked', $(this).attr('verified') !== "null");
                $('#myModal .modal-title').text('Cập nhật tài khoản người dùng');
                $('.btnSave').attr('type', 'update').attr('data',$(this).attr('_id'));
                $('.btnSave').html('Cập nhật');

                $('.alert-username').hide();
                $('.alert-password').hide();
                $('.alert-email').hide();
                $('.username').attr('class', 'form-control username');
                $('.password').attr('class', 'form-control password');
                $('.email').attr('class', 'form-control email');
                check_username = 'true';
                check_password = 'true';
                check_email = 'true';

                $('#myModal').modal('show');
            });



            $('.btnSave').click(function () {

                if (check_username !== 'true'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: check_username,
                    })
                    return;
                }

                if (check_password !== 'true'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: check_password,
                    })
                    return;
                }

                if (check_email !== 'true'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: check_email,
                    })
                    return;
                }

                var email_verified = false;
                if ($('.email_verified').is(':checked')) email_verified = true;
                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: INSERT,
                            type: "PUT",
                            data: {
                                'username': $('.username').val(),
                                'password': $('.password').val(),
                                'email': $('.email').val(),
                                'email_verified': email_verified,
                                'permission': $('#permission').val(),
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    $('.table').DataTable().ajax.reload();
                                    $('#myModal').modal('hide');
                                    Toast.fire({
                                        icon: 'success',
                                        title: result.message,
                                    })
                                } else {
                                    Toast.fire({
                                        icon: 'error',
                                        title: result.message,
                                    })
                                }
                            }
                        });
                        break;

                    case 'update':
                        var id = $(this).attr('data');
                        $.ajax({
                            url: UPDATE,
                            type: "POST",
                            data: {
                                'id' : id,
                                'username': $('.username').val(),
                                'password': $('.password').val(),
                                'email': $('.email').val(),
                                'email_verified': $('.email_verified').is(':checked'),
                                'permission': $('#permission').val(),
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    $('.table').DataTable().ajax.reload();
                                    $('#myModal').modal('hide');
                                    Toast.fire({
                                        icon: 'success',
                                        title: result.message,
                                    })
                                } else {
                                    Toast.fire({
                                        icon: 'error',
                                        title: result.message,
                                    })
                                }
                            }
                        });
                        break;
                }
            });


            $(document).on('click','.btnDelete',function (){
                var id = $(this).attr('data');

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa?',
                    text: "Dữ liệu bị xóa sẽ không khôi phục được!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Chắc chắn, xóa!',
                    cancelButtonText: 'Hủy bỏ!',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: DELETE,
                            type: "DELETE",
                            data: {
                                'id': id,
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    $('.table').DataTable().ajax.reload();
                                    Swal.fire(
                                        'Đã xóa!',
                                        result.message,
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Xóa thất bại!',
                                        result.message,
                                        'error'
                                    )
                                }

                            }
                        });
                    }
                })


            });



        });
    </script>
@endsection
