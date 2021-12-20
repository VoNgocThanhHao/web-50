<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Thay đổi mật khẩu </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('reset_password/css/my-login.css') }}">
</head>

<body class="my-login-page">
<section class="h-100" >
    <div class="container h-100">
        <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    <img src="{{ asset('reset_password/img/logo.jpg') }}" alt="logo">
                </div>
                <div class="card fat">
                    <div class="card-body">
                        <h4 class="card-title">Đặt lại mật khẩu</h4>
                            <div class="form-group">
                                <label for="email">Tên đăng nhập</label>
                                <input type="text" class="form-control" value="{{ $username }}" disabled >
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input id="password" type="password" class="form-control pass" required data-eye>
                                <div style="color: red">
                                    <span class="alert-pass"></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="password_confirm">Xác nhận mật khẩu</label>
                                <input id="password_confirm" type="password" class="form-control repass" required data-eye>
                                <div style="color: red">
                                    <span class="alert-repass"></span>
                                </div>
                            </div>

                            <div class="form-group m-0">
                                <button type="button" class="btn btn-primary btn-block btnConfirm">
                                    Xác nhận
                                </button>
                            </div>
                    </div>
                </div>
                <div class="footer">
                    Copyright &copy; 2021 &mdash; Brownie
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="{{ asset('reset_password/js/my-login.js') }}"></script>
<script src="{{ asset('SweetAlert2/sweetalert2.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>

<script type="text/javascript">

    var RESET_PASSWORD = '{{ action('App\Http\Controllers\usersController@reset_password') }}'

    $(document).ready(function () {

        $('.pass').keyup (function (){
            if($(this).val().length <= 6) {
                $('.alert-pass').html('Mật khẩu phải trên 6 ký tự');
            }else{
                $('.alert-pass').html('');
            }

            $('.repass').keyup();
        });

        $('.repass').keyup (function (){
            if($(this).val() != $('.pass').val()) {
                $('.alert-repass').html('Mật khẩu không trùng khớp!');
            }else{
                $('.alert-repass').html('');
            }
        });

        $('.btnConfirm').click(function (){

            $.ajax({
                url: RESET_PASSWORD,
                type: "POST",
                data: {
                    '_token': '{{csrf_token()}}',
                    'token': '{{ $token }}',
                    'id': {{ $id }},
                    'password': $('#password').val(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        $('#password').val('');
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

    })

</script>
