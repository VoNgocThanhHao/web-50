@foreach($data as $item)

    <div class="card card-primary card-outline">

        <a class="d-block w-100 collapsed" data-toggle="collapse"
           href="#page_cate_pro_{{$item['id']}}" aria-expanded="false">
            <div class="card-header">
                <h4 class="card-title w-100">
                    <strong><i class="far fa-list-alt mr-1"></i> {{ $item['name'] }} </strong>
                </h4>
            </div>
        </a>
        <div id="page_cate_pro_{{$item['id']}}" class="collapse" data-parent="#accordion_{{ $id }}" style="">
            <div class="card-body">


                <div class="row">


                    @foreach($item->product as $product)

                        <div
                            class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-body pt-0">
                                    <div class="row mb-2 mt-2">
                                        <div class="col-6 text-center">
                                            <span class="" style="font-size: 15px"><b>{{ $product['name'] }}</b></span>
                                        </div>
                                        <div class="col-6 text-center">
                                            <img
                                                src="{{ asset($product['image']) }}"
                                                alt="user-avatar"
                                                class="img-circle img-fluid">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <p class="text-muted text-sm"><b>Mô tả: </b>
                                            {{ $product['description'] }} </p>
                                    </div>
                                    <div class="row">
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-money-bill-wave"></i></span>
                                                Giá: <span class="price_product">{{ number_format($product['price'], 0 ,"," ,".") }}</span> VNĐ
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{ action('App\Http\Controllers\productController@getViewDetail',$product['id']) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-search"></i> Xem chi tiết
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger btnDeleteProduct" data="{{ $product['id'] }}" id_cate ="{{ $product['id_category'] }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>


            </div>
        </div>
    </div>

@endforeach
