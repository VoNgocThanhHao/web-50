@extends('user.master-user')
@section('title') Chi tiết sản phẩm @endsection
@section('style')

    <style>

    </style>

@endsection
@section('content')
    <div class="" style="padding: 70px">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $product['name'] }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <section class="content ">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body " style="padding: 20px 70px 0px 70px">

                <div class="row">
                    <div class="col-12 col-sm-5">
                        <h3 class="d-inline-block d-sm-none">{{ $product['name'] }}</h3>
                        <div class="col-10 imageBox text-center">
                            <img src="{{ asset($product['image']).'?v='.time() }}" class="product-image imageMain" alt="Product Image" style="width: 100%; height: auto; ">
                        </div>
                        <div class="col-10 product-image-thumbs" id="list_image_sub_box">
                            <div class="product-image-thumb active" _type="product_image" data="{{ $product['id'] }}"><img src="{{ asset($product['image']).'?v='.time() }}" class="imageProduct" alt="Product Image"></div>
                            @foreach($product->images as $image)
                                <div class="product-image-thumb" _type="sub_image" data="{{ $image['id'] }}"><img src="{{ asset($image['path']).'?v='.time() }}" class="imageSub_{{$image['id']}}" alt="Product Image"></div>
                            @endforeach

                        </div>
                    </div>
                    <div class="col-12 col-sm-7">
                        <h3 class="my-3">{{ $product['name'] }}</h3>
                        <p>{{ $product['description'] }}</p>

                        <hr>


                        <div class="bg-gray py-2 px-3 mt-4">
                            @if(  $product['discount'] )
                            <h2 class="mb-0">
                                {{ number_format($product['price'] - ($product['price']*($product['discount']/100)), 0 ,"," ,".") }} VNĐ
                            </h2>
                            <h4 class="mt-0">
                                <small>Giá cũ: <del> {{ number_format($product['price'], 0 ,"," ,".") }} VNĐ </del> </small>
                            </h4>
                            @else
                                <h2 class="mb-0">
                                    {{ number_format($product['price'], 0 ,"," ,".") }} VNĐ
                                </h2>
                            @endif
                        </div>

                        <div class="mt-4">
                            <div class="row mb-3">
                            <div class="input-group col-md-3" >
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Số lượng</span>
                                </div>
                                <input type="number" class="form-control quantityProduct">
                            </div>
                            </div>

                            <div class="btn btn-primary btn-lg btn-flat btnAddCart">
                                <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                Thêm vào giỏ hàng
                            </div>


                        </div>




                    </div>
                </div>


                <div class="card direct-chat direct-chat-primary mt-5">
                    <div class="card-header ui-sortable-handle">
                        <h3 class="card-title mb-4">Nhận xét</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: block;">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages"  style="height: auto" id="boxComment">

                            @foreach($list_comment as $comment)

                                @if($comment->user['id'] != Auth::user()['id'])
                            <!-- Message. Default to the left -->
                                <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">{{ $comment->user->profile['name'] }}</span>
                                    <span class="direct-chat-timestamp float-right">{{ $comment['created_at']->diffForHumans($now) }}</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="{{ asset($comment->user->profile['image']).'?v='.time() }}" alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    {{ $comment['message'] }}
                                </div>
                                <!-- /.direct-chat-text -->

                                </div>
                                @else
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left">{{ $comment->user->profile['name'] }}</span>
                                        <span class="direct-chat-timestamp float-right">{{ $comment['created_at']->diffForHumans($now) }}</span>
                                    </div>
                                    <!-- /.direct-chat-infos -->
                                    <img class="direct-chat-img" src="{{ asset($comment->user->profile['image']).'?v='.time() }}" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text bg-primary">
                                        {{ $comment['message'] }}
                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div>
                                <!-- /.direct-chat-msg -->
                                @endif


                            <hr>
                            @endforeach




                        </div>
                    </div>

                    <!-- /.card-body -->
{{--                    <div class="card-footer" style="display: block;">--}}

{{--                    </div>--}}
                    <!-- /.card-footer-->
                </div>





            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>



@endsection
@section('script')
    <script type="text/javascript">

        var SEND_COMMENT = '{{ action('App\Http\Controllers\commentController@insert', $id_product) }}'
        var ADD_CART = '{{ action('App\Http\Controllers\orderController@insert') }}'
        var GET_COMMENT = '{{ action('App\Http\Controllers\pageController@getBoxComment', $id_product) }}'

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

        var get_comment = function (){
            $.ajax({
                url: GET_COMMENT,
                type: "GET",
                data: {
                },
                success: function (result) {
                    $('#boxComment').html('')
                    $('#boxComment').html(result)
                }
            });
        }

        $(document).ready(function (){

            $(document).on('click','.product-image-thumb', function (){

                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')

            });


            $(document).on('click','.btnSend', function (){

                @if(Auth::user())

                $.ajax({
                    url: SEND_COMMENT,
                    type: "POST",
                    data: {
                        'id_user' : {{ Auth::user()['id'] }},
                        'message': $('.messageComment').val()
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            Toast.fire({
                                icon: 'success',
                                title: result.message,
                            })
                            $('.messageComment').val('')
                            get_comment()
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: result.message,
                            })
                        }

                    }
                });


                @else

                $('#modalLogin').modal('show');

                @endif

            })

            $('.btnAddCart').click(function (){
                if ($('.quantityProduct').val() <= 0 || $('.quantityProduct').val()=="")
                {
                    Toast.fire({
                        icon: 'error',
                        title: 'Số lượng không hợp lệ!',
                    })
                    return;
                }

                @if(Auth::user())

                $.ajax({
                    url: ADD_CART,
                    type: "POST",
                    data: {
                        'quantity' : $('.quantityProduct').val(),
                        'id_product': {{ $id_product }},
                        'id_user' : {{ Auth::user()['id'] }},
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            Toast.fire({
                                icon: 'success',
                                title: result.message,
                            })
                            get_cart()
                            $('.quantityProduct').val('')
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: result.message,
                            })
                        }

                    }
                });


                @else

                $('#modalLogin').modal('show');

                @endif
            })

        });

    </script>
@endsection
