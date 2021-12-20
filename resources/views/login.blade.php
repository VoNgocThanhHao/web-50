<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link rel="shortcut icon" href="{{ asset("images/logo/logo_header.png") }}"/>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{--    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/all.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('AdminLTE/css/adminlte.min.css') }}">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('login_admin/css/style.css')  }}">
    {{--    <link rel="stylesheet" href="{{ asset('MDBootstrap/css/mdb.min.css') }}">--}}
</head>

<body>


<img class="wave" src="{{asset("login_admin/img/background.png")}}">
<div class="container">
    <div class="img">
        <img src="{{asset('login_admin/img/login.svg')}}">
    </div>
    <div class="login-content">
        <form>
            <img src="{{asset("login_admin/img/welcome_cats.svg")}}" style="height: 170px;">
            <div class="input-div one" style="margin-top: 15px">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <h5>Tên đăng nhập</h5>
                    <input type="text" class="input username">
                </div>
            </div>
            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Mật khẩu</h5>
                    <input type="password" class="input password">
                </div>
            </div>
            <a href="#" class="forgetPass">Quên mật khẩu</a>
            <button type="button" class="btn">Đăng nhập</button>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{asset("login_admin/js/main.js")}}"></script>
{{--<script src="{{ asset("AdminLTE/plugins/jquery/jquery.min.js") }}"></script>--}}
{{--<script src="{{ asset("AdminLTE/plugins/bootstrap/bootstrap.bundle.min.js") }}"></script>--}}
{{--<script src="{{ asset("AdminLTE/js/adminlte.min.js") }}"></script>--}}
{{--<script src="{{ asset("AdminLTE/js/demo.js") }}"></script>--}}
{{--<script src="{{ asset("MDBootstrap/js/mdb.min.js") }}"></script>--}}
<script src="{{ asset('SweetAlert2/sweetalert2.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

<script type="text/javascript">

    var LOGIN = ' {{ action("App\Http\Controllers\usersController@login") }}';
    var RESET_PASSWORD = '{{ action('App\Http\Controllers\usersController@resetPass') }}';

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.input').keypress(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                $('.btn').click();
            }
        });

        $('.btn').click(function () {
            $.ajax({
                url: LOGIN,
                type: "POST",
                data: {
                    '_token': '{{csrf_token()}}',
                    'username': $('.username').val(),
                    'password': $('.password').val(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        $('.username').val('');
                        $('.password').val('');
                        Swal.fire({
                            icon: 'success',
                            title: 'Thao tác thành công',
                            showConfirmButton: false,
                            text: result.message,
                        })
                        setTimeout(function () {
                            window.location.href = "{{ action('App\Http\Controllers\usersController@getView') }}";
                        }, 1200);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thao tác thất bại',
                            text: result.message,
                        })
                    }
                }
            });
        });


        $('.forgetPass').click(async function () {

            Swal.showLoading();


            const {value: username} = await Swal.fire({
                title: 'Quên mật khẩu',
                input: 'text',
                inputLabel: 'Hãy nhập vào tên đăng nhập của bạn',
                showCancelButton: true,
                cancelButtonText: 'Hủy',
                reverseButtons: true,
                inputValidator: (value) => {
                    if (!value) {
                        return 'Xin hãy điền vào tên đăng nhập để lấy lại mật khẩu!'
                    }
                }
            })


            if (username) {

                let timerInterval
                Swal.fire({
                    title: 'Đang xử lý ...',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {})

                $.ajax({
                    url: RESET_PASSWORD,
                    type: "POST",
                    data: {
                        '_token': '{{csrf_token()}}',
                        'username': `${username}`,
                    },
                    success: function (result) {
                        Swal.hideLoading();
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: `Đã xử lý!`,
                                text: result.message,
                                showConfirmButton: true,
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thao tác thất bại',
                                text: result.message,
                            })
                        }
                    }
                });

            }
        });


    });

</script>


