<select class="form-control" id="selectCateInsert">
    @foreach($data as $item)
        <option value="{{$item->id}}" @if ($item->id == $id) selected @endif>{{$item->name}}</option>
    @endforeach
</select>
