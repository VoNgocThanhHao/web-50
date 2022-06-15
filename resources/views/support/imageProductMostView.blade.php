<ul class="list-inline">
    @foreach($data as $item)
    <li class="list-inline-item product_img_info">
        <img class="table-avatar"
             src="{{ asset($item['image']).'?v='.time()}}">
        <span class="text_info_product">{{ $item['name'] }}</span>
    </li>

    @endforeach
</ul>
