<?php

namespace App\Http\Controllers;

use App\Models\categoryModel;
use App\Models\categoryParentModel;
use App\Models\productModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function getData(Request $request)
    {
        $data = categoryModel::all()->sortBy('name');

        foreach ($data as $index => $item) {
            $data[$index]["name_parent"] = $item->category_parent['name'];
            $data[$index]["quantity"] = $item->product->count();
            $data[$index]["quantity_all"] = productModel::all()->count();
        }

        return datatables($data)->make(true);
    }

    public function getDataFilter(Request $request)
    {
        try {
            $data = categoryParentModel::find($request->input('id'))->category;
        }catch (\Exception $exception){
            $data = categoryModel::all()->sortBy('name');
        }

        foreach ($data as $index => $item) {
            $data[$index]["name_parent"] = $item->category_parent['name'];
            $data[$index]["quantity"] = $item->product->count();
            $data[$index]["quantity_all"] = productModel::all()->count();
        }

        return datatables($data)->make(true);
    }

    public function getImageProduct(Request $request)
    {
        $data = categoryModel::find($request->input('id'))->product->sortByDesc('view')->take(5);
        return view('support.imageProductMostView', ['data' => $data]);
    }


    public function insert(Request $request)
    {
        $cate = new categoryModel();
        $cate->name = trim($request->input('name'));
        $cate->id_parent = $request->input('id_parent');
        if ($cate->save())
            return ToolsModel::status('Thêm danh mục thành công', 200);
        return ToolsModel::status('Thêm danh mục thất bại', 500);

    }

    public function delete(Request $request){
        $temp = categoryModel::find($request->input('id'))->product;

        foreach ($temp as $item){
            $images = $item->images;
            foreach ($images as $image){
                $image->delete();
            }
            $item->delete();
        }

        $result = categoryModel::find($request->input('id'))->delete();
        if ($result)
            return ToolsModel::status('Danh mục đã được xóa', 200);
        return ToolsModel::status('Danh mục đã chưa được xóa', 500);
    }

    public function update(Request $request)
    {
        $cate = categoryModel::find($request->input('id'));
        $cate->name = trim($request->input('name'));
        $cate->id_parent = $request->input('id_parent');
        if ($cate->save())
            return ToolsModel::status('Cập nhật danh mục thành công', 200);
        return ToolsModel::status('Cập nhật danh mục thất bại', 500);

    }
}
