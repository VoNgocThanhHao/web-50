<div class="time-label">
    <button type="button" class="btn btn-danger btnLastHistory">Gần nhất</button>
</div>
<div class="time-label">
    <span class="bg-primary">
          {{ date('d-m-Y', strtotime($start_day)) }}
        <i class="fas fa-arrow-right"></i>
          {{ date('d-m-Y', strtotime($end_day)) }}
    </span>
</div>


@foreach($transactions as $transaction)

    <div>
        <i type="button" class="fas fa-info bg-lightblue btnDetail" data="{{ $transaction['id'] }}"></i>

        <div class="timeline-item">
            <span class="time"><i class="far fa-clock"></i>
                {{ date('d-m-Y', strtotime($transaction['created_at'])) }}
            </span>

            <h3 class="timeline-header border-0">Đã đặt hàng</h3>
        </div>
    </div>

@endforeach


<!-- END timeline item -->
<div>
    <input type="text" class="form-control ml-3" id="pickerDate"
           style="width: 0; margin-top: -5px; visibility: hidden;">
    <i type="button" class="far fa-clock bg-gray btnSelectDate">
    </i>
</div>
