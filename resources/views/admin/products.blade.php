@extends('master-admin')
@section('title') Thực đơn @endsection
@section('style')

@endsection
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thông tin thực đơn</h1>
                    <button type="button" class="btn btn-outline-success btnInsert"
                            style="width: 100px; margin-top: 10px">
                        <i class="fas fa-plus"></i> Thêm
                    </button>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>




    <section class="content">


        <div class="card card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-7 col-sm-10">
                        <div class="tab-content" id="vert-tabs-right-tabContent">

                            <div class="tab-pane fade show active" id="page_product_all" role="tabpanel"
                                 aria-labelledby="vert-tabs-right-home-tab">



                                    <div class="row">
                                        <div class="col-12" id="accordion">

                                            <div class="row">
                                                <div class="col-md-8 offset-md-2 mb-3">
                                                    <div class="input-group">
                                                        <input type="search" data="0" class="form-control form-control search_product" placeholder="Nhập tên sản phẩm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="search_all">

                                            </div>

                                        </div>
                                    </div>



                            </div>



                            @foreach( $data as $item)
                            <div class="tab-pane fade" id="page_cate_{{ $item['id'] }}" role="tabpanel"
                                 aria-labelledby="vert-tabs-right-home-tab">


                                <div class="row">
                                    <div class="col-12" id="accordion_{{ $item['id'] }}">

                                        <div class="row">
                                            <div class="col-md-8 offset-md-2 mb-3">
                                                <div class="input-group">
                                                    <input type="search" data="{{ $item['id'] }}" class="form-control form-control search_product_cate" placeholder="Nhập tên sản phẩm">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="search_cate_{{ $item['id'] }}">
                                        @foreach($item['category'] as $index)

                                            <div class="card card-primary card-outline">

                                                <a class="d-block w-100 collapsed" data-toggle="collapse"
                                                   href="#page_cate_pro_{{$index['id']}}" aria-expanded="false">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            <strong><i class="far fa-list-alt mr-1"></i> {{ $index['name'] }} </strong>
                                                        </h4>
                                                    </div>
                                                </a>
                                                <div id="page_cate_pro_{{$index['id']}}" class="collapse" data-parent="#accordion_{{ $item['id'] }}" style="">
                                                    <div class="card-body">


                                                        <div class="row">


                                                                @foreach($index->product as $product)

                                                                    <div
                                                                        class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
                                                                        <div class="card bg-light d-flex flex-fill">
                                                                            <div class="card-body pt-0">
                                                                                <div class="row mb-2 mt-2">
                                                                                    <div class="col-6 text-center">
                                                                                        <span class="" style="font-size: 15px"><b>{{ $product['name'] }}</b></span>
                                                                                    </div>
                                                                                    <div class="col-6 text-center">
                                                                                        <img
                                                                                            src="{{ asset($product['image']) }}"
                                                                                            alt="user-avatar"
                                                                                            class="img-circle img-fluid">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <p class="text-muted text-sm"><b>Mô tả: </b>
                                                                                        {{ $product['description'] }} </p>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                                        <li class="small"><span class="fa-li"><i
                                                                                                    class="fas fa-lg fa-money-bill-wave"></i></span>
                                                                                            Giá: <span class="price_product">{{ number_format($product['price'], 0 ,"," ,".") }}</span> VNĐ
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                <div class="text-right">
                                                                                    <a href="{{ action('App\Http\Controllers\productController@getViewDetail',$product['id']) }}" class="btn btn-sm btn-primary">
                                                                                        <i class="fas fa-search"></i> Xem chi tiết
                                                                                    </a>
                                                                                    <a href="#" class="btn btn-sm btn-danger btnDeleteProduct" data="{{ $product['id'] }}" id_cate ="{{ $product['id_category'] }}">
                                                                                        <i class="fas fa-trash"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach


                                                        </div>


                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                        </div>
                                    </div>
                                </div>


                            </div>
                            @endforeach



                        </div>
                    </div>


                    <div class="col-5 col-sm-2">
                        <div class="nav flex-column nav-tabs nav-tabs-right h-100" id="vert-tabs-right-tab"
                             role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="vert-tabs-right-home-tab" data-toggle="pill"
                               href="#page_product_all" role="tab" aria-controls="vert-tabs-right-home"
                               aria-selected="true">Tất cả</a>
                            @foreach($data as $item )
                                <a class="nav-link tab_catePa" id="vert-tabs-right-profile-tab" data-toggle="pill" data="{{ $item['id'] }}"
                                   href="#page_cate_{{ $item['id'] }}" role="tab" aria-controls="vert-tabs-right-profile"
                                   aria-selected="false"><strong><i class="far fa-list-alt mr-1"></i> {{ $item['name'] }} </strong></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>


    </section>





    <div class="modal fade" id="modalInsert">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm thông tin sản phẩm</h4>
                </div>

                <div class="container">
                    <div class="row">

                        <div class="col-md-4">

                            <div class="text-center">
                                <div class="row">
                                    <img class="profile-user-img img-fluid img-circle" id="imageProductView"
                                         src="{{ asset('images/products/Unknow.jpg') }}">
                                </div>
                                <button class="btn btn-outline-primary btn-xs mt-2 btnEditUpload">
                                    <i class="fas fa-cut"></i> Cắt ảnh
                                </button>
                                <button class="btn btn-outline-primary btn-xs mt-2 btnUpload">
                                    <i class="fas fa-folder-open" ></i> Chọn ảnh
                                </button>
                                <input type="file" accept="image/png, image/jpeg, image/jpg" name="imageProduct" placeholder="Choose image" id="imageProduct" hidden>
                            </div>

                            <hr>

                            <div class="text-center">
                                <div class="row">
                                    <strong class="col-md-12">Tổng số ảnh mô tả: <span id="quantityImage"></span></strong>
                                </div>
                                <button class="btn btn-outline-secondary btn-xs btnThemAnh">
                                    <i class="fas fa-plus"></i>Thêm ảnh
                                </button>
                            </div>

                            <form enctype="multipart/form-data" id="formInsert">
                            <input type="file" accept="image/png, image/jpeg, image/jpg" multiple name="images[]" id="mulImage" hidden>
                            </form>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="input-group col-md-12 mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    </div>
                                    <input type="text" class="form-control nameProduct" placeholder="Tên sản phẩm">
                                </div>

                                <div class="input-group col-md-6 mt-3">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calculator"></i></span>
                                    </div>
                                    <input type="number" class="form-control priceProduct" placeholder="Giá tiền">
                                    <div class="input-group-append">
                                        <span class="input-group-text">VND</span>
                                    </div>
                                </div>


                                <div class="input-group col-md-6 mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-bars"></i></span>
                                    </div>
                                    <select class="js-states form-control" id="selectCate">
                                        <option value="-1" disabled selected>Danh mục</option>
                                        @foreach($data as $item )
                                            <optgroup label="{{ $item['name'] }}">
                                                @foreach($item['category'] as $index)
                                                    <option value="{{ $index['id'] }}">{{ $index['name'] }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="">Mô tả sản phẩm</label>
                                    <textarea class="form-control descriptionProduct" rows="4" placeholder="Mô tả"></textarea>
                                </div>
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







    <div id="uploadimageModal" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cắt ảnh</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="image_demo" style="margin-top:30px"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger btnCloseUpload">Đóng</button>
                    <button type="button" class="btn btn-outline-primary btnReChoose">Chọn lại</button>
                    <button type="button" class="btn btn-outline-primary crop_image">Cắt và lưu</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript">


        var image_product = '';

        var INSERT_PRODUCT = '{{ action('App\Http\Controllers\productController@insert') }}';
        var GET_PRODUCT_ALL = '{{ action('App\Http\Controllers\productController@getProductAll') }}';
        var GET_PRODUCT_OF_CATE = '{{ action('App\Http\Controllers\productController@getProductOfCategory') }}';
        var GET_PRODUCT_OF_CATE_PAGE = '{{ action('App\Http\Controllers\productController@getProductOfCategoryPage') }}';
        var GET_PRODUCT_FILTER_ALL = '{{ action('App\Http\Controllers\productController@getProductFilterAll') }}';
        var GET_PRODUCT_FILTER_CATE = '{{ action('App\Http\Controllers\productController@getProductFilterCategory') }}';
        var DELETE_PRODUCT = '{{ action('App\Http\Controllers\productController@delete') }}'
        var timeout = null;

        // var format_price = function (){
        //     $(".price_product").each(function() {
        //         var val = $(this).html();
        //         $(this).html((val/1000).toFixed(3));
        //     });
        // }

        var getProductAll = function (){
            $.ajax({
                url: GET_PRODUCT_ALL,
                type: "GET",
                data: {},
                success: function (result) {
                    $('#search_all').html('')
                    $('#search_all').html(result);
                }
            });
        };

        var getProductOfCate = function (id_cate){
            $.ajax({
                url: GET_PRODUCT_OF_CATE,
                type: "GET",
                data: {
                    'id': id_cate,
                },
                success: function (result) {
                    $('#page_cate_pro_'+id_cate).html('');
                    $('#page_cate_pro_'+id_cate).html(result);
                }
            });

        }

        var getProductOfCarePage = function (id_catePa){
            $.ajax({
                url: GET_PRODUCT_OF_CATE_PAGE,
                type: "GET",
                data: {
                    'id': id_catePa,
                },
                success: function (result) {
                    $('#search_cate_'+id_catePa).html('');
                    $('#search_cate_'+id_catePa).html(result);
                }
            });
        }

        $(document).ready(function () {

            var image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width:200,
                    height:200,
                    type:'square' //circle
                },
                boundary:{
                    width:300,
                    height:300
                }
            });


            $('#imageProduct').change(function(){
                $('.btnEditUpload').show();
                let reader = new FileReader();

                reader.onload = (e) => {

                    image_crop.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
                        // console.log('jQuery bind complete');
                    });

                }

                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show');
            });

            $('.btnEditUpload').click(function (){
                $('#uploadimageModal').modal('show');
            });

            $('.crop_image').click(function(event){
                image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response){
                    // console.log(response);
                    image_product = response;
                    $('#imageProductView').attr('src', response);
                })
                $('#uploadimageModal').modal('hide');
            });

            $('#quantityImage').html('0');

            getProductAll();

            $('.btnUpload').click(function (){
                $('#imageProduct').click();
            });
            $('.btnReChoose').click(function (){
                $('#imageProduct').click();
            });

            $('.btnThemAnh').click(function (){
                $('#mulImage').click();

            });

            $('#mulImage').change(function(){
                $('#quantityImage').html($('#mulImage').get(0).files.length);
            });


            $('.btnSave').click(function (){

                if ($('.nameProduct').val() === ''){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tên sản phẩm không được bỏ trống',
                    })
                    return;
                }
                if ($('.priceProduct').val() === ''){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Giá sản phẩm không được bỏ trống',
                    })
                    return;
                }
                if (!$('#selectCate').val()){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Hãy chọn danh mục cho sản phẩm',
                    })
                    return;
                }

                if ($('#imageProduct').val() === '' || image_product === ''){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Hãy chọn một ảnh đại diện!',
                    })
                    return;
                }

                $('#formInsert').submit();
            });



            $('#formInsert').submit(function (e){
                e.preventDefault();

                var image = $('#imageProduct')[0].files[0];

                var formData = new FormData(jQuery('#formInsert')[0]);
                formData.append( 'image', image_product );
                formData.append( 'name', $('.nameProduct').val() );
                formData.append( 'price', $('.priceProduct').val() );
                formData.append( 'id_category', $('#selectCate').val() );
                formData.append( 'description', $('.descriptionProduct').val() );

                $.ajax({
                    url: INSERT_PRODUCT,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success:function (result){
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            $('#modalInsert').modal('hide');
                            getProductOfCate($('#selectCate').val());
                            getProductAll();
                            Swal.fire({
                                icon: 'success',
                                title: 'Thao tác thành công',
                                showConfirmButton: false,
                                text: result.message,
                                timer: 1000,
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thao tác thất bại',
                                text: result.message,
                                timer: 1000,
                            })
                        }
                    }
                });


            });


            $('.btnInsert').click(function () {
                $('.nameProduct').val('');
                $('.descriptionProduct').val('');
                $('#selectCate').val(-1);
                $('.priceProduct').val('');
                $('#imageProduct').val('');
                $('#mulImage').val('');
                $('#quantityImage').html('0');
                $('#imageProductView').attr('src', '{{ asset('images/products/Unknow.jpg') }}');
                image_product = '';
                $('.btnEditUpload').hide();

                $('#modalInsert').modal('show');
            });


            $('.btnClose').click(function (){
                $('#modalInsert').modal('hide');
            });

            $('.btnCloseUpload').click(function (){
                $('#uploadimageModal').modal('hide');
            });


            $(document).on('keyup','.search_product',function (){

                var value = $(this).val();
                clearTimeout(timeout);

                timeout = setTimeout(function ()
                {

                    if (value === '') getProductAll();
                    else {
                        $.ajax({
                            url: GET_PRODUCT_FILTER_ALL,
                            type: "GET",
                            data: {
                                'name': value,
                            },
                            success: function (result) {
                                $('#search_all').html('');
                                $('#search_all').html(result);
                            }
                        });
                    }
                }, 500);



            });

            $(document).on('keyup','.search_product_cate',function (){

                var value = $(this).val();
                var id = $(this).attr('data');

                clearTimeout(timeout);

                timeout = setTimeout(function ()
                {

                    if (value === '') getProductOfCarePage(id);
                    else {
                        $.ajax({
                            url: GET_PRODUCT_FILTER_CATE,
                            type: "GET",
                            data: {
                                'id' : id,
                                'name': value,
                            },
                            success: function (result) {
                                $('#search_cate_'+id).html('');
                                $('#search_cate_'+id).html(result);
                            }
                        });
                    }
                }, 500);


            });


            $(document).on('click','.btnDeleteProduct',function (){
                var id = $(this).attr('data');
                var id_cate = $(this).attr('id_cate')
                Swal.fire({
                    title: 'Bạn có chắc chắn xóa?',
                    text: "Dữ liệu sau khi xóa sẽ không thể khôi phục",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Chắc chắn xóa',
                    cancelButtonText: 'Hủy',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: DELETE_PRODUCT,
                            type: "DELETE",
                            data: {
                                'id' : id,
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thao tác thành công',
                                        showConfirmButton: false,
                                        text: result.message,
                                        timer: 1000,
                                    })
                                    getProductAll();
                                    getProductOfCate(id_cate)
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Thao tác thất bại',
                                        text: result.message,
                                        timer: 1000,
                                    })
                                }
                            }
                        });
                    }
                })

            })



        });
    </script>
@endsection
