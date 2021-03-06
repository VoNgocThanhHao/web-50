<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset("images/logo/logo_header.png") }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Brownie</title>
    <title>@yield('title')</title>


    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{--    <link rel="stylesheet" type="text/css" href="{{asset("MDBootstrap/css/mdb.min.css")}}">--}}
    <link rel="stylesheet" type="text/css" href="{{asset("AdminLTE/css/adminlte.min.css")}}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/toastr/toastr.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/select2/css/select2.min.css")}}">
    <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">



    {{--    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">--}}

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
    @yield('style')

</head>
<body class="layout-top-nav" style="height: auto;">
<div class="wrapper">


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white fixed-top">
        <div class="container">
            <a href="{{ action('App\Http\Controllers\pageController@getView') }}" class="navbar-brand">
                <img src="{{ asset('images/logo/logo_header.png').'?v='.time() }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">BROWNIE</span>
            </a>

            <button class="navbar-toggler order-1 collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse order-3 collapse" id="navbarCollapse" style="">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ action('App\Http\Controllers\pageController@getView') }}" class="nav-link">Trang ch???</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ action('App\Http\Controllers\pageController@getViewMenuProduct') }}" class="nav-link">Th???c ????n</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('recruitment') }}" class="nav-link">Tuy???n d???ng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btnShowBook" style="cursor: pointer">?????t b??n</a>
                    </li>

                </ul>


            </div>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                @if(!Auth::user())
                <button type="button" class="btn btn-block btn-outline-primary btnLoginModal">????ng nh???p</button>

                @else

                <!-- Cart -->
                <li class="nav-item ">
                    <a class="nav-link" href="{{ action('App\Http\Controllers\pageController@getViewCart', Auth::user()['id']) }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-danger navbar-badge" id="boxCart"></span>
                    </a>
                </li>

                <!-- User Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <img alt="Avatar" class="table-avatar" src="{{ asset(Auth::user()->profile['image']).'?v='.time() }}" style="height: 100%; border-radius: 50%">
                        {{ Auth::user()->profile['name'] }}
                        @if(!Auth::user()['email_verified_at'])
                        <span class="badge badge-danger navbar-badge">!</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu" style="left: inherit; right: 0px;">
                        <div class="dropdown-divider"></div>
                        <a href="{{ action('App\Http\Controllers\pageController@getViewProfile', Auth::user()['id']) }}" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Th??ng tin c?? nh??n
                        </a>
                        <a href="#" class="dropdown-item btnChangPass">
                            <i class="fas fa-key mr-2 "></i> ?????i m???t kh???u
                        </a>
                        @if(!Auth::user()['email_verified_at'])
                        <a class="dropdown-item itemVerify" style="cursor:pointer;">
                            <i class="fas fa-envelope mr-2"></i> X??c th???c email
                            <span class="float-right text-muted text-sm">Ch??a x??c th???c</span>
                        </a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a href="{{ action('App\Http\Controllers\usersController@logout') }}" class="dropdown-item dropdown-footer btnLogout">????ng xu???t</a>
                    </div>
                </li>

                    @endif

            </ul>
        </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 360px;">

            @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="modalLogin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">????ng nh???p</h4>
                    <button type="button" class="close btnCloseLogin"aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control nameLogin" placeholder="T??n ????ng nh???p">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control passLogin" placeholder="M???t kh???u">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="showPass">
                                        <label for="remember">
                                            Hi???n m???t kh???u
                                        </label>
                                    </div>
                                </div>

                                <div class="col-4 text-center">
                                    <p class="mb-1">
                                        <a href="#" class="forgetPass">Qu??n m???t kh???u</a>
                                    </p>
                                    <p class="mb-0 mt-3">
                                        <a href="#" class="text-center btnRegisShow">????ng k?? t??i kho???n</a>
                                    </p>
                                </div>

                            </div>



                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btnCloseLogin">????ng</button>
                    <button type="button" class="btn btn-primary btnLogin">????ng nh???p</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->




    <div class="modal fade" id="modalRegis">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">????ng k?? t??i kho???n</h4>
                </div>

                <div class="container">
                    <div class="row">

                        <div class="input-group col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control nameRegis" placeholder="T??n ????ng nh???p">
                        </div>
                        <div class="mb-3 col-md-12" style="margin-left: 40px">
                            <span style="color: red" class="alert-username"></span>
                        </div>

                        <div class="input-group col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control passRegis" placeholder="M???t kh???u">
                        </div>
                        <div class="mb-3 col-md-12" style="margin-left: 40px">
                            <span style="color: red" class="alert-password"></span>
                        </div>

                        <div class="input-group col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control rePassRegis" placeholder="Nh???p l???i m???t kh???u">
                        </div>
                        <div class="mb-3 col-md-12" style="margin-left: 40px">
                            <span style="color: red" class="alert-repassword"></span>
                        </div>

                        <div class="input-group col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control emailRegis" placeholder="Email">
                        </div>
                        <div class="mb-3 col-md-12" style="margin-left: 40px">
                            <span style="color: red" class="alert-email"></span>
                        </div>

                        <div class="form-group mb-2 col-md-5">
                            <div class="custom-control mt-1 custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="showPassRegis">
                                <label for="showPassRegis" class="custom-control-label">Hi???n m???t kh???u</label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger btnCloseRegis">????ng</button>
                    <button type="button" class="btn btn-outline-primary btnRegis">????ng k??</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal fade" id="modalChangePass">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">?????i m???t kh???u</h4>
                </div>

                <div class="container">
                    <div class="row">

                        <div class="input-group col-md-12 mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control passOld" placeholder="M???t kh???u c??">
                        </div>

                        <div class="input-group col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control passNew" placeholder="M???t kh???u m???i">
                        </div>
                        <div class="mb-3 col-md-12" style="margin-left: 40px">
                            <span style="color: red" class="alert-password"></span>
                        </div>

                        <div class="input-group col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control rePassNew" placeholder="Nh???p l???i m???t kh???u m???i">
                        </div>
                        <div class="mb-3 col-md-12" style="margin-left: 40px">
                            <span style="color: red" class="alert-repassword"></span>
                        </div>

                        <div class="form-group mb-2 col-md-5">
                            <div class="custom-control mt-1 custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="showPassChange">
                                <label for="showPassChange" class="custom-control-label">Hi???n m???t kh???u</label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger btnCloseChange">????ng</button>
                    <button type="button" class="btn btn-outline-primary btnChange">?????i m???t kh???u</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal fade" id="modalBookTable">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">?????t b??n</h4>
                    <button type="button" class="close btnCloseBookTable"aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                    <div class="form-group col-md-12">
                        <label>Chi nh??nh</label>
                        <select class="form-control" id="locationBook">
                            <option value="0" selected>88 Ph???m Th??i B?????ng Ph?????ng 4, V??nh Long</option>
                            <option value="1">115 ???????ng Nguy???n Th??? Minh Khai, Ph?????ng 1, V??nh Long</option>
                        </select>
                    </div>

    <div class="form-group col-md-12">
        <label for="">T??n ng?????i ?????t:</label>
        <input type="text" class="form-control nameBook" value="">
    </div>
                        <div class="form-group col-md-6">
                            <label for="">S??? ??i???n tho???i:</label>
                            <input type="text" class="form-control phoneBook"
                                   data-inputmask="'mask': ['9999-999-999']" data-mask="" inputmode="text"
                                   value="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">S??? ng?????i:</label>
                            <input type="number" class="form-control quantityBook" value="1">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">Ng??y:</label>
                            <input type="date" class="form-control dayBook">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">Gi???:</label>
                            <input type="time" class="form-control timeBook">
                        </div>

                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btnCloseBookTable">????ng</button>
                    <button type="button" class="btn btn-primary btnBookTable">????ng nh???p</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



