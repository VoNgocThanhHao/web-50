<?php

namespace App\Http\Controllers;

use App\Models\imagesModel;
use App\Models\ToolsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class imagesController extends Controller
{
    public function update(Request $request){
        $image = imagesModel::find($request->input('id'));

        $temp = explode("/", $image['path']);
        $imageName = $temp[count($temp)-1];
//        dd($request->image);
        if ($request->image != 'undefined') {
            $image_array_1 = explode(";", $request->image);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            file_put_contents(public_path('images/products/subs/'.$imageName), $data);
            $image->path = 'images/products/subs/'.$imageName;
        }
        if ($image->save())
            return ToolsModel::status('Cập nhật sản phẩm thành công', 200);
        return ToolsModel::status('Cập nhật sản phẩm thất bại', 500);
    }

    public function insert(Request $request, $id_product){
        $image = new imagesModel();
        if ($request->image != 'undefined') {
            $image_array_1 = explode(";", $request->image);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $imageName = 'sub_'.time().'.png';
            file_put_contents(public_path('images/products/subs/'.$imageName), $data);
            $image->path = 'images/products/subs/'.$imageName;
            $image->id_product = $id_product;
            if ($image->save()) return ToolsModel::status('Cập nhật sản phẩm thành công', 200);
        }
        return ToolsModel::status('Cập nhật sản phẩm thất bại', 500);
    }

    public function delete(Request $request){
        $image = imagesModel::find($request->input('id'));
        if ($image->delete())
            return ToolsModel::status('Xóa hình ảnh thành công', 200);
        return ToolsModel::status('Xóa hình ảnh thất bại', 500);
    }
}
