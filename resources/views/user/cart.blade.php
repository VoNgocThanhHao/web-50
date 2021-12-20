@extends('user.master-user')
@section('style')

@endsection
@section('content')

    <div class="" style="padding: 70px">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Giỏ hàng</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-outline-success btnTransaction" style="width: 150px">Đặt hàng</button>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-7">
@foreach($list_order as $order)
                        <!-- Default box -->
                        <div class="card" id="boxCart{{ $order['id'] }}">
                            <div class="card-body">


                                <div class="row">

                                    <div class="col-md-2">
                                        <img src="{{ asset($order->product['image']).'?v='.time() }}" alt=""
                                             style=" width: 100%">
                                    </div>
                                    <div class="col-md-5">
                                        <h3><strong>{{ $order->product['name'] }}</strong></h3>
                                        <p>Loại: <i>Trà sữa</i></p>
                                        <span>{{ $order->product['description'] }}</span>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <h5 class="mt-4" style="color: red;">
                                            @if($order->product['discount'])
                                                {{ number_format($order->product['price']-($order->product['price']*($order->product['discount']/100)), 0 ,"," ,".") }}
{{--                                                {{ ($order->product['price']-($order->product['price']*($order->product['discount']/100)))*$order['quantity'] }}--}}
                                            @else
                                                {{ number_format($order->product['price'], 0 ,"," ,".") }}
                                            @endif

                                            VNĐ</h5>
                                        <button type="button" class="btn btn-outline-danger mt-3 btnDeleteOrder" data="{{$order['id']}}"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="input-group mt-5">
                                            <div class="input-group-prepend btnSub" data="{{ $order['id'] }}" style="cursor: pointer">
                    <span class="input-group-text " >
                      <i class="fas fa-minus"></i>
                    </span>
                                            </div>
                                            <input type="number" class="form-control qtyTransac{{$order['id']}} text-center" value="{{ $order['quantity'] }}" disabled>
                                            <div class="input-group-append btnAdd" style="cursor: pointer" data="{{ $order['id'] }}">
                                                <div class="input-group-text"><i class="fas fa-plus"></i></div>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                            </div>
                        </div>
                        <!-- /.card -->
    @endforeach

                    </div>

                    <div class="col-md-5 row">

                        <!-- Default box -->
                        <div class="card col-md-12">
                            <div class="card-header">
                                <h3 class="card-title"><strong>Thông tin đơn hàng</strong></h3>
                            </div>
                            <div class="card-body">
                                <p>
                                    <span>Tạm tính:</span> <span style="float: right" id="amountTran">60.000 VNĐ</span>
                                </p>
                                <span>Phí ship:</span> <span style="float: right" id="shipTran">5.000 VNĐ</span><br>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <strong>Tổng cộng:</strong>
                                <span style="float: right"><strong id="totalTran">70.000 VNĐ</strong></span>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->


                        <!-- Default box -->
                        <div class="card col-md-12">
                            <div class="card-header">
                                <h3 class="card-title"><strong>Thông tin khách hàng</strong></h3>
                            </div>
                            <div class="card-body">
                                <p class="row">
                                    <span class="col-md-3 mt-1">Tên người nhận:</span>
                                    <input type="text" class="form-control col-md-9 nameTransac"
                                           value="{{ Auth::user()->profile['name'] }}">
                                </p>
                                <p class="row">
                                    <span class="col-md-3 mt-1">Số điện thoại:</span>
                                    <input type="text" class="form-control col-md-9 phoneTransac"
                                           data-inputmask="'mask': ['9999-999-999']" data-mask="" inputmode="text"
                                           value="{{ Auth::user()->profile['phone_number'] }}">
                                </p>

                                <p class="row">
                                    <span class="col-md-3 mt-1">Địa chỉ:</span>
                                    <textarea type="text" class="form-control col-md-9 adTransac"
                                              rows="2">{{ Auth::user()->profile['address'] }}</textarea>
                                </p>
                                <p class="row">
                                    <span class="col-md-3 mt-1">Ghi chú:</span>
                                    <textarea type="text" class="form-control col-md-9 messTransac" rows="2"></textarea>
                                </p>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