<!-- FOOTER -->
    <footer class="w-100 py-4 flex-shrink-0 bg-gradient-dark">
        <div class="container py-4">
            <div class="row gy-4 gx-5">
                <div class="col-lg-4 col-md-6 text-center">
                    <img src="{{ asset('images/logo/logo_header.png').'?v='.time() }}" alt="" style="height: 70px">
                    <h5 class="h1 text-black">BROWNIE</h5>

{{--                                        <p class="small text-muted"> 88 Ph???m Th??i B?????ng Ph?????ng 4, V??nh Long, Vi???t Nam</p>--}}
                    <p class="small  mb-0">&copy; Copyrights <a class="text-primary" href="#">Brownie.com</a></p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <ul class="list-unstyled  mt-3">
                        <li class="mb-3"><a href="{{ action('App\Http\Controllers\pageController@getView') }}" style="color: whitesmoke">Trang ch???</a></li>
                        <li class="mb-3"><a href="{{ action('App\Http\Controllers\pageController@getViewMenuProduct') }}" style="color: whitesmoke">Th???c ????n</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <ul class="list-unstyled  mt-3">
                        <li class="mb-3"><a href="{{ route('recruitment') }}" style="color: whitesmoke">Tuy???n d???ng</a></li>
                        <li class="mb-3"><a href="#" style="color: whitesmoke">?????t b??n</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="mb-3">Li??n h??? v???i ch??ng t??i</h5>
                    <p class="small "><i class="fas fa-map-marker-alt mr-1"></i>88 Ph???m Th??i B?????ng Ph?????ng 4, V??nh Long, Vi???t Nam</p>
                    <p class="small "><i class="fas fa-envelope mr-1"></i>brownie@gmail.com</p>
                    <p class="small "><i class="fas fa-phone mr-1"></i>0849 211 557</p>

                </div>
            </div>
        </div>
    </footer>

