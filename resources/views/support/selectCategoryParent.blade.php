<select class="js-states form-control ml-4" id="selectCate" style="width: 200px">
    <option value="-1" class="text-success">Thêm mới</option>
    <option value="0" @if($id == 0) selected @endif>Tất cả</option>
    @foreach($data as $item)
        <option value="{{$item->id}}" @if($id == $item->id) selected @endif>{{$item->name}}</option>
    @endforeach
</select>
