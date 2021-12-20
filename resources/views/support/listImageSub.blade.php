<div class="product-image-thumb active" _type="product_image" data="{{ $product['id'] }}"><img src="{{ asset($product['image']) }}" class="imageProduct" alt="Product Image"></div>
<input type="file" id="updateImage" hidden>
@foreach($product->images as $image)
    <div class="product-image-thumb" _type="sub_image" data="{{ $image['id'] }}"><img src="{{ asset($image['path']) }}" class="imageSub_{{$image['id']}}" alt="Product Image"></div>
@endforeach
<button type="button" class="btn btn-primary btnAddImage" style="width: 60px">
    <i class="fas fa-plus"></i>
</button>