@section('script')
    <script>

        var UPDATE_CART_QUANTITY = '{{ action('App\Http\Controllers\orderController@updateQuantity') }}'
        var DELETE_CART = '{{ action('App\Http\Controllers\orderController@delete') }}'
        var GET_AMOUNT = '{{ action('App\Http\Controllers\orderController@getAmount', Auth::user()['id']) }}'
        var TRANSACTION = '{{ action('App\Http\Controllers\transactionController@insert', Auth::user()['id']) }}'
        var amount = 0;

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


        var update_quantity = function (id, value){
            $.ajax({
                url: UPDATE_CART_QUANTITY,
                type: "POST",
                data: {
                    'id': id,
                    'quantity': value,
                },
                success: function (result) {
                    get_amount()
                    get_cart()
                }
            });
        }

        var get_amount = function (){
            $.ajax({
                url: GET_AMOUNT,
                type: "GET",
                data: {
                },
                success: function (result) {
                    result = parseFloat(result)
                    amount = result
                    $('#amountTran').html('')

                    $('#amountTran').html( (result/1000).toFixed(3) + ' VNĐ')

                    if (result > 70000){
                        $('#shipTran').html('')
                        $('#shipTran').html('0'+ ' VNĐ')
                        $('#totalTran').html('')
                        $('#totalTran').html((result/1000).toFixed(3) + ' VNĐ')
                    }else {
                        $('#shipTran').html('')
                        $('#shipTran').html('7.000'+ ' VNĐ')
                        $('#totalTran').html('')
                        $('#totalTran').html(((result+7000)/1000).toFixed(3) + ' VNĐ')
                        amount += 7000
                    }
                }
            });
        }

        $(document).ready(function () {

            get_amount()

            $('[data-mask]').inputmask();


            $('.btnSub').click(function (){
                var id = $(this).attr('data')
                var value = $('.qtyTransac'+id).val()
                value = parseInt(value)
                value = value-1

                if (value <= 0) value = 1

                $('.qtyTransac'+id).val(value)

                update_quantity(id, value)

            })

            $('.btnAdd').click(function (){
                var id = $(this).attr('data')
                var value = $('.qtyTransac'+id).val()
                value = parseInt(value)
                value = value+1

                $('.qtyTransac'+id).val(value)

                update_quantity(id, value)
            })

            $('.btnDeleteOrder').click(function (){
                var id = $(this).attr('data')

                Swal.fire({
                    title: 'Xóa ra khỏi giỏ hàng?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa!',
                    cancelButtonText: 'Hủy',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: DELETE_CART,
                            type: "DELETE",
                            data: {
                                'id': id,
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: result.message,
                                    })
                                    $('#boxCart'+id).hide()
                                    get_amount()
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        text: result.message,
                                    })
                                }
                            }
                        });
                    }
                })
            })


            $('.btnTransaction').click(function (){

                @if(Auth::user()['email_verified_at'])
                if ($('.phoneTransac').val().length !== 12)
                {
                    Swal.fire({
                        icon: 'error',
                        text: 'Số điện thoại không hợp lệ',
                    })
                    return;
                }



                Swal.fire({
                    title: 'Đặt hàng?',
                    text: "Yêu cầu đặt hàng sẽ được gửi đến Brownie!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đặt hàng',
                    cancelButtonText: 'Hủy',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: TRANSACTION,
                            type: "POST",
                            data: {
                                'comment': $('.messTransac').val(),
                                'name': $('.nameTransac').val(),
                                'phone_number' : $('.phoneTransac').val(),
                                'address': $('.adTransac').val(),
                                'amount': amount,
                            },
                            success: function (result) {
                                if (result) {
                                    Swal.fire({
                                        title: 'Đã nhận được yêu cầu!',
                                        text: "Brownie sẽ sớm liên lạc với bạn để xác nhận đơn hàng!",
                                        icon: 'success',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        window.location.href='{{ route('home') }}'
                                    })

                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'Đặt hàng không thành công',
                                    })
                                }
                            }
                        });

                    }
                })
                @else

                Swal.fire({
                    icon: 'warning',
                    text: 'Tài khoản của bạn chưa được kích hoạt!',
                })

                @endif
            })

        })
    </script>
@endsection
