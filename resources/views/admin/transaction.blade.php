@extends('master-admin')
@section('title') Quản lý đơn hàng @endsection
@section('style')
    <style>
        .product_img_info {
            position: relative;
            display: inline-block;
        }

        .product_img_info .text_info_product {
            visibility: hidden;
            width: 180px;
            bottom: 100%;
            left: 50%;
            margin-left: -95px;
            margin-bottom: 7px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;

            /* Position the tooltip */
            position: absolute;
            z-index: 1;
        }

        .product_img_info:hover .text_info_product {
            visibility: visible;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Quản lý Đơn hàng</b>
            </h3>
            <br>
{{--            <button type="button" class="btn btn-outline-danger btnDeleteAll" style="width: 120px; margin-top: 10px; float: right">--}}
{{--                Xóa tất cả--}}
{{--                <i class="fas fa-trash-alt ml-1"></i>--}}
{{--            </button>--}}
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
                                        style="width: 100px"> Mã đơn hàng
                                    </th>
                                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        style="width: 250px"> Người đặt
                                    </th>
                                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        style="width: 180px"> Thời gian đặt
                                    </th>
                                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        style=""> Ghi chú
                                    </th>
                                    <th style="width: 150px">
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




    {{--    Modal--}}

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chi tiết đơn hàng</h4>
                    <button type="button" class="close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="tab-content container" id="contentModal">


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
    {"data": "transaction_code"},
    {"data": "name_profile"},
    {"data": "created_at"},
    {"data": "comment"},
    {"data": null},
    ],
    "columnDefs": [
{{--    {className: 'text-left', targets: [0,1,2]},--}}
    {"orderable":false, targets: [-2]},
    {
    "targets": -1,
    "data": null,
    "orderable":false,
    "render": function (data, type, row, meta) {
    return '<div class="btn btn-outline-primary btn-sm btnInfo" href="#" data="'+row.id+'">\
        <i class="fas fa-info-circle"></i> Chi tiết \
        </div>\
    <div class="btn btn-outline-danger btn-sm btnDelete" href="#" data="'+row.id+'">\
        <i class="fas fa-trash-alt"></i> Xóa \
    </div>';
    }
    },
    {
    "targets": 0,
    "data": "transaction_code",
    "render": function (data, type, row, meta) {
    return '<b>#'+data+'</b>';
    }
    },
    {
    "targets": 1,
    "data": "name_profile",
    "render": function (data, type, row, meta) {
    return row.username + ' (' + row.name_profile + ')';
    }
    },
    {
    "targets": 2,
    "data": "created_at",
    "render": function (data, type, row, meta) {
    return '<span>' + new Date(data).toLocaleString() + '</span>';
    }
    },



    ],
@endsection
@section('script')
    <script type="text/javascript">
        var GET_DATA = '{{ action('App\Http\Controllers\transactionController@getData') }}';
        var GET_MODAL = '{{ action('App\Http\Controllers\transactionController@getModal') }}'
        var UPDATE_CANCEL = '{{ action('App\Http\Controllers\transactionController@cancel') }}'
        var DELETE_TRANS = '{{ action('App\Http\Controllers\transactionController@delete') }}'

        var get_modal = function (id){
            $.ajax({
                url: GET_MODAL,
                type: "GET",
                data: {
                    'id': id,
                },
                success: function (result) {
                    $('#contentModal').html('')
                    $('#contentModal').html(result)
                }
            });
        }

        $(document).ready(function () {

            $(document).on('click','.btnInfo',function (){
                var id = $(this).attr('data')
                $('#myModal').attr('data',id);

                get_modal(id)

                $('#myModal').modal('show');
            })

            $('.close').click(function (){
                $('#myModal').modal('hide');
            })


            $(document).on('click','.btnCancel',function (){
                var id = $('#myModal').attr('data')
                Swal.fire({
                    title: 'Thay đổi trạng thái của đơn hàng',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Thay đổi',
                    cancelButtonText: 'Hủy',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: UPDATE_CANCEL,
                            type: "POST",
                            data: {
                                'id' : id,
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    get_modal(id)
                                    Swal.fire(
                                        'Thao tác thành công!',
                                        result.message,
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Thao tác thất bại',
                                        result.message,
                                        'error'
                                    )
                                }
                            }
                        });
                    }
                })
            })



            $(document).on('click','.btnDelete',function (){
                var id = $(this).attr('data')
                Swal.fire({
                    title: 'Xóa đơn hàng?',
                    text: 'Tất cả dữ liệu của đơn hàng sẽ bị xóa và không khôi phục được!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: DELETE_TRANS,
                            type: "DELETE",
                            data: {
                                'id' : id,
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    get_modal(id)
                                    Swal.fire(
                                        'Thao tác thành công!',
                                        result.message,
                                        'success'
                                    )
                                    $('.table').DataTable().ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Thao tác thất bại',
                                        result.message,
                                        'error'
                                    )
                                }
                            }
                        });
                    }
                })
            })

        });

    </script>
@endsection
