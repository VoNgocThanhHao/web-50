@extends('master-admin')
@section('title') Thông tin người dùng @endsection
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" placeholder="Choose image" id="image" hidden>

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="row">
                                <div class="col-md-5"></div>
                                <button class="btn btn-outline-secondary btn-sm mb-3 col-md-7 btnUpload">
                                Cập nhật ảnh đại diện
                                </button>
                            </div>
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     id="image_preview_container"
                                     src="{{ asset(''.$user->profile['image'].''  ) }}"


                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->profile['name'] }}</h3>

                            <p class="text-muted text-center">
                                @if($user->profile['score'] < 20)
                                    <span style="color: blue"><i class="fas fa-child mr-1"></i><b>Khách hàng mới</b></span>
                                @elseif($user->profile['score'] < 50)
                                    <span style="color: green"><i class="fas fa-handshake mr-1"></i><b>Khách hàng thân thiết</b></span>
                                @elseif($user->profile['score'] < 70)
                                    <span style="color: greenyellow"><i class="fas fa-star mr-1"></i><b>Khách hàng V.I.P</b></span>
                                @else
                                    <span style="color: brown"><i class="fas fa-crown mr-1"></i><b>Thành viên Brownie</b></span>
                                @endif
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Tổng đơn hàng</b> <a class="float-right">{{ $user->profile['total'] }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tổng điểm tích lũy</b> <a class="float-right">{{ $user->profile['score'] }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Điểm chưa sử dụng</b> <a class="float-right">{{ $user->profile['score']-$user->profile['score_used'] }}</a>
                                </li>
                            </ul>

                            @if($user['email_verified_at'])
                                <p class="btn btn-primary btn-block" disabled=""><b>Đã xác nhận email</b></p>
                            @else
                                <p class="btn btn-danger btn-block" disabled=""><b>Chưa xác nhận email</b></p>
                            @endif

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Thông
                                        tin cá nhân</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">
                                        Lịch sử mua hàng
                                    </a></li>

                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse" id="historyTransactionBox">
                                        <!-- timeline time label -->

                                    </div>
                                </div>
                                <!-- /.tab-pane -->


                                <div class="tab-pane active" id="settings">
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Họ và tên</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control _name"
                                                       placeholder="Họ và tên" value="{{ $user->profile['name'] }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control _email"
                                                       placeholder="Email" value="{{ $user['email'] }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Số điện thoại</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control _sdt"
                                                       data-inputmask="'mask': ['9999-999-999']"
                                                       data-mask="" inputmode="text" value="{{ $user->profile['phone_number'] }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for=""
                                                   class="col-sm-2 col-form-label">Địa chỉ</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control _address"
                                                       placeholder="Địa chỉ" value="{{ $user->profile['address'] }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for=""
                                                   class="col-sm-2 col-form-label">Mô tả</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control _description" rows="4"
                                                          placeholder="Mô tả">{{ $user->profile['description'] }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button class="btn btn-outline-primary btnSubmit">Lưu</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->


                <div class="col-md-2">
                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Mua nhiều nhất</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-mug-hot mr-1"></i> Nước uống </strong>

                            <p class="text-muted">
                            <div class="row">
                                <div class="col-md-12 col-lg-6 col-xl-5">
                                    <div class="card mb-1 bg-gradient-dark">
                                        <img class="profile-user-img img-fluid img-thumbnail"
                                             src="{{ asset('images/avatars/tuyetnhi.jpg') }}"
                                             alt="User profile picture">
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-6 col-xl-7">
                                    <h6 class="">Tên món bla bla bla bla</h6>
                                </div>
                            </div>
                            </p>

                            <hr>

                            <strong><i class="fas fa-birthday-cake mr-1"></i> Bánh ngọt </strong>

                            <p class="text-muted">
                            <div class="row">
                                <div class="col-md-12 col-lg-6 col-xl-5">
                                    <div class="card mb-1 bg-gradient-dark">
                                        <img class="profile-user-img img-fluid img-thumbnail"
                                             src="{{ asset('images/avatars/tuyetnhi.jpg') }}"
                                             alt="User profile picture">
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-6 col-xl-7">
                                    <h6 class="">Tên món bla bla bla bla</h6>
                                </div>
                            </div>
                            </p>

                            <hr>

                            <strong><i class="fas fa-utensils mr-1"></i> Điểm tâm</strong>

                            <p class="text-muted">
                            <div class="row">
                                <div class="col-md-12 col-lg-6 col-xl-5">
                                    <div class="card mb-1 bg-gradient-dark">
                                        <img class="profile-user-img img-fluid img-thumbnail"
                                             src="{{ asset('images/avatars/tuyetnhi.jpg') }}"
                                             alt="User profile picture">
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-6 col-xl-7">
                                    <h6 class="">Tên món bla bla bla bla</h6>
                                </div>
                            </div>
                            </p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->



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

        var startDate;
        var endDate;
        var is_picked = false;
        var image_product = '';

        var UPDATE = '{{ action('App\Http\Controllers\profileController@update',$user['id']) }}';
        var GET_MODAL = '{{ action('App\Http\Controllers\transactionController@getModal') }}'
        var GET_LIST_HISTORY = '{{ action('App\Http\Controllers\transactionController@getHistory',$user['id']) }}'
        var GET_LIST_HISTORY_FILTER = '{{ action('App\Http\Controllers\transactionController@getHistoryFilter', $user['id']) }}'
        var UPDATE_CANCEL = '{{ action('App\Http\Controllers\transactionController@cancel') }}'



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

        var get_history = function (){
            $.ajax({
                url: GET_LIST_HISTORY,
                type: "GET",
                data: {
                },
                success: function (result) {
                    $('#historyTransactionBox').html('')
                    $('#historyTransactionBox').html(result)
                    $('#pickerDate').daterangepicker({},function(start, end, label) {
                        startDate = start.format('YYYY-MM-DD')
                        endDate = end.format('YYYY-MM-DD')
                    })
                    is_picked = false
                }
            });
        }

        var get_history_filter = function (start_day, end_day){
            $.ajax({
                url: GET_LIST_HISTORY_FILTER,
                type: "GET",
                data: {
                    'start_day': start_day,
                    'end_day': end_day,
                },
                success: function (result) {
                    $('#historyTransactionBox').html('')
                    $('#historyTransactionBox').html(result)
                    $('#pickerDate').daterangepicker({},function(start, end, label) {
                        startDate = start.format('YYYY-MM-DD')
                        endDate = end.format('YYYY-MM-DD')
                    })
                    is_picked = false
                }
            });
        }


        $(document).ready(function () {


            $('[data-mask]').inputmask();

            get_history();



            $(document).on('click', '.btnDetail', function () {

                get_modal($(this).attr('data'));

                $('#myModal').attr('data',$(this).attr('data'))
                $('#myModal').modal('toggle');
            });

            $('.close').click(function (){
                $('#myModal').modal('hide')
            })

            $('.btnUpload').click(function (){
                $('#image').click();
            });
            $('.btnReChoose').click(function (){
                $('#image').click();
            });
            $('.btnCloseUpload').click(function (){
                $('#uploadimageModal').modal('hide');
            });


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

            $('#image').change(function(){

                let reader = new FileReader();

                reader.onload = (e) => {
                    image_crop.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
                        // console.log('jQuery bind complete');
                    });

                    // $('#image_preview_container').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

                $('#uploadimageModal').modal('show');
            });

            $('.crop_image').click(function(event){
                image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response){
                    // console.log(response);
                    image_product = response;
                    $('#image_preview_container').attr('src', response);
                })
                $('#uploadimageModal').modal('hide');
            });



            $('.btnSubmit').click(function (){

                // var image = $('#image')[0].files[0];

                var fd = new FormData();
                fd.append( 'image', image_product );
                fd.append( 'name', $('._name').val() );
                fd.append( 'email', $('._email').val() );
                fd.append( 'phone_number', $('._sdt').val() );
                fd.append( 'address', $('._address').val() );
                fd.append( 'description', $('._description').val() );


                $.ajax({
                    url: UPDATE,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thao tác thành công',
                                showConfirmButton: false,
                                text: result.message,
                            })
                            setTimeout(function () {
                                window.location.reload();
                            }, 1200);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thao tác thất bại',
                                text: result.message,
                            })
                        }

                    }
                });
            })

            $(document).on('click','.btnSelectDate',function (){
                $('#pickerDate').click()
                is_picked = true

                $(document).on('change', '#pickerDate', function (){
                    if (is_picked)
                        get_history_filter(startDate, endDate)
                })
            })

            $(document).on('click','.btnLastHistory', function (){
                get_history()
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


        });
    </script>
@endsection
