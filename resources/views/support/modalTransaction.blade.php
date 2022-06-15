<!-- The timeline -->
<div class="timeline timeline-inverse">
    <!-- timeline time label -->
    <div class="time-label">
        <span class="bg-danger">
          Đơn hàng {{ $data['transaction_code'] }}
        </span>
    </div>

    @if($data['is_cancel'] == 0)
        @if($data['id_receive'] != null)
        <div>
            <i class="fas fa-coins bg-warning"></i>

            <div class="timeline-item">
                <span class="time"><i class="far fa-clock"></i> {{ $data['is_receive']->diffForHumans($now) }} </span>
                <h3 class="timeline-header border-0"><a href="#">Đã nhận hàng</a>
                     ({{$data->receive->profile['name'] }})
                </h3>
            </div>
        </div>
        @endif

    @else
        <div>
            <i class="fas fa-bus bg-danger"></i>

            <div class="timeline-item">
                <span class="time"><i class="far fa-clock"></i> {{ $data['updated_at']->diffForHumans($now) }} </span>
                <h3 class="timeline-header border-0">Đã hủy đơn hàng</h3>
            </div>
        </div>
    @endif


    <div>
        <i class="fas fa-cash-register bg-primary"></i>

        <div class="timeline-item">
            <span class="time"><i class="far fa-clock mr-1"></i>{{ $data['created_at']->diffForHumans($now) }}</span>

            <h3 class="timeline-header"><a href="#">Đã đặt hàng</a>
                bởi <i>{{ $data->user->profile['name'] }}</i>
            </h3>
            <div class="card-body row">
                @foreach($data->order as $item)
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <div class="card mb-1 bg-gradient-dark product_img_info">
                        <img class="card-img-top"
                             src="{{ asset($item->product['image']).'?v='.time() }}">
                        <span class="text_info_product">{{ $item->product['name'].' ('.$item['quantity'].')' }}</span>
                    </div>

                </div>
                @endforeach

                <br>
                    <div class="col-md-12">
                Đơn hàng bao gồm: {{ $qty }} món
                    </div>
                    <div class="col-md-12">
                        <b> Tổng hóa đơn: {{ number_format($data['amount'], 0 ,"," ,".") }} VNĐ </b>
                    </div>
                    <br>
            </div>
        </div>
    </div>


    @if($data['is_cancel'] == 0)
        <!-- END timeline item -->
        <div>
            <i type="button" class="fas fa-times-circle bg-danger @if($data['id_receive'] == null) btnCancel @endif"></i>
        </div>
    @else
        <div>
            <i type="button" class="fas fa-angle-double-right bg-primary @if($data['id_receive'] == null) btnCancel @endif"></i>
        </div>
    @endif
</div>
