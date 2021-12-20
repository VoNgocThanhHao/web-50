@extends('master-admin')
@section('title') Chi tiết sản phẩm @endsection
@section('style')

    <style>
        /*.imageBox .btnUpdateImage {*/
        /*    position: absolute;*/
        /*    top: 1%;*/
        /*    left: 1%;*/
        /*    padding: 5px 10px;*/
        /*    color: white;*/
        /*}*/
        /*.imageBox .btnDeleteImage {*/
        /*    position: absolute;*/
        /*    top: 1%;*/
        /*    right: 2%;*/
        /*    padding: 5px 10px;*/
        /*    color: white;*/
        /*}*/
    </style>

@endsection
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 id="title_product">Thông tin {{ $product['name'] }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <section class="content ">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body ">

                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none" >{{ $product['name'] }}</h3>
                        <div class="col-12 imageBox">
                            <img src="{{ asset($product['image']) }}" class="product-image imageMain" alt="Product Image">
                            <button type="button" class="btn btn-outline-secondary btn-xs btnUpdateImage">
                                <i class="fas fa-pencil-alt mr-1"></i>Cập nhật ảnh
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-xs btnDeleteImage" >
                                <i class="fas fa-trash mr-1"></i>Xóa ảnh
                            </button>
                        </div>
                        <div class="col-12 product-image-thumbs" id="list_image_sub_box">
                            <div class="product-image-thumb active" _type="product_image" data="{{ $product['id'] }}"><img src="{{ asset($product['image']) }}" class="imageProduct" alt="Product Image"></div>
                            <input type="file" id="updateImage" hidden>
                            @foreach($product->images as $image)
                            <div class="product-image-thumb" _type="sub_image" data="{{ $image['id'] }}"><img src="{{ asset($image['path']) }}" class="imageSub_{{$image['id']}}" alt="Product Image"></div>
                            @endforeach
                            <button type="button" class="btn btn-primary btnAddImage" style="width: 60px">
                                <i class="fas fa-plus"></i>
                            </button>

                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="row">
                        <h3 class="nameProduct"><b>{{ $product['name'] }}</b></h3>
                            <input type="text" class="form-control col-md-4 editName " value="{{ $product['name'] }}">
                            <button type="button" class="btn btn-outline-secondary btn-xs ml-3 btnEdit" style="height: 25px;width: 25px" >
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </div>

                        <hr>
                        <div class="row">
                            <h4 class="col-md-5">Danh mục</h4>
                            <h4 class="col-md-4">Giá tiền</h4>
                            <h4 class="col-md-3">Giảm giá</h4>
                        </div>
                        <div class="row">
                            <select class="col-md-5 form-control" id="selectCate">
                                @foreach($data as $item )
                                    <optgroup label="{{ $item['name'] }}">
                                        @foreach($item['category'] as $index)
                                            <option value="{{ $index['id'] }}" @if($index['id'] == $product['id_category']) selected @endif>{{ $index['name'] }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            <div class="col-md-4">
                                <input class=" form-control priceProduct" type="text" value="{{ $product['price'] }}">
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="number" class="form-control discount"
                                           value="{{$product['discount']}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <h4 class="ml-2">Mô tả:</h4>

                                    <div class="">
                                        <button type="button" class=" btn btn-outline-secondary btn-xs ml-3 btnEditDes" style="height: 25px;width: 25px" >
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="col-md-12 descriptionProduct">{{ $product['description'] }}</p>

                                    <textarea class="form-control  col-md-12 editDescription" rows="2"
                                              placeholder="Mô tả">{{ $product['description'] }}</textarea>
                                </div>
                            </div>

{{--                            <div class="col-md-8 mt-4 row">--}}
{{--                                <div class="col-md-9 text-center">--}}
{{--                                    <div>--}}
{{--                                        <label class="text-center">--}}
{{--                                            <i class="fas fa-star fa-2x text-yellow"></i>--}}
{{--                                        </label>--}}
{{--                                        <label class="text-center">--}}
{{--                                            <i class="fas fa-star fa-2x text-yellow"></i>--}}
{{--                                        </label>--}}
{{--                                        <label class="text-center">--}}
{{--                                            <i class="fas fa-star fa-2x text-yellow"></i>--}}
{{--                                        </label>--}}
{{--                                        <label class="text-center">--}}
{{--                                            <i class="fas fa-star fa-2x text-yellow"></i>--}}
{{--                                        </label>--}}
{{--                                        <label class="text-center">--}}
{{--                                            <i class="fas fa-star-half-alt fa-2x text-yellow"></i>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}

{{--                                    <span>(1.000 lượt đánh giá)</span>--}}
{{--                                </div>--}}

{{--                            </div>--}}
                            <div class="col-md-4 mt-4">
                                <div class="btn btn-primary btn-lg btn-flat btnSave">
                                    <i class="far fa-save fa-lg mr-2"></i>
                                    Lưu thay đổi
                                </div>
                            </div>

                        </div>


                        <div class="py-2 px-3 mt-4">
                            <div class="row">

{{--                                <div class="col-md-12 text-center">--}}
{{--                                    <canvas id="myChart"></canvas>--}}
{{--                                    <label class="mt-1" for="">Thống kê số lượng bán trong 1 tháng</label>--}}
{{--                                </div>--}}


                            </div>



                        </div>

                    </div>
                </div>
                <div class="row mt-4">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">

                        <div class="tab-pane fade active show" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div>

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>





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
                    <button type="button" class="btn btn-outline-primary btnSaveImage"  _type="product_image" data="{{ $product['id'] }}"> Cắt và lưu</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">

        var UPDATE_PRODUCT = '{{ action('App\Http\Controllers\productController@update',$id_product) }}';
        var UPDATE_PRODUCT_IMAGE = '{{ action('App\Http\Controllers\productController@updateImage', $id_product) }}';
        var UPDATE_PRODUCT_IMAGE_SUB = '{{ action('App\Http\Controllers\imagesController@update') }}';
        var INSERT_PRODUCT_IMAGE_SUB = '{{ action('App\Http\Controllers\imagesController@insert', $id_product) }}';
        var DELETE_PRODUCT_IMAGE = '{{ action('App\Http\Controllers\imagesController@delete') }}';
        var GET_LIST_IMAGE = '{{ action('App\Http\Controllers\productController@getListImage', $id_product) }}';

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

        var get_list_image = function (){
            $.ajax({
                url: GET_LIST_IMAGE,
                type: "GET",
                data: {},
                success: function (result) {
                    $('#list_image_sub_box').html('');
                    $('#list_image_sub_box').html(result);
                    $('.imageMain').attr('src','{{asset($product['image'])}}')
                }
            });
        }

        $(document).ready(function (){
            $('.btnDeleteImage').hide();

            $(document).on('click','.product-image-thumb', function (){
            // $('.product-image-thumb').on('click', function () {
                if ($(this).attr('_type') === 'product_image') $('.btnDeleteImage').hide();
                else $('.btnDeleteImage').show();

                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')

                $('.btnDeleteImage').attr('data',$(this).attr('data'));
                $('.btnSaveImage').attr('_type',$(this).attr('_type')).attr('data',$(this).attr('data'))
            });

            $(".discount").keydown(function () {
                // Save old value.
                if (!$(this).val() || (parseInt($(this).val()) <= 100 && parseInt($(this).val()) >= 0))
                    $(this).data("old", $(this).val());
            });
            $(".discount").keyup(function () {
                // Check correct, else revert back to old value.
                if (!$(this).val() || (parseInt($(this).val()) <= 100 && parseInt($(this).val()) >= 0))
                    ;
                else
                    $(this).val($(this).data("old"));
            });

            // const ctx = document.getElementById('myChart').getContext('2d');
            // const myChart = new Chart(ctx, {
            //     type: 'line',
            //     data: {
            //         labels: [
            //             '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021',
            //             '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021',
            //             '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021',
            //             '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021', '6-12-2021',
            //         ],
            //         datasets: [{
            //             label: 'Lượt mua',
            //             data: [
            //                 2, 3, 2, 1, 0, 4, 1,
            //                 2, 3, 2, 1, 0, 4, 1,
            //                 2, 3, 2, 1, 0, 4, 1,
            //                 2, 3, 2, 1, 0, 4, 1,
            //             ],
            //             backgroundColor: [
            //                 'rgba(90, 133, 244, 0.7)',
            //             ],
            //             fill: false,
            //             borderColor: 'rgb(75, 192, 192)',
            //             tension: 0.1
            //         }]
            //     },
            //     options: {
            //         plugins:{
            //             legend:{
            //                 display: false
            //             }
            //         },
            //     }
            // });



            $('.editName').hide();

            $('.btnEdit').click(function (){
                $('.nameProduct').hide();
                $('.editName').show();
                $('.editName').focus();
                $(this).hide();
            });

            $('.editName').focusout(function (){
                $('.nameProduct').html('<b>'+$('.editName').val()+'</b>');

                $('.nameProduct').show();
                $('.editName').hide();
                $('.btnEdit').show();
            });

            $('.editDescription').hide();

            $('.btnEditDes').click(function (){
                $('.descriptionProduct').hide();
                $('.editDescription').show();
                $('.editDescription').focus();
                $(this).hide();
            });

            $('.editDescription').focusout(function (){
                $('.descriptionProduct').html($('.editDescription').val());

                $('.descriptionProduct').show();
                $('.editDescription').hide();
                $('.btnEditDes').show();
            });


            $('.btnSave').click(function (){
                if ($('.editName').val() === ''){
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

                $.ajax({
                    url: UPDATE_PRODUCT,
                    type: "POST",
                    data: {
                        'name': $('.editName').val(),
                        'price': $('.priceProduct').val(),
                        'description': $('.editDescription').val(),
                        'id_category': $('#selectCate').val(),
                        'discount': $('.discount').val(),
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thao tác thành công',
                                text: result.message,
                            })
                            $('#title_product').html($('.editName').val())
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


            // Cập nhật ảnh
            $('.btnUpdateImage').click(function (){
                $('#updateImage').click();
                $('.btnSaveImage').attr('cmt','update')
            })

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

            $(document).on('change','#updateImage',function (){
                let reader = new FileReader();

                reader.onload = (e) => {

                    image_crop.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
                        // console.log('jQuery bind complete');
                    });

                }

                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show')
            })


            var image_update = '';
            $('.btnSaveImage').click(function (){
                if ($('.btnSaveImage').attr('cmt') === 'update') {
                    var type = $(this).attr('_type');
                    var id = $(this).attr('data');

                    image_crop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function(response){
                        image_update = response;
                        $('.imageMain').attr('src', response);
                        $('.imageSub_'+ id).attr('src', response);
                    })

                    Swal.fire({
                        title: 'Cập nhật ảnh?',
                        text: "Ảnh vừa chọn sẽ được thay thế ảnh cũ!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Cập nhật',
                        cancelButtonText: 'Hủy',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var formData = new FormData();
                            formData.append( 'image', image_update );

                            switch (type) {
                                case 'product_image':

                                    $.ajax({
                                        url: UPDATE_PRODUCT_IMAGE,
                                        type: 'POST',
                                        data: formData,
                                        contentType: false,
                                        processData: false,
                                        success:function (result){
                                            result = JSON.parse(result);
                                            if (result.status === 200) {
                                                Toast.fire({
                                                    icon: 'success',
                                                    title: result.message,
                                                })
                                                $('#uploadimageModal').modal('hide');
                                            } else {
                                                Toast.fire({
                                                    icon: 'error',
                                                    title: result.message,
                                                })
                                            }
                                        }
                                    });
                                    break;

                                case 'sub_image':
                                    formData.append( 'id', $('.btnSaveImage').attr('data') );
                                    $.ajax({
                                        url: UPDATE_PRODUCT_IMAGE_SUB,
                                        type: "POST",
                                        data: formData,
                                        contentType: false,
                                        processData: false,
                                        success:function (result){
                                            result = JSON.parse(result);
                                            if (result.status === 200) {
                                                Toast.fire({
                                                    icon: 'success',
                                                    title: result.message,
                                                })
                                                $('#uploadimageModal').modal('hide');
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
                        }
                    })
                }else if ($('.btnSaveImage').attr('cmt') === 'insert'){
                    image_crop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function(response){
                        image_update = response;
                    })

                    Swal.fire({
                        title: 'Thêm ảnh',
                        text: "Ảnh sẽ được thêm vào sản phẩm!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Thêm',
                        cancelButtonText: 'Hủy',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var formData = new FormData();
                            formData.append( 'image', image_update );

                            $.ajax({
                                url: INSERT_PRODUCT_IMAGE_SUB,
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success:function (result){
                                    result = JSON.parse(result);
                                    if (result.status === 200) {
                                        Toast.fire({
                                            icon: 'success',
                                            title: result.message,
                                        })
                                        $('#uploadimageModal').modal('hide');
                                        get_list_image();
                                    } else {
                                        Toast.fire({
                                            icon: 'error',
                                            title: result.message,
                                        })
                                    }
                                }
                            });
                        }
                    })
                }





            })

            $('.btnReChoose').click(function (){
                $('#updateImage').click();
            });

            $('.btnCloseUpload').click(function (){
                $('#uploadimageModal').modal('hide');
            })

            $(document).on('click','.btnAddImage',function (){
            // $('.btnAddImage').click(function (){
                $('#updateImage').click();
                $('.btnSaveImage').attr('cmt','insert')
            })

            $('.btnDeleteImage').click(function (){
                var id = $(this).attr('data');

                Swal.fire({
                    title: 'Xóa ảnh',
                    text: "Ảnh sẽ được xóa vào sản phẩm!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: DELETE_PRODUCT_IMAGE,
                            type: 'DELETE',
                            data: {
                                'id': id,
                            },
                            success:function (result){
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: result.message,
                                    })
                                    get_list_image();
                                } else {
                                    Toast.fire({
                                        icon: 'error',
                                        title: result.message,
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
