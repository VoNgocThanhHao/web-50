@extends('user.master-user')
@section('style')

    <style>
        /*-----------------------------------*\
          #style.css
        \*-----------------------------------*/

        /**
         * copywrite 2021 codewithsadee
         */

        /*-----------------------------------*\
          #VARIABLES
        \*-----------------------------------*/

        :root {
            --oxford-blue: hsl(217, 54%, 11%);
            /* --light-oxford-blue: hsl(216, 50%, 16%); */
            --light-oxford-blue: hsl(0, 0%, 100%);
            --indigo-dye: hsl(215, 32%, 27%);
            --blue-yonder: hsl(216, 30%, 55%);
            /* --aqua:              hsl(178, 100%, 50%); */
            --aqua: hsl(180, 4%, 10%);
            /* --white:             hsl(0, 0%, 100%); */
            --white: hsl(0, 0%, 0%);
        }


        /*-----------------------------------*\
          #CARD
        \*-----------------------------------*/

        .my__card {
            background: var(--light-oxford-blue);
            max-width: 350px;
            padding: 24px;
            border-radius: 15px;
            box-shadow: 0px 20px 25px 15px rgba(0, 0, 0, 0.05),
            0px 40px 30px 15px rgba(0, 0, 0, 0.1);
        }

        .card__product-img {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
        }

        .card__product-img::after {
            --aqua: hsla(178, 100%, 50%, 0.5);

            content: url({{ asset("images/assets/icon-view.svg")}});
            background: var(--aqua);
            position: absolute;
            inset: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: all 0.25s ease;
        }

        .card__product-img:hover::after {
            opacity: 1;
        }

        .card__product-img img {
            width: 100%;
            display: block;
        }


        .card__body {
            padding: 23px 0;
            border-bottom: 1px solid var(--indigo-dye);
            margin-bottom: 15px;
        }

        .card__title {
            color: var(--white);
            font-size: 22px;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .card__title:hover {
            color: var(--aqua);
        }

        .card__text {
            color: var(--blue-yonder);
            font-size: 18px;
            line-height: 1.5;
            margin-bottom: 23px;
        }

        .card__body .wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card__price,
        .card__countdown {
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .card__price {
            color: var(--aqua);
        }

        .card__icon {
            margin-right: 6px;
        }

        .card__countdown {
            color: var(--blue-yonder);
        }


        .card__footer {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .card__author-img {
            width: 34px;
            height: 34px;
            border: 2px solid var(--white);
            border-radius: 50px;
            margin-right: 15px;
        }

        .card__author-name {
            color: var(--blue-yonder);
            font-weight: 500;
        }

        .card__author-name a {
            color: var(--white);
            font-weight: 400;
        }

        .card__author-name a:hover {
            color: var(--aqua);
        }

        .my__container {
            padding: 0 150px;
        }

        hr {
            border: 1.5px solid black;
        }


    </style>
@endsection
@section('content')
    <div class="" style="padding: 70px">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thực đơn</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="row">
                    <div class="card card-solid col-md-2 ">

                        <div class="input-group mb-3 mt-3">
                            <input type="text" class="form-control filterName" placeholder="Tìm kiếm">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>

                        <div class="">
                            <!-- select -->
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select class="form-control text-center" id="filterCate">
                                    <option class="type_cate" data="all" value="0" selected>--Tất cả--</option>
                                    @foreach($cates as $cate )
                                        <option class="type_cate" style="font-weight: bold" data="parent" value="{{ $cate['id'] }}">{{ $cate['name'] }}</option>
                                            @foreach($cate['category'] as $index)
                                                <option class="type_cate" value="{{ $index['id'] }}" data="child">{{ $index['name'] }}</option>
                                            @endforeach
                                    @endforeach
                                </select>
                            </div>


                        </div>

                        <div class="form-group text-center mb-3">
                            <div class="custom-control mt-1 custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="filterDiscount">
                                <label for="filterDiscount" class="custom-control-label">Đang giảm giá</label>
                            </div>
                        </div>

                        <div class="form-group text-center mb-5">
                            <div class="custom-control mt-1 custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="filterNoneDiscount">
                                <label for="filterNoneDiscount" class="custom-control-label">Không giảm giá</label>
                            </div>
                        </div>


                    </div>

    <div class="col-md-1"></div>

                <!-- Default box -->
                <div class="card card-solid col-md-9">
                    <div class="card-body pb-0">
                        <div class="row" id="menuProduct">

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>

        var ADD_CART = '{{ action('App\Http\Controllers\orderController@insert') }}'
        var GET_ALL_MENU = '{{ action('App\Http\Controllers\pageController@getDataMenuAll') }}'
        var GET_FILTER_MENU = '{{ action('App\Http\Controllers\pageController@getDataMenuFilter') }}'

        var type_cate = 'all'

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

        var get_menu_all = function (){
            $.ajax({
                url: GET_ALL_MENU,
                type: "GET",
                data: {
                },
                success: function (result) {
                    $('#menuProduct').html('')
                    $('#menuProduct').html(result)
                }
            });
        }

        var get_filter_all = function (){
            var discount = false;
            var none_discount = false;
            if ($('#filterDiscount').is(':checked')) discount = true;
            if ($('#filterNoneDiscount').is(':checked')) none_discount = true;
            $.ajax({
                url: GET_FILTER_MENU,
                type: "GET",
                data: {
                    'name': $('.filterName').val(),
                    'type_cate': type_cate,
                    'id_cate': $('#filterCate').val(),
                    'discount': discount,
                    'none_discount': none_discount,
                },
                success: function (result) {
                    $('#menuProduct').html('')
                    $('#menuProduct').html(result)
                }
            });
        }


        $(document).ready(function () {



            get_menu_all()

            $(document).on('click','.btnAddCart',function (){
            // $('.btnAddCart').click(function () {
                @if(Auth::user())

                var id = $(this).attr('data')
                $.ajax({
                    url: ADD_CART,
                    type: "POST",
                    data: {
                        'id_product': id,
                        'id_user': {{ Auth::user()['id'] }},
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            Toast.fire({
                                icon: 'success',
                                title: result.message,
                            })
                            get_cart()
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


            $('#filterCate').change(function (){
                type_cate = $(this).find(":selected").attr('data')
                get_filter_all();
            })

            $('#filterDiscount').change(function (){
                get_filter_all();
            })

            $('#filterNoneDiscount').change(function (){
                get_filter_all();
            })

            var timeout=null;
            $('.filterName').keyup(function (){
                clearTimeout(timeout);
                timeout = setTimeout(function ()
                {
                    get_filter_all();
                },500)
            })



        })
    </script>
@endsection
