@extends('user.master-user')
@section('style')
    <style>

        section {
            padding: 100px 200px;
        }

        .home {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            flex-direction: column;
            background: #2696E9;
        }

        .home:before {
            z-index: 777;
            content: '';
            position: absolute;
            background: rgba(3, 96, 251, 0.3);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .home .video__content {
            z-index: 888;
            color: #fff;
            width: 70%;
            margin-top: 50px;
            display: none;
        }

        .home .video__content.active {
            display: block;
        }

        .home .video__content h1 {
            font-size: 4em;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 5px;
            line-height: 75px;
            margin-bottom: 40px;
        }

        .home .video__content h1 span {
            font-size: 1.2em;
            font-weight: 600;
        }

        .home .video__content p {
            margin-bottom: 65px;
        }

        .home .video__content a {
            background: #fff;
            padding: 15px 35px;
            color: #1680AC;
            font-size: 1.1em;
            font-weight: 500;
            text-decoration: none;
            border-radius: 2px;
        }

        .home .media-icons {
            z-index: 888;
            position: absolute;
            right: 30px;
            display: flex;
            flex-direction: column;
            transition: 0.5s ease;
        }

        .home .media-icons a {
            color: #fff;
            font-size: 1.6em;
            transition: 0.3s ease;
        }

        .home .media-icons a:not(:last-child) {
            margin-bottom: 20px;
        }

        .home .media-icons a:hover {
            transform: scale(1.3);
        }

        .home video {
            z-index: 000;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        .slider-navigation {
            z-index: 888;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: translateY(80px);
            margin-bottom: 12px;
        }

        .slider-navigation .nav-btn {
            width: 12px;
            height: 12px;
            background: #fff;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 0 2px rgba(255, 255, 255, 0.5);
            transition: 0.3s ease;
        }

        .slider-navigation .nav-btn.active {
            background: #2696E9;
        }

        .slider-navigation .nav-btn:not(:last-child) {
            margin-right: 20px;
        }

        .slider-navigation .nav-btn:hover {
            transform: scale(1.2);
        }

        .video-slide {
            position: absolute;
            width: 100%;
            clip-path: circle(0% at 0 50%);
        }

        .video-slide.active {
            clip-path: circle(150% at 0 50%);
            transition: 2s ease;
            transition-property: clip-path;
        }

        @media (max-width: 1308px) {
            header {
                padding: 12px 200px;
            }

            section {
                padding: 100px 20px;
            }

            .home .media-icons {
                right: 15px;
            }

            header .navigation {
                display: none;
            }

            header .navigation.active {
                position: fixed;
                width: 100%;
                height: 100vh;
                top: 0;
                left: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                background: rgba(1, 1, 1, 0.5);
            }

            header .navigation .navigation-items a {
                color: #fff;
                font-size: 1.2em;
                margin: 20px;
            }

            header .navigation .navigation-items a:before {
                background: #222;
                height: 5px;
            }

            header .navigation.active .navigation-items {
                background: rgba(0, 0, 0, 0.5);
                width: 600px;
                max-width: 600px;
                margin: 20px;
                padding: 40px;
                display: flex;
                flex-direction: column;
                align-items: center;
                border-radius: 5px;
                box-shadow: 0 5px 25px rgb(1 1 1);
            }

        }

        @media (max-width: 560px) {
            .home .video__content h1 {
                font-size: 3em;
                line-height: 60px;
            }

            header .brand {
                display: none;
            }

        }

        @media (max-width: 560px) {
            .home .video__content h1 {
                font-size: 3em;
                line-height: 60px;
            }

            header .brand {
                display: none;
            }

            .menu-btn {
                position: fixed;
                right: 1%;
            }

        }


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


        /*Dich vu*/

        .services__section {
            background: url({{ asset('images/assets/bg.jpg') }});
            background-size: cover;
            padding: 60px 0;
        }

        .inner__width {
            width: 100%;
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
            overflow: hidden;
        }

        .section__title {
            text-align: center;
            color: #ddd;
            text-transform: uppercase;
            font-size: 30px;
        }

        .service__border {
            width: 160px;
            height: 2px;
            background: #82ccdd;
            margin: 40px auto;
        }

        .services__container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .service__box {
            max-width: 33.33%;
            padding: 10px;
            text-align: center;
            color: #ddd;
            cursor: pointer;
        }

        .service__icon {
            display: inline-block;
            width: 70px;
            height: 70px;
            border: 3px solid #82ccdd;
            color: #82ccdd;
            transform: rotate(45deg);
            margin-bottom: 30px;
            margin-top: 16px;
            transition: 0.3s linear;
        }

        .service__icon i, .service__icon svg {
            line-height: 70px;
            transform: rotate(-45deg);
            font-size: 40px;
            margin-top: 12px;
        }

        .service__box:hover .service__icon {
            background: #82ccdd;
            color: #ddd;
        }

        .service__title {
            font-size: 18px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .service__desc {
            font-size: 14px;
        }

        @media screen and (max-width: 960px) {
            .service__box {
                max-width: 45%;
            }
        }

        @media screen and (max-width: 768px) {
            .service__box {
                max-width: 50%;
            }
        }

        @media screen and (max-width: 480px) {
            .service__box {
                max-width: 100%;
            }
        }


    </style>
@endsection
@section('content')
    <section class="home">
        <video class="video-slide active" src="{{ asset("videos/2.mp4")}}" autoplay muted loop></video>
        <video class="video-slide" src="{{ asset("videos/3.mp4")}}" autoplay muted loop></video>
        <video class="video-slide" src="{{ asset("videos/1.mp4")}}" autoplay muted loop></video>
        <video class="video-slide" src="{{ asset("videos/4.mp4")}}" autoplay muted loop></video>
        <video class="video-slide" src="{{asset("videos/5.mp4")}}" autoplay muted loop></video>
        <div class="video__content active">
            <h3><span>Chào mừng đến với</span></h3>
            <h1>Brownie<br><span>Coffee & Dessert</span></h1>
            <a href="#">Xem thêm</a>
        </div>
        <div class="video__content">
            <h3><span>Chào mừng đến với</span></h3>
            <h1>Brownie<br><span>Coffee & Dessert</span></h1>
            <a href="#">Xem thêm</a>
        </div>
        <div class="video__content">
            <h3><span>Chào mừng đến với</span></h3>
            <h1>Brownie<br><span>Coffee & Dessert</span></h1>
            <a href="#">Xem thêm</a>
        </div>
        <div class="video__content">
            <h3><span>Chào mừng đến với</span></h3>
            <h1>Brownie<br><span>Coffee & Dessert</span></h1>
            <a href="#">Xem thêm</a>
        </div>
        <div class="video__content">
            <h3><span>Chào mừng đến với</span></h3>
            <h1>Brownie<br><span>Coffee & Dessert</span></h1>
            <a href="#">Xem thêm</a>
        </div>
        <div class="media-icons">
            <a href="https://www.facebook.com/Browniecafe111"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/browniecoffee111/"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
        <div class="slider-navigation">
            <div class="nav-btn active"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
        </div>
    </section>

    <hr>

    <h1 class="text-center mt-2 mb-2"><strong> ĐANG GIẢM GIÁ</strong></h1>
    <div class="container">
        <div class="row">
            @foreach($list_discount as $product)
                <div class="col-md-3 mb-5">
                    <div class="my__card">
                        <div class="card__head">
                            <a href="{{ action('App\Http\Controllers\pageController@getViewProduct', $product['id']) }}">
                            <div class="card__product-img btnProductDetails">
                                <img src="{{ asset($product['image']).'?v='.time() }}" alt="">
                            </div>
                            </a>
                        </div>
                        <div class="card__body">
                            <a href="{{ action('App\Http\Controllers\pageController@getViewProduct', $product['id']) }}">
                                <h3 class="card__title">{{ ($product['name']) }}</h3>
                            </a>
                            <p class="card__text">{{ ($product['description']) }}</p>
                            <div class="wrapper">
                                <div class="card__price">
                                    <img src="{{ asset("images/assets/icon-ethereum.svg")}}" alt="" class="card__icon">
                                    <span>{{ number_format($product['price'], 0 ,"," ,".") }} VNĐ</span>
                                </div>
                            </div>
                        </div>
                        <div class="card__footer">
                            <a style="cursor: pointer" class="btn btn-outline-primary btnAddCart" data="{{ $product['id'] }}">
                                <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>Thêm vào giỏ hàng
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <a class=" text-center" href="{{ action('App\Http\Controllers\pageController@getViewMenuProduct') }}" style="color: brown;">
        <h2 class="mt-5 mb-5">Xem thêm <i class="fas fa-angle-double-right" style="margin-left: 5px;"></i></h2>
    </a>



    <hr>
    <h1 class="text-center mt-2 mb-2"><strong> ĐỀ XUẤT CHO BẠN</strong></h1>
    <div class="container">
        <div class="row">
            @foreach($list_offer as $product)
                <div class="col-md-3 mb-5">
                    <div class="my__card">
                        <div class="card__head">
                            <a href="{{ action('App\Http\Controllers\pageController@getViewProduct', $product['id']) }}">
                                <div class="card__product-img btnProductDetails">
                                    <img src="{{ asset($product['image']).'?v='.time() }}" alt="">
                                </div>
                            </a>
                        </div>
                        <div class="card__body">
                            <a href="{{ action('App\Http\Controllers\pageController@getViewProduct', $product['id']) }}">
                                <h3 class="card__title">{{ ($product['name']) }}</h3>
                            </a>
                            <p class="card__text">{{ ($product['description']) }}</p>
                            <div class="wrapper">
                                <div class="card__price">
                                    <img src="{{ asset("images/assets/icon-ethereum.svg")}}" alt="" class="card__icon">
                                    <span>{{ number_format($product['price'], 0 ,"," ,".") }} VNĐ</span>
                                </div>
                            </div>
                        </div>
                        <div class="card__footer">
                            <a style="cursor: pointer" class="btn btn-outline-primary btnAddCart" data="{{ $product['id'] }}">
                                <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i>Thêm vào giỏ hàng
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <a class=" text-center" href="{{ action('App\Http\Controllers\pageController@getViewMenuProduct') }}" style="color: brown;">
        <h2 class="mt-5 mb-5">Xem thêm <i class="fas fa-angle-double-right" style="margin-left: 5px;"></i></h2>
    </a>



{{--    <hr>--}}
{{--    <h1 class="text-center mt-2 "><strong> SỰ KIỆN</strong></h1>--}}
{{--    <div class="container mb-5">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="my__card">--}}
{{--                    <div class="card__head">--}}
{{--                        <div class="card__product-img">--}}
{{--                            <img src="{{ asset($product['image']).'?v='.time() }}" alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card__body">--}}
{{--                        <a href="#">--}}
{{--                            <h3 class="card__title">Equilibrium #3429</h3>--}}
{{--                        </a>--}}
{{--                        <p class="card__text">Our Equilibrium collection promotes balance and calm.</p>--}}
{{--                        <div class="wrapper">--}}
{{--                            <div class="card__price">--}}
{{--                                <img src="{{ asset("images/assets/icon-clock.svg")}}" alt="" class="card__icon">--}}
{{--                                <span>23/02/2021</span>--}}
{{--                            </div>--}}
{{--                            <div class="card__countdown">--}}
{{--                                <span><i class="fas fa-comments" style="margin-right: 5px;"></i> 100 nhận xét</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card__footer">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}




    <hr>
    <!-- Dịch vụ -->
    <div class="services__section">
        <div class="inner__width">
            <h1 class="section__title">BROWNIE</h1>
            <div class="service__border"></div>
            <div class="services__container">

                <div class="service__box">
                    <div class="service__icon ">
                        <i class="fas fa-bus"></i>
                    </div>
                    <div class="service__title">FREE SHIP</div>
                    <div class="service__desc">
                        Miễn phí vận chuyển từ 2 món trở lên trong nội địa Thành phố Vĩnh Long.
                    </div>
                </div>

                <div class="service__box">
                    <div class="service__icon">
                        <i class="fas fa-concierge-bell"></i>
                    </div>
                    <div class="service__title">NHIỆT TÌNH</div>
                    <div class="service__desc">
                        Đội ngũ nhân viên phục vụ nhiệt tình, hòa đồng, khâu pha chế chuyên nghiệp, không bắt quý khách
                        phải đợi lâu.
                    </div>
                </div>

                <div class="service__box">
                    <div class="service__icon">
                        <i class="fas fa-image"></i>
                    </div>
                    <div class="service__title">KHÔNG GIAN</div>
                    <div class="service__desc">
                        Không gian rộng rải, thoáng mát, nhiều khung ảnh đẹp có nhiều lựa chọn cho bạn checkin với bạn
                        bè.
                    </div>
                </div>

                <div class="service__box">
                    <div class="service__icon">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <div class="service__title">NƯỚC UỐNG</div>
                    <div class="service__desc">
                        Thực đơn đa dạng với nhiều loại nước uống khác nhau đủ để hài lòng các vị khách.
                    </div>
                </div>

                <div class="service__box">
                    <div class="service__icon">
                        <i class="fas fa-birthday-cake"></i>
                    </div>
                    <div class="service__title">BÁNH NGỌT</div>
                    <div class="service__desc">
                        Nhiều loại bánh ngọt đa dạng với nhiều hương vị khác nhau phù hợp với khẩu vị của mỗi người.
                    </div>
                </div>

                <div class="service__box">
                    <div class="service__icon">
                        <i class="fas fa-hamburger"></i>
                    </div>
                    <div class="service__title">ĐIỂM TÂM</div>
                    <div class="service__desc">
                        Brownie phục vụ các loại điểm tâm có cả kiểu Âu và truyền thống, tùy vào sở thích của từng
                        người.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End dịch vụ -->





    {{--    Contact us--}}

    <hr style="margin-top: 80px">
    <h1 class="text-center mt-4 mb-3"><strong> LIÊN HỆ VỚI CHÚNG TÔI</strong></h1>

    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3926.174903549089!2d105.97363931458408!3d10.247473692681764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310a9dd29d19c76f%3A0xf936d6699d558ba1!2sBrownie%20coffee!5e0!3m2!1svi!2s!4v1639877438342!5m2!1svi!2s"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body row">
                <div class="col-5 text-center d-flex align-items-center justify-content-center">
                    <div class="">
                        <h2><strong>BROWNIE</strong><br> COFFEE & DESSERT</h2>
                        <p class="lead mb-5">88 Phạm Thái Bường Phường 4, Vĩnh Long, Việt Nam<br>
                            + 0849 211 557
                        </p>
                        <p class="mt-3" style="font-size: 20px">
                            Đóng góp ý kiến của bạn để chúng tôi hoàn thiện hơn.
                        </p>
                    </div>
                </div>
                <div class="col-7">
                    <div class="form-group">
                        <label for="inputName">Tên</label>
                        <input type="text" id="inputName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">E-Mail</label>
                        <input type="email" id="inputEmail" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputSubject">Tiêu đề</label>
                        <input type="text" id="inputSubject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Nội dung</label>
                        <textarea id="inputMessage" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btnSend"> Gửi</button>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('script')
    <script>

        var SEND_CONTACT = '{{ action('App\Http\Controllers\contactController@insert') }}'
        var ADD_CART = '{{ action('App\Http\Controllers\orderController@insert') }}'

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
        // review
        function initParadoxWay() {
            "use strict";

            if ($(".testimonials-carousel").length > 0) {
                var j2 = new Swiper(".testimonials-carousel .swiper-container", {
                    preloadImages: false,
                    slidesPerView: 1,
                    spaceBetween: 20,
                    loop: true,
                    grabCursor: true,
                    mousewheel: false,
                    centeredSlides: true,
                    pagination: {
                        el: '.tc-pagination',
                        clickable: true,
                        dynamicBullets: true,
                    },
                    navigation: {
                        nextEl: '.listing-carousel-button-next',
                        prevEl: '.listing-carousel-button-prev',
                    },
                    breakpoints: {
                        1024: {
                            slidesPerView: 3,
                        },

                    }
                });
            }

        }


        $(document).ready(function () {


            //Javacript for video slider navigation
            const btns = document.querySelectorAll(".nav-btn");
            const slides = document.querySelectorAll(".video-slide");
            const contents = document.querySelectorAll(".video__content");

            var sliderNav = function (manual) {
                btns.forEach((btn) => {
                    btn.classList.remove("active");
                });

                slides.forEach((slide) => {
                    slide.classList.remove("active");
                });

                contents.forEach((content) => {
                    content.classList.remove("active");
                });

                btns[manual].classList.add("active");
                slides[manual].classList.add("active");
                contents[manual].classList.add("active");
            }

            btns.forEach((btn, i) => {
                btn.addEventListener("click", () => {
                    sliderNav(i);
                });
            });


            $('.btnSend').click(function () {
                $.ajax({
                    url: SEND_CONTACT,
                    type: 'PUT',
                    data: {
                        'name': $('#inputName').val(),
                        'email': $('#inputEmail').val(),
                        'title': $('#inputSubject').val(),
                        'content': $('#inputMessage').val(),
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            $('#inputName').val(''),
                                $('#inputEmail').val(''),
                                $('#inputSubject').val(''),
                                $('#inputMessage').val(''),
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Góp ý của bạn đã được Brownie tiếp nhận!',
                                    text: result.message,
                                })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: result.message,
                            })
                        }
                    }
                });
            })

            $('.btnAddCart').click(function (){
                @if(Auth::user())

                var id = $(this).attr('data')
                $.ajax({
                    url: ADD_CART,
                    type: "POST",
                    data: {
                        'id_product': id,
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





        })
    </script>
@endsection