</div>
<!-- ./wrapper -->




{{--<script src="{{asset("MDBootstrap/js/mdb.min.js")}}"></script>--}}
<script src="{{ asset("AdminLTE/plugins/toastr/toastr.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/jquery/jquery.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/bootstrap/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("js/main.js")}}"></script>
<script src="{{asset("AdminLTE/js/adminlte.min.js")}}"></script>
<script src="{{asset("AdminLTE/js/demo.js")}}"></script>
<script src="{{asset("SweetAlert2/sweetalert2.min.js")}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>


<script src="{{ asset("AdminLTE/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/jszip/jszip.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/pdfmake/pdfmake.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/pdfmake/vfs_fonts.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/inputmask/jquery.inputmask.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/moment/moment.min.js")}}"></script>
<script src="{{ asset("AdminLTE/plugins/daterangepicker/daterangepicker.js")}}"></script>
<script src="{{ asset("AdminLTE/plugins/select2/js/select2.full.min.js")}}"></script>
{{--<script src="{{ asset("AdminLTE/plugins/flot/jquery.flot.js")}}"></script>--}}
{{--<script src="{{ asset("AdminLTE/plugins/flot/plugins/jquery.flot.resize.js")}}"></script>--}}
{{--<script src="{{ asset("AdminLTE/plugins/flot/plugins/jquery.flot.pie.js")}}"></script>--}}


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>--}}


{{--<srcipt src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></srcipt>--}}


