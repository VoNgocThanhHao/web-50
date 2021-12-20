@extends('master-admin')
@section('title') Quản lý danh mục @endsection
@section('style')
        <style>
            .product_img_info {
                position: relative;
                display: inline-block;
            }

            .product_img_info .text_info_product {
                visibility: hidden;
                width: 120px;
                bottom: 100%;
                left: 50%;
                margin-left: -60px;
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
    <div id="temp" hidden></div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Quản lý tài khoản người dùng</b>
            </h3>
            <br>

            <div class="row" style="margin-top: 10px">
                <button type="button" class="btn btn-outline-success btnInsert"
                        style="width: 100px">
                    <i class="fas fa-user-plus"></i> Thêm
                </button>

                <div id="selectCateBox">
{{--                    Select Category Parent--}}
                </div>
                <div class="ml-2 mt-1">
                    <button type="button" class="btn btn-outline-secondary btn-xs btnUpdateCatePa">
                        <i class="fas fa-cogs"></i>
                    </button>
                </div>
            </div>

        </div>
        <!-- /.card-header -->

        <div class="content">
            <div class="card-body">

                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1"
                                   class="table table-hover dataTable dtr-inline projects"
                                   role="grid"
                                   aria-describedby="example1_info" style="text-align: center">
                                <thead>
                                <tr role="row">
                                    <th class="" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        style="width: 200px"> Tên danh mục con
                                    </th>
                                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        style="width: 300px"> Số lượng
                                    </th>
                                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        style=""> Xem nhiều nhất
                                    </th>
                                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        style="width: 120px"> Danh mục cha

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



    <div class="modal fade" id="modalInsert">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm thông tin danh mục con</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Tên danh mục con</label>
                                <input type="text" class="form-control nameCatePa" placeholder="Tên danh mục con">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Danh mục</label>
                                <div id="selectCateInsertBox">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btnClose" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary btnSave">Thêm danh mục</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



@endsection
@section('dataTable')
    "initComplete": function(settings, json) {
    get_image();
    },
    "serverSide": true,
    "ajax": GET_CATE,
    "columns": [
    {"data": "name"},
    {"data": "quantity"},
    {"data": null},
    {"data": "name_parent"},
    {"data": null},
    ],
    "columnDefs": [
    {{--        {className: 'text-left', targets: [0,1,2]},--}}
    {{--        {className: 'text-center', targets: [-1,-2,-3]},--}}
    {
    "targets": -1,
    "data": null,
    "orderable":false,
    "render": function (data, type, row, meta) {
    return '\
    <div class="btn btn-outline-secondary btn-sm btnEdit" _name="'+row.name+'" _id="'+row.id+'" _id_parent="'+row.id_parent+'"   href="#">\
        <i class="fas fa-user-edit"></i> Sửa \
    </div>\
    <div class="btn btn-outline-danger btn-sm btnDelete" data="'+row.id+'" href="#">\
        <i class="fas fa-user-minus"></i> Xóa \
    </div>';
    }
    },
    {
    "targets": 1,
    "data": 'quantity',
    "render": function (data, type, row, meta) {
    return '<div class="progress progress-sm">\
        <div class="progress-bar bg-green progress-bar-striped" role="progressbar" aria-valuemin="0"\
             aria-valuemax="100" style="width: ' + data/row.quantity_all*100 + '%">\
        </div>\
    </div>\
    <small>'+
        data +' trên tổng số ' + row.quantity_all +
        '</small>';
    }
    },
    {
    "targets": 2,
    "data": null,
    "orderable":false,
    "render": function (data, type, row, meta) {
    return '<div class="imageProduct" data="'+row.id+'"></div>';
    }
    },

    ],
@endsection
@section('script')
    <script type="text/javascript">


        var GET_CATE_PARENT = '{{ action('App\Http\Controllers\categoryParentController@getData') }}';
        var GET_CATE_PARENT_INSERT = '{{ action('App\Http\Controllers\categoryParentController@getSelectInsert') }}';
        var INSERT_CATE_PARENT = '{{ action('App\Http\Controllers\categoryParentController@insert') }}';
        var DELETE_CATE_PARENT = '{{ action('App\Http\Controllers\categoryParentController@delete') }}';
        var UPDATE_CATE_PARENT = '{{ action('App\Http\Controllers\categoryParentController@update') }}';

        var GET_CATE = '{{ action('App\Http\Controllers\categoryController@getData') }}';
        var GET_CATE_FILTER = '{{ action('App\Http\Controllers\categoryController@getDataFilter') }}';
        var GET_IMAGE_PRODUCT = '{{ action('App\Http\Controllers\categoryController@getImageProduct') }}';
        var INSERT_CATE = '{{ action('App\Http\Controllers\categoryController@insert') }}';
        var DELETE_CATE = '{{ action('App\Http\Controllers\categoryController@delete') }}';
        var UPDATE_CATE = '{{ action('App\Http\Controllers\categoryController@update') }}';


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

        var get_data = function (id = 0){
            $('.btnUpdateCatePa').prop('disabled', true);
            $.ajax({
                url: GET_CATE_PARENT,
                type: "GET",
                data: {
                    'id' : id,
                },
                success: function (result) {
                    $('#selectCateBox').html('');
                    $('#selectCateBox').html(result);
                }
            });
        }

        var get_image = function (){

            $('.imageProduct').map(function (){
                var id = $(this);
            //     console.log(id.attr('data'));
                $.ajax({
                    url: GET_IMAGE_PRODUCT,
                    type: "GET",
                    data: {
                        'id': id.attr('data'),
                        // 'id': 2,
                    },
                    success: function (result) {
                        id.html('');
                        id.html(result);
                    }
                });
            });
        }


        var get_data_table = function (){
            $(".table").DataTable().destroy();
            $('.table').DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                language: {
                    "processing": "Đang xử lý...",
                    "emptyTable": "Không có dữ liệu",
                    "info": "Hiển thị _START_ tới _END_ của _TOTAL_ dữ liệu",
                    "infoEmpty": "Hiển thị 0 tới 0 của 0 dữ liệu",
                    "lengthMenu": "Hiển thị _MENU_ dữ liệu",
                    "loadingRecords": "Đang tải...",
                    "paginate": {
                        "first": "Đầu tiên",
                        "last": "Cuối cùng",
                        "next": "Sau",
                        "previous": "Trước"
                    },
                    "search": "Tìm kiếm:",
                    "zeroRecords": "Không tìm thấy kết quả",
                    "searchPlaceholder": "Tìm kiếm"
                },
                "initComplete": function(settings, json) {
                    get_image();
                },
                "serverSide": true,
                "ajax": GET_CATE,
                "columns": [
                    {"data": "name"},
                    {"data": "quantity"},
                    {"data": null},
                    {"data": "name_parent"},
                    {"data": null},
                ],
                "columnDefs": [
                    {
                        "targets": -1,
                        "data": null,
                        "orderable":false,
                        "render": function (data, type, row, meta) {
                            return '\
    <div class="btn btn-outline-secondary btn-sm btnEdit" _name="'+row.name+'" _id="'+row.id+'" _id_parent="'+row.id_parent+'"   href="#">\
        <i class="fas fa-user-edit"></i> Sửa \
    </div>\
    <div class="btn btn-outline-danger btn-sm btnDelete" data="'+row.id+'" href="#">\
        <i class="fas fa-user-minus"></i> Xóa \
    </div>';
                        }
                    },
                    {
                        "targets": 1,
                        "data": 'quantity',
                        "render": function (data, type, row, meta) {
                            return '<div class="progress progress-sm">\
        <div class="progress-bar bg-green progress-bar-striped" role="progressbar" aria-valuemin="0"\
             aria-valuemax="100" style="width: ' + data/row.quantity_all*100 + '%">\
        </div>\
    </div>\
    <small>'+
                                data +' trên tổng số ' + row.quantity_all +
                                '</small>';
                        }
                    },
                    {
                        "targets": 2,
                        "data": null,
                        "orderable":false,
                        "render": function (data, type, row, meta) {
                            return '<div class="imageProduct" data="'+row.id+'"></div>';
                        }
                    },

                ],
            });
        }

        var get_data_table_filter = function (value){
            $(".table").DataTable().destroy();
            $(".table").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                language: {
                    "processing": "Đang xử lý...",
                    "emptyTable": "Không có dữ liệu",
                    "info": "Hiển thị _START_ tới _END_ của _TOTAL_ dữ liệu",
                    "infoEmpty": "Hiển thị 0 tới 0 của 0 dữ liệu",
                    "lengthMenu": "Hiển thị _MENU_ dữ liệu",
                    "loadingRecords": "Đang tải...",
                    "paginate": {
                        "first": "Đầu tiên",
                        "last": "Cuối cùng",
                        "next": "Sau",
                        "previous": "Trước"
                    },
                    "search": "Tìm kiếm:",
                    "zeroRecords": "Không tìm thấy kết quả",
                    "searchPlaceholder": "Tìm kiếm"
                },
                "initComplete": function(settings, json) {
                    get_image();
                },
                "serverSide": true,
                "ajax": {
                    url: GET_CATE_FILTER,
                    type: 'GET',
                    data:{
                        'id' : value,
                    },
                },
                "columns": [
                    {"data": "name"},
                    {"data": "quantity"},
                    {"data": null},
                    {"data": "name_parent"},
                    {"data": null},
                ],
                "columnDefs": [
                    {
                        "targets": -1,
                        "data": null,
                        "orderable":false,
                        "render": function (data, type, row, meta) {
                            return '\
    <div class="btn btn-outline-secondary btn-sm btnEdit" _name="'+row.name+'" _id="'+row.id+'" _id_parent="'+row.id_parent+'"  href="#">\
        <i class="fas fa-user-edit"></i> Sửa \
    </div>\
    <div class="btn btn-outline-danger btn-sm btnDelete" data="'+row.id+'" href="#">\
        <i class="fas fa-user-minus"></i> Xóa \
    </div>';
                        }
                    },
                    {
                        "targets": 1,
                        "data": 'quantity',
                        "render": function (data, type, row, meta) {
                            return '<div class="progress progress-sm">\
        <div class="progress-bar bg-green progress-bar-striped" role="progressbar" aria-valuemin="0"\
             aria-valuemax="100" style="width: ' + data/row.quantity_all*100 + '%">\
        </div>\
    </div>\
    <small>'+
                                data +' trên tổng số ' + row.quantity_all +
                                '</small>';
                        }
                    },
                    {
                        "targets": 2,
                        "data": null,
                        "orderable":false,
                        "render": function (data, type, row, meta) {
                            return '<div class="imageProduct" data="'+row.id+'"></div>';
                        }
                    },

                ],
            });
        }


        $(document).ready(function () {

            get_data();

            $('.table').on( 'draw.dt', function () {
                get_image();
            } );

            $('.btnUpdateCatePa').click(async function () {

                var id = $('#selectCate').val();

                 Swal.fire({
                    title: 'Cập nhật tên danh mục',
                    input: 'text',
                    showCancelButton: true,
                    cancelButtonText: 'Hủy',
                    showDenyButton: true,
                    denyButtonText: 'Xóa',
                    confirmButtonText: 'Cập nhật',
                    reverseButtons: true,
                    inputPlaceholder: 'Tên danh mục',
                    inputValue: $('#selectCate').find(':selected').text(),
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Tên danh mục không được bỏ trống!'
                        }else{
                            $.ajax({
                                url: UPDATE_CATE_PARENT,
                                type: "POST",
                                data: {
                                    'id': id,
                                    'name': value,
                                },
                                success: function (result) {
                                    result = JSON.parse(result);
                                    if (result.status === 200) {
                                        get_data(id);
                                        $('.table').DataTable().ajax.reload();
                                        Swal.fire(
                                            'Thao tác thành công!',
                                            result.message,
                                            'success'
                                        )
                                    } else {
                                        Swal.fire(
                                            'Thao tác thất bại!',
                                            result.message,
                                            'error'
                                        )
                                    }
                                }
                            });
                        }
                    }
                }).then((result) => {
                    if(result.isDenied){
                        Swal.fire({
                            title: 'Các danh mục con, sản phẩm của nó sẽ bị xóa?',
                            text: "Sau khi xóa dữ liệu sẽ không thể khôi phục",
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
                                    url: DELETE_CATE_PARENT,
                                    type: "DELETE",
                                    data: {
                                        'id': id,
                                    },
                                    success: function (result) {
                                        result = JSON.parse(result);
                                        if (result.status === 200) {
                                            get_data();
                                            $('.table').DataTable().ajax.reload();
                                            Swal.fire(
                                                'Thao tác thành công!',
                                                result.message,
                                                'success'
                                            )
                                        } else {
                                            Swal.fire(
                                                'Thao tác thất bại!',
                                                result.message,
                                                'error'
                                            )
                                        }

                                    }
                                });
                            }
                        })

                        get_data();
                    }
                });
            });


            $(document).on('change','#selectCate', function () {

                var value = $(this).val();

                if (value === '-1' || value === '0') {
                    $('.btnUpdateCatePa').prop('disabled', true);
                    get_data_table();
                }else {
                    $('.btnUpdateCatePa').prop('disabled', false);
                    get_data_table_filter(value);
                }

                if (value === '-1') {
                    Swal.fire({
                        title: 'Thêm danh mục',
                        input: 'text',
                        showCancelButton: true,
                        cancelButtonText: 'Hủy',
                        confirmButtonText: 'Thêm',
                        reverseButtons: true,
                        inputPlaceholder: 'Tên danh mục',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'Tên danh mục không được bỏ trống!'
                            } else {
                                $.ajax({
                                    url: INSERT_CATE_PARENT,
                                    type: "PUT",
                                    data: {
                                        'name': value,
                                    },
                                    success: function (result) {
                                        result = JSON.parse(result);
                                        if (result.status === 200) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: `Đã xử lý!`,
                                                text: result.message,
                                            })
                                            get_data();
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
                        }
                    })
                }
            });


            $('.btnClose').click(function () {
                $('#modalInsert').modal('hide');
            });


            $('.btnInsert').click(function (){
                $('.nameCatePa').val('');
                $('.modal-title').html('Thêm thông tin danh mục con');
                $('.btnSave').html('Thêm danh mục');
                $('#modalInsert').modal('show');
                var id = $('#selectCate').val();
                $.ajax({
                    url: GET_CATE_PARENT_INSERT,
                    type: "GET",
                    data: {
                        'id': id,
                    },
                    success: function (result) {
                        $('#selectCateInsertBox').html('');
                        $('#selectCateInsertBox').html(result);
                    }
                });

                $('.btnSave').attr('type','insert');

            });

            $(document).on('click','.btnEdit',function (){
                $('.nameCatePa').val($(this).attr('_name'));
                $('.modal-title').html('Cập nhật thông tin danh mục con');
                $('.btnSave').html('Cập nhật danh mục');
                $('#modalInsert').modal('show');
                var id = $(this).attr('_id_parent');
                $.ajax({
                    url: GET_CATE_PARENT_INSERT,
                    type: "GET",
                    data: {
                        'id': id,
                    },
                    success: function (result) {
                        $('#selectCateInsertBox').html('');
                        $('#selectCateInsertBox').html(result);
                    }
                });

                $('.btnSave').attr('type','update').attr('data',$(this).attr('_id'));
            });



            $('.btnSave').click(function (){
                if ($('.nameCatePa').val() === ''){
                    Swal.fire({
                        icon: 'error',
                        title: 'Tên danh mục không được bỏ trống',
                    })
                    return;
                }


                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: INSERT_CATE,
                            type: "PUT",
                            data: {
                                'name': $('.nameCatePa').val(),
                                'id_parent': $('#selectCateInsert').val(),
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    $('.table').DataTable().ajax.reload();
                                    $('#modalInsert').modal('hide');
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
                            url: UPDATE_CATE,
                            type: "POST",
                            data: {
                                'id' : id,
                                'name': $('.nameCatePa').val(),
                                'id_parent': $('#selectCateInsert').val(),
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    $('.table').DataTable().ajax.reload();
                                    $('#modalInsert').modal('hide');
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
                    title: 'Xóa danh mục sẽ xóa tất cả sản phẩm của nó?',
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
                            url: DELETE_CATE,
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
