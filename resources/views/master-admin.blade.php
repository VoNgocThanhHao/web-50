<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset("images/logo/logo_header.png") }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
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
        .btnEdit{
            color: black;
        }

        .btnDelete{
            color: red;
        }

        .my-span{
            font-size: 15px;
        }

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
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->


<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

{{--            <li class="nav-item dropdown">--}}
{{--                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">--}}
{{--                    <i class="far fa-bell"></i>--}}
{{--                    <span class="badge badge-danger navbar-badge message">15</span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="fas fa-envelope mr-2"></i> 4 new messages--}}
{{--                        <span class="float-right text-muted text-sm">3 mins</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </li>--}}



            <li class="nav-item">
                <a class="nav-link"  href="{{ action('App\Http\Controllers\usersController@logout') }}" role="button">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->



    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="{{ asset("images/logo/logo_header.png")}}" alt="Brownie Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Manager</span>
        </a>


        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                        <img src="{{ asset(Auth::user()->profile['image']) }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ action('App\Http\Controllers\profileController@getView',Auth::user()->id) }}"
                       class="d-block ten"> {{ Auth::user()->profile['name'] }}</a>
                </div>
            </div>



            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @if( Auth::user()->permission == 2 )
                        <li class="nav-item">
                            <a href="{{ action('App\Http\Controllers\usersController@getView') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-circle"></i>
                                <p>
                                    T??i kho???n
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('details') }}" class="nav-link">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    Th??ng tin ng?????i d??ng
                                </p>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{action('App\Http\Controllers\categoryParentController@getView')}}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Danh m???c
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ action('App\Http\Controllers\productController@getView') }}" class="nav-link">
                            <i class="nav-icon fas fa-utensils"></i>
                            <p>
                                Th???c ????n
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ action('App\Http\Controllers\transactionController@getView') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                ????n h??ng
                            </p>
                        </a>
                    </li>




                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
    </div>
    <!-- ./wrapper -->

{{--    <script>--}}
{{--        MQTTconnect();--}}
{{--    </script>--}}

    <footer class="bg-dark text-center text-white">
        <strong>Copyright &copy; 2021 <a href="#">V?? Ng???c Thanh H??o</a>.</strong>
    </footer>
