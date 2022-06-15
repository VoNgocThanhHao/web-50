<div class="row">
@foreach($data as $item)
    <div
        class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-body pt-0">
                <div class="row mb-2 mt-2">
                    <div class="col-6 text-center">
                        <span class="" style="font-size: 15px"><b>{{ $item['name'] }}</b></span>
                    </div>
                    <div class="col-6 text-center">
                        <img
                            src="{{ asset($item['image']).'?v='.time() }}"
                            alt="user-avatar"
                            class="img-circle img-fluid">
                    </div>
                </div>
                <div class="row">
                    <p class="text-muted text-sm"><b>Mô tả: </b>
                        {{ $item['description'] }} </p>
                </div>
                <div class="row">
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i
                                    class="fas fa-lg fa-money-bill-wave"></i></span>
                            Giá: <span class="price_product">{{ number_format($item['price'], 0 ,"," ,".") }}</span> VNĐ
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <a href="{{ action('App\Http\Controllers\productController@getViewDetail',$item['id']) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-search"></i> Xem chi tiết
                    </a>
                    <a href="#" class="btn btn-sm btn-danger btnDeleteProduct" data="{{ $item['id'] }}" id_cate ="{{ $item['id_category'] }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endforeach
</div>
