@extends('user.master-user')
@section('style')
    <link rel="stylesheet" href="{{ asset("User/nicepage/recruitment/nicepage.css")}}" media="screen">
    <link rel="stylesheet" href="{{ asset("User/nicepage/recruitment/Home.css")}}" media="screen">

    <style>
        .u-section-1 .u-image-1 {
            min-height: 601px;
            background-image: url("{{ asset('User/nicepage/images/tuyen-dung2.jpg') }}");
            background-position: 50% 50%;
        }
    </style>
@endsection
@section('content')
    <div class="" style="padding: 70px">
    <section class="u-clearfix u-white u-section-1" id="carousel_45ff">
        <div class="u-clearfix u-sheet u-sheet-1">
            <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
                <div class="u-layout">
                    <div class="u-layout-row">
                        <div
                            class="
                  u-container-style u-layout-cell u-size-36 u-layout-cell-1
                "
                        >
                            <div class="u-container-layout u-container-layout-1">
                                <h4
                                    class="
                      u-align-left u-custom-font u-font-raleway u-text u-text-1
                    "
                                >
                                    Tuyển nhân viên phục vụ
                                </h4>
                                <p class="u-align-justify u-text u-text-2">
                                    Brownie thông báo tuyển dụng nhân viên phục vụ quán cụ thể
                                    như sau:<br />&nbsp;<span style="font-weight: 700"
                                    >Điều kiện:</span
                                    >
                                    <br />&nbsp; &nbsp; - Đã tốt nghiệp 12<br />&nbsp; - Nhanh
                                    nhẹ, chẳm chỉ, có trách nhiệm trong công việc<br />&nbsp;
                                    &nbsp;- Đủ sức khỏe đảm nhận nhiệm vụ<br />
                                    <span style="font-weight: 700">Hình thức đăng ký:</span>
                                    <br />&nbsp; &nbsp;Đến gặp trực tiếp tại quán theo địa chỉ
                                    phía bên (không cần hồ sơ)<br />
                                    <span style="font-weight: 700">Thời gian làm việc</span>
                                    <br />&nbsp; &nbsp; - Sáng:&nbsp; 7h-11h30<br />&nbsp;
                                    &nbsp; - Chiều: 12h30-17h<br />&nbsp; &nbsp; - Tối:&nbsp;
                                    17h-22h&nbsp;&nbsp;<br />
                                    <span style="font-weight: 700">(</span>
                                    <span style="font-weight: 700"
                                    >*) Có hỗ trợ part time cho sinh viên (18k/h)</span
                                    >
                                </p>
                            </div>
                        </div>
                        <div
                            class="
                  u-align-center
                  u-container-style
                  u-layout-cell
                  u-palette-2-light-2
                  u-size-12
                  u-layout-cell-2
                "
                        >
                            <div class="u-container-layout u-container-layout-2">
                                <h6 class="u-text u-text-3">Vị TRÍ</h6>
                                <p class="u-text u-text-4">
                    <span style="font-size: 1.125rem"
                    >Pha chế<br />Tạp vụ
                    </span>
                                    <br />
                                </p>
                                <h6 class="u-text u-text-5">LIÊN HỆ</h6>
                                <p class="u-text u-text-6">
                                    0976585945 (Gặp Hào)<br />08761234445 (Gặp Nhi)
                                </p>
                                <h6 class="u-text u-text-7">Vị TRÍ</h6>
                                <p class="u-text u-text-8">
                                    115 Nguyễn Thị Minh Khai,<br />Phường 1, TP Vĩnh Lông
                                </p>
                            </div>
                        </div>
                        <div
                            class="
                  u-container-style u-image u-layout-cell u-size-12 u-image-1
                "
                            data-image-width="640"
                            data-image-height="640"
                        >
                            <div class="u-container-layout u-container-layout-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </div>
@endsection

@section('script')
    <script class="u-script" type="text/javascript" src="{{ asset("User/nicepage/recruitment/jquery.js")}}" defer=""></script>
    <script class="u-script" type="text/javascript" src="{{ asset("User/nicepage/recruitment/nicepage.js")}}" defer=""></script>
@endsection