</div>

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

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(function () {

            $(".table").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                language: {
                    "processing": "??ang x??? l??...",
                    "infoFiltered": "(???????c l???c t??? _MAX_ m???c)",
                    "aria": {
                        "sortAscending": ": S???p x???p th??? t??? t??ng d???n",
                        "sortDescending": ": S???p x???p th??? t??? gi???m d???n"
                    },
                    "autoFill": {
                        "cancel": "H???y",
                        "fill": "??i???n t???t c??? ?? v???i <i>%d<\/i>",
                        "fillHorizontal": "??i???n theo h??ng ngang",
                        "fillVertical": "??i???n theo h??ng d???c"
                    },
                    "buttons": {
                        "collection": "Ch???n l???c <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
                        "colvis": "Hi???n th??? theo c???t",
                        "colvisRestore": "Kh??i ph???c hi???n th???",
                        "copy": "Sao ch??p",
                        "copyKeys": "Nh???n Ctrl ho???c u2318 + C ????? sao ch??p b???ng d??? li???u v??o clipboard.<br \/><br \/>????? h???y, click v??o th??ng b??o n??y ho???c nh???n ESC",
                        "copySuccess": {
                            "1": "???? sao ch??p 1 d??ng d??? li???u v??o clipboard",
                            "_": "???? sao ch??p %d d??ng v??o clipboard"
                        },
                        "copyTitle": "Sao ch??p v??o clipboard",
                        "csv": "File CSV",
                        "excel": "File Excel",
                        "pageLength": {
                            "-1": "Xem t???t c??? c??c d??ng",
                            "_": "Hi???n th??? %d d??ng"
                        },
                        "pdf": "File PDF",
                        "print": "In"
                    },
                    "infoThousands": "`",
                    "select": {
                        "cells": {
                            "1": "1 ?? ??ang ???????c ch???n",
                            "_": "%d ?? ??ang ???????c ch???n"
                        },
                        "columns": {
                            "1": "1 c???t ??ang ???????c ch???n",
                            "_": "%d c???t ??ang ???????c ???????c ch???n"
                        },
                        "rows": {
                            "1": "1 d??ng ??ang ???????c ch???n",
                            "_": "%d d??ng ??ang ???????c ch???n"
                        }
                    },
                    "thousands": "`",
                    "searchBuilder": {
                        "title": {
                            "_": "Thi???t l???p t??m ki???m (%d)",
                            "0": "Thi???t l???p t??m ki???m"
                        },
                        "button": {
                            "0": "Thi???t l???p t??m ki???m",
                            "_": "Thi???t l???p t??m ki???m (%d)"
                        },
                        "value": "Gi?? tr???",
                        "clearAll": "X??a h???t",
                        "condition": "??i???u ki???n",
                        "conditions": {
                            "date": {
                                "after": "Sau",
                                "before": "Tr?????c",
                                "between": "N???m gi???a",
                                "empty": "R???ng",
                                "equals": "B???ng v???i",
                                "not": "Kh??ng ph???i",
                                "notBetween": "Kh??ng n???m gi???a",
                                "notEmpty": "Kh??ng r???ng"
                            },
                            "number": {
                                "between": "N???m gi???a",
                                "empty": "R???ng",
                                "equals": "B???ng v???i",
                                "gt": "L???n h??n",
                                "gte": "L???n h??n ho???c b???ng",
                                "lt": "Nh??? h??n",
                                "lte": "Nh??? h??n ho???c b???ng",
                                "not": "Kh??ng ph???i",
                                "notBetween": "Kh??ng n???m gi???a",
                                "notEmpty": "Kh??ng r???ng"
                            },
                            "string": {
                                "contains": "Ch???a",
                                "empty": "R???ng",
                                "endsWith": "K???t th??c b???ng",
                                "equals": "B???ng",
                                "not": "Kh??ng ph???i",
                                "notEmpty": "Kh??ng r???ng",
                                "startsWith": "B???t ?????u v???i"
                            },
                            "array": {
                                "equals": "B???ng",
                                "empty": "Tr???ng",
                                "contains": "Ch???a",
                                "not": "Kh??ng",
                                "notEmpty": "Kh??ng ???????c r???ng",
                                "without": "kh??ng ch???a"
                            }
                        },
                        "logicAnd": "V??",
                        "logicOr": "Ho???c",
                        "add": "Th??m ??i???u ki???n",
                        "data": "D??? li???u",
                        "deleteTitle": "X??a quy t???c l???c"
                    },
                    "searchPanes": {
                        "countFiltered": "{shown} ({total})",
                        "emptyPanes": "Kh??ng c?? ph???n t??m ki???m",
                        "clearMessage": "X??a h???t",
                        "loadMessage": "??ang load ph???n t??m ki???m",
                        "collapse": {
                            "0": "Ph???n t??m ki???m",
                            "_": "Ph???n t??m ki???m (%d)"
                        },
                        "title": "B??? l???c ??ang ho???t ?????ng - %d",
                        "count": "{total}"
                    },
                    "datetime": {
                        "hours": "Gi???",
                        "minutes": "Ph??t",
                        "next": "Sau",
                        "previous": "Tr?????c",
                        "seconds": "Gi??y"
                    },
                    "emptyTable": "Kh??ng c?? d??? li???u",
                    "info": "Hi???n th??? _START_ t???i _END_ c???a _TOTAL_ d??? li???u",
                    "infoEmpty": "Hi???n th??? 0 t???i 0 c???a 0 d??? li???u",
                    "lengthMenu": "Hi???n th??? _MENU_ d??? li???u",
                    "loadingRecords": "??ang t???i...",
                    "paginate": {
                        "first": "?????u ti??n",
                        "last": "Cu???i c??ng",
                        "next": "Sau",
                        "previous": "Tr?????c"
                    },
                    "search": "T??m ki???m:",
                    "zeroRecords": "Kh??ng t??m th???y k???t qu???",
                    "searchPlaceholder": "T??m ki???m"
                },
                @yield('dataTable')
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });


    });
</script>

@yield('script')