</body>
</html>
<script type="text/javascript">

    var check_username = 'T??n ????ng nh???p kh??ng ???????c b??? tr???ng!';
    var check_password = 'M???t kh???u kh??ng ???????c b??? tr???ng!';
    var check_repassword = 'M???t kh???u kh??ng th???ng nh???t!';
    var check_email = 'Email kh??ng ???????c b??? tr???ng!';
    var timeout = null;

    var GET_VIEW_CART = '{{ action('App\Http\Controllers\pageController@getQuantityCart') }}'
    var CHECK_USERNAME = '{{ action('App\Http\Controllers\usersController@checkUsername') }}';
    var REGIS = '{{ action('App\Http\Controllers\usersController@regis') }}';
    var LOGIN = '{{ action('App\Http\Controllers\usersController@userLogin') }}'
    var RESET_PASSWORD = '{{ action('App\Http\Controllers\usersController@resetPass') }}';
    var CHANGE_PASSWORD = '{{ action('App\Http\Controllers\usersController@changePassWord') }}'
    var GET_PASSWORD = '{{ action('App\Http\Controllers\usersController@getPassWord') }}'
    var BOOK_TABLE = '{{ action('App\Http\Controllers\bookTableController@insert') }}'

    @if(Auth::user())
    var VERIFY_EMAIL = '{{ action('App\Http\Controllers\usersController@verify', Auth::user()['id']) }}'
    var get_cart = function (){
        $.ajax({
            url: GET_VIEW_CART,
            type: "GET",
            data: {
                'id': {{ Auth::user()['id'] }},
            },
            success: function (result) {
                $('#boxCart').html('')
                if (result !== '0')
                    $('#boxCart').html(result)
            }
        });
    }
    @endif

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(function () {

            $('[data-mask]').inputmask();

            $('.btnLoginModal').click(function (){
                $('.nameLogin').val('')
                $('.passLogin').val('')
                $('#modalLogin').modal('show')
            })
            $('.btnCloseLogin').click(function (){
                $('#modalLogin').modal('hide')
            })

            $('#showPass').change(function (){
                if(this.checked) {
                    $('.passLogin').attr('type','text')
                }else{
                    $('.passLogin').attr('type','password')
                }
            })

            $('.btnRegisShow').click(function (){
                $('.nameRegis, .passRegis, .rePassRegis, .emailRegis').val('');
                $('#showPassRegis').prop('checked', false);

                $('.alert-username').hide();
                $('.alert-password').hide();
                $('.alert-repassword').hide();
                $('.alert-email').hide();
                $('.nameRegis').attr('class', 'form-control nameRegis');
                $('.passRegis').attr('class', 'form-control passRegis');
                $('.rePassRegis').attr('class', 'form-control rePassRegis');
                $('.emailRegis').attr('class', 'form-control emailRegis');
                check_username = 'T??n ????ng nh???p kh??ng ???????c b??? tr???ng!';
                check_password = 'M???t kh???u kh??ng ???????c b??? tr???ng!';
                check_repassword = 'M???t kh???u kh??ng th???ng nh???t!';
                check_email = 'Email kh??ng ???????c b??? tr???ng!';
                $('.passRegis').attr('type','password')
                $('.rePassRegis').attr('type','password')

                $('#modalLogin').modal('hide')
                $('#modalRegis').modal('show')
            })
            $('.btnCloseRegis').click(function (){
                $('#modalRegis').modal('hide')
            })
            $('#showPassRegis').change(function (){
                if(this.checked) {
                    $('.passRegis').attr('type','text')
                    $('.rePassRegis').attr('type','text')
                }else{
                    $('.passRegis').attr('type','password')
                    $('.rePassRegis').attr('type','password')
                }
            })


            $(document).on('.keyup','.nameRegis', )
            $('.nameRegis').keyup(function (){
                var _this = $(this);

                clearTimeout(timeout);
                timeout = setTimeout(function () {

                    if (_this.val().length === 0) {
                        _this.attr('class', 'form-control nameRegis');
                        $('.alert-username').hide();
                        check_username = 'T??n ????ng nh???p kh??ng ???????c b??? tr???ng!';
                        return;
                    }

                    $.ajax({
                        url: CHECK_USERNAME,
                        type: "POST",
                        data: {
                            'username': $('.nameRegis').val(),
                        },
                        success: function (result) {
                            if (result) {
                                $('.nameRegis').attr('class', 'form-control is-invalid nameRegis');
                                $('.alert-username').html('T??n ????ng nh???p ???? t???n t???i');
                                $('.alert-username').show();
                                check_username = 'T??n ????ng nh???p ???? c?? ng?????i s??? d???ng!';
                            } else {
                                $('.nameRegis').attr('class', 'form-control is-valid nameRegis');
                                $('.alert-username').hide();
                                check_username = 'true';
                            }

                        }
                    });

                    if (_this.val().length === 0) {
                        _this.attr('class', 'form-control nameRegis');
                        $('.alert-username').hide();
                        check_username = 'T??n ????ng nh???p kh??ng ???????c b??? tr???ng!';
                        return;
                    }
                }, 500)

            });

            $('.rePassRegis').keyup(function (){
                if ($(this).val().length === 0 ){
                    $(this).attr('class', 'form-control rePassRegis');
                    $('.alert-repassword').hide();
                    check_repassword = 'M???t kh???u kh??ng th???ng nh???t!';
                    return;
                }

                if ($(this).val() !== $('.passRegis').val()){
                    $(this).attr('class', 'form-control is-invalid rePassRegis');
                    $('.alert-repassword').html('M???t kh???u kh??ng th???ng nh???t!');
                    $('.alert-repassword').show();
                    check_repassword = 'M???t kh???u kh??ng th???ng nh???t!';
                    return;
                }

                $(this).attr('class', 'form-control is-valid rePassRegis');
                $('.alert-repassword').hide();
                check_repassword = 'true';

            });

            $('.passRegis').keyup(function (){
                if ($(this).val().length === 0 ){
                    $(this).attr('class', 'form-control passRegis');
                    $('.alert-password').hide();
                    check_password = 'M???t kh???u kh??ng ???????c b??? tr???ng!';
                    return;
                }

                if ($(this).val().length <= 6 ){
                    $(this).attr('class', 'form-control is-invalid passRegis');
                    $('.alert-password').html('M???t kh???u ph???i tr??n 6 k?? t???');
                    $('.alert-password').show();
                    check_password = 'M???t kh???u ph???i tr??n 6 k?? t???!';
                    return;
                }

                $(this).attr('class', 'form-control is-valid passRegis');
                $('.alert-password').hide();
                check_password = 'true';
                // }

            });

            $('.emailRegis').keyup(function (){
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if ($(this).val().length === 0 ){
                    $(this).attr('class', 'form-control emailRegis');
                    $('.alert-email').hide();
                    check_email = 'Email kh??ng ???????c b??? tr???ng!';
                    return;
                }

                if (!regex.test($(this).val())){
                    $(this).attr('class', 'form-control is-invalid emailRegis');
                    $('.alert-email').html('Email kh??ng h???p l???!');
                    $('.alert-email').show();
                    check_email = 'Email kh??ng h???p l???!';
                    return;
                }

                $(this).attr('class', 'form-control is-valid emailRegis');
                $('.alert-email').hide();
                check_email = 'true';

            });

            $('.btnRegis').click(function () {
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

                if (check_repassword !== 'true'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: check_repassword,
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


                $.ajax({
                    url: REGIS,
                    type: "POST",
                    data: {
                        'username': $('.nameRegis').val(),
                        'password': $('.passRegis').val(),
                        'email': $('.emailRegis').val(),
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thao t??c th??nh c??ng',
                                text: result.message,
                            })
                            $('#modalRegis').modal('hide')
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thao t??c th???t b???i',
                                text: result.message,
                            })
                        }
                    }
                });
            });

            $('.btnLogin').click(function (){
                $.ajax({
                    url: LOGIN,
                    type: "POST",
                    data: {
                        'username': $('.nameLogin').val(),
                        'password': $('.passLogin').val(),
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thao t??c th??nh c??ng',
                                showConfirmButton: false,
                                text: result.message,
                            })
                            setTimeout(function () {
                                window.location.reload()
                            }, 1200);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thao t??c th???t b???i',
                                text: result.message,
                            })
                        }
                    }
                });
            })


            $('.forgetPass').click(async function () {

                $('#modalLogin').modal('hide')

                Swal.showLoading();


                const {value: username} = await Swal.fire({
                    title: 'Qu??n m???t kh???u',
                    input: 'text',
                    inputLabel: 'H??y nh???p v??o t??n ????ng nh???p c???a b???n',
                    showCancelButton: true,
                    cancelButtonText: 'H???y',
                    reverseButtons: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Xin h??y ??i???n v??o t??n ????ng nh???p ????? l???y l???i m???t kh???u!'
                        }
                    }
                })


                if (username) {

                    let timerInterval
                    Swal.fire({
                        title: '??ang x??? l?? ...',
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
                                    title: `???? x??? l??!`,
                                    text: result.message,
                                    showConfirmButton: true,
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Thao t??c th???t b???i',
                                    text: result.message,
                                })
                            }
                        }
                    });

                }
            });


            @if(Auth::user())
            get_cart();

            $('.btnChangPass').click(function (){
                $('.passOld, .rePassNew, .passNew').val('');
                $('#showPassChange').prop('checked', false);

                $('.alert-password').hide();
                $('.alert-repassword').hide();
                $('.alert-email').hide();
                $('.passOld').attr('class', 'form-control passOld');
                $('.rePassNew').attr('class', 'form-control rePassNew');
                $('.passNew').attr('class', 'form-control passNew');
                check_password = 'M???t kh???u kh??ng ???????c b??? tr???ng!';
                check_repassword = 'M???t kh???u kh??ng th???ng nh???t!';
                $('.passOld').attr('type','password')
                $('.rePassNew').attr('type','password')
                $('.passNew').attr('type','password')

                $('#modalChangePass').modal('show')
            })

            $('#showPassChange').change(function (){
                if(this.checked) {
                    $('.passOld').attr('type','text')
                    $('.rePassNew').attr('type','text')
                    $('.passNew').attr('type','text')
                }else{
                    $('.passOld').attr('type','password')
                    $('.rePassNew').attr('type','password')
                    $('.passNew').attr('type','password')
                }
            })


            $('.passNew').keyup(function (){
                if ($(this).val().length === 0 ){
                    $(this).attr('class', 'form-control passNew');
                    $('.alert-password').hide();
                    check_password = 'M???t kh???u kh??ng ???????c b??? tr???ng!';
                    return;
                }

                if ($(this).val().length <= 6 ){
                    $(this).attr('class', 'form-control is-invalid passNew');
                    $('.alert-password').html('M???t kh???u ph???i tr??n 6 k?? t???');
                    $('.alert-password').show();
                    check_password = 'M???t kh???u ph???i tr??n 6 k?? t???!';
                    return;
                }

                $(this).attr('class', 'form-control is-valid passNew');
                $('.alert-password').hide();
                check_password = 'true';


                if ($('.rePassNew').val().length === 0 ){
                    $('.rePassNew').attr('class', 'form-control rePassNew');
                    $('.alert-repassword').hide();
                    check_repassword = 'M???t kh???u kh??ng th???ng nh???t!';
                    return;
                }

                if ($('.rePassNew').val() !== $('.passNew').val()){
                    $('.rePassNew').attr('class', 'form-control is-invalid rePassNew');
                    $('.alert-repassword').html('M???t kh???u kh??ng th???ng nh???t!');
                    $('.alert-repassword').show();
                    check_repassword = 'M???t kh???u kh??ng th???ng nh???t!';
                    return;
                }

                $('.rePassNew').attr('class', 'form-control is-valid rePassNew');
                $('.alert-repassword').hide();
                check_repassword = 'true';
            });


            $('.rePassNew').keyup(function (){
                if ($(this).val().length === 0 ){
                    $(this).attr('class', 'form-control rePassNew');
                    $('.alert-repassword').hide();
                    check_repassword = 'M???t kh???u kh??ng th???ng nh???t!';
                    return;
                }

                if ($(this).val() !== $('.passNew').val()){
                    $(this).attr('class', 'form-control is-invalid rePassNew');
                    $('.alert-repassword').html('M???t kh???u kh??ng th???ng nh???t!');
                    $('.alert-repassword').show();
                    check_repassword = 'M???t kh???u kh??ng th???ng nh???t!';
                    return;
                }

                $(this).attr('class', 'form-control is-valid rePassNew');
                $('.alert-repassword').hide();
                check_repassword = 'true';

            });



            $('.btnChange').click(function () {

                if (check_password !== 'true'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: check_password,
                    })
                    return;
                }

                if (check_repassword !== 'true'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: check_repassword,
                    })
                    return;
                }


                $.ajax({
                    url: GET_PASSWORD,
                    type: "POST",
                    data: {
                        'id': {{ Auth::user()['id'] }},
                    },
                    success: function (result) {
                        var password = result;
                        if ($('.passOld').val() !== password){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'M???t kh???u kh??ng ch??nh x??c!',
                            })
                            return;
                        }else{
                            $.ajax({
                                url: CHANGE_PASSWORD,
                                type: "POST",
                                data: {
                                    'id': {{ Auth::user()['id'] }},
                                    'password': $('.passNew').val(),
                                },
                                success: function (result) {
                                    result = JSON.parse(result);
                                    if (result.status === 200) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Thao t??c th??nh c??ng',
                                            text: result.message,
                                        })
                                        $('#modalChangePass').modal('hide')
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Thao t??c th???t b???i',
                                            text: result.message,
                                        })
                                    }
                                }
                            });
                        }
                    }
                });


            });

            $('.btnCloseChange').click(function (){
                $('#modalChangePass').modal('hide')
            })
            @endif


            $('.btnShowBook').click(function (){
                $('#locationBook').val(0);
                $('.quantityBook').val('1')
                $('.dayBook').val('')
                $('.timeBook').val('')

                @if(Auth::user())
                $('.nameBook').val('{{ Auth::user()->profile['name'] }}')
                $('.phoneBook').val('{{ Auth::user()->profile['phone_number'] }}')
                @else
                $('.nameBook').val('')
                $('.phoneBook').val('')
                @endif

                $('#modalBookTable').modal('show')

            })

            $('.btnCloseBookTable').click(function (){
                $('#modalBookTable').modal('hide')
            })

            $('.btnBookTable').click(function (){
                if ($('.quantityBook').val() <= 0 || $('.quantityBook').val() === ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Thao t??c th???t b???i',
                        text: 'S??? l?????ng kh??ng h???p l???!',
                    })
                    return;
                }
                if ($('.nameBook').val() === ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Thao t??c th???t b???i',
                        text: 'T??n ng?????i ?????t kh??ng ???????c b??? tr???ng!',
                    })
                    return;
                }
                if ($('.phoneBook').val() === ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Thao t??c th???t b???i',
                        text: 'S??? ??i???n tho???i kh??ng ???????c b??? tr???ng!',
                    })
                    return;
                }
                if ($('.dayBook').val() === ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Thao t??c th???t b???i',
                        text: 'Ng??y ?????t kh??ng ???????c b??? tr???ng!',
                    })
                    return;
                }
                if ($('.timeBook').val() === ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Thao t??c th???t b???i',
                        text: 'Gi??? ?????t kh??ng ???????c b??? tr???ng!',
                    })
                    return;
                }


                $.ajax({
                    url: BOOK_TABLE,
                    type: "POST",
                    data: {
                        'location': $('#locationBook').val(),
                        'name':$('.nameBook').val(),
                        'phone_number':$('.phoneBook').val(),
                        'quantity':$('.quantityBook').val(),
                        'day':$('.dayBook').val(),
                        'time':$('.timeBook').val(),
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thao t??c th??nh c??ng',
                                text: result.message,
                            })
                            $('#modalBookTable').modal('hide')
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thao t??c th???t b???i',
                                text: result.message,
                            })
                        }
                    }
                });
            })

        });

        @if(Auth::user())

        $('.itemVerify').click(function (){

            Swal.showLoading();

                let timerInterval
                Swal.fire({
                    title: '??ang x??? l?? ...',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {})

            $.ajax({
                url: VERIFY_EMAIL,
                type: "POST",
                data: {
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        Swal.hideLoading();
                        Swal.fire({
                            icon: 'success',
                            title: 'Thao t??c th??nh c??ng',
                            text: result.message,
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thao t??c th???t b???i',
                        })
                    }
                }
            });




        })

        @endif


    });
</script>

@yield('script')
