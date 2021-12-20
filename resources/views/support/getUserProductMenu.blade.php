@foreach($products as $product)
<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column mb-3">
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
                <h3 class="card__title">{{ $product['name'] }}</h3>
            </a>
            <p class="card__text">{{ $product['description'] }}</p>
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
