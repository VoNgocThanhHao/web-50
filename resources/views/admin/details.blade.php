@extends('master-admin')
@section('title') Tất cả thông tin người dùng @endsection
@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thông tin người dùng</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>




    <section class="content">


        <div class="card card-primary card-tabs">

            <div class="card-body">
                <div class="tab-content">

                    {{--                    content--}}

                    @for($i=1, $index = 0; $i<=ceil($count/9); $i++)

                    <div class="tab-pane fade @if($i==1) active show @endif " id="page_{{$i}}" role="tabpanel"
                         aria-labelledby="custom-tabs-one-home-tab">

                        <div class="row">

{{--                            @foreach($users as $item)--}}
                            @for($index; $index<(9*$i) && $index < $count; $index++ )
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                          @if($users[$index]['permission']==2)
                                              Quản lý
                                        @elseif($users[$index]['permission']==1)
                                                Nhân viên
                                        @else
                                            Khách hàng
                                        @endif
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{ $users[$index]->profile['name'] }}</b></h2>
                                                <p class="text-muted text-sm"><b>Tên đăng nhập: </b> {{ $users[$index]['username'] }}</p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small mb-3"><span class="fa-li"><i
                                                                class="fas fa-lg fa-building"></i>
                                                        </span>
                                                        Địa chỉ: {{ $users[$index]->profile['address'] }}
                                                    </li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-phone"></i></span>
                                                        Số điện thoại: {{ $users[$index]->profile['phone_number'] }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="{{ asset($users[$index]->profile['image']).'?v='.time() }}"
                                                     alt="user-avatar"
                                                     class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="{{ action('App\Http\Controllers\profileController@getView',$users[$index]['id']) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-user"></i> Xem thông tin
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endfor


                        </div>


                    </div>

                    @endfor


                </div>


                <div class="card-footer mb-3 p-0 pt-1">
                    <ul class="nav nav-tabs pagination justify-content-center m-0" id="custom-tabs-one-tab" role="tablist">

                        @for($i=1; $i<=ceil($count/9); $i++)
                            <li class="nav-item">
                                <a class="nav-link @if($i == 1) active @endif "
                                   data-toggle="pill" href="#page_{{$i}}" role="tab">{{$i}}</a>
                            </li>

                        @endfor


                    </ul>
                </div>


            </div>
        </div>
        <!-- /.card -->




    </section>









@endsection

@section('script')
    <script type="text/javascript">


        $(document).ready(function () {


        });
    </script>
@endsection
