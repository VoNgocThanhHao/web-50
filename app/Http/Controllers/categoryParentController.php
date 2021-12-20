<?php

namespace App\Http\Controllers;

use App\Models\categoryModel;
use App\Models\categoryParentModel;
use App\Models\productModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoryParentController extends Controller
{
    public function getView()
    {

        return view('admin/categorys');
    }

    public function getData(Request $request)
    {
        $data = categoryParentModel::all()->sortBy('name');
        return view('support.selectCategoryParent', ['data' => $data, 'id'=>$request->input('id')]);
    }

    public function getSelectInsert(Request $request)
    {
        $data = categoryParentModel::all()->sortBy('name');

        return view('support.selectCategoryParentInsert', ['data' => $data, 'id' => $request->input('id')]);
    }

    public function insert(Request $request)
    {
        $catePa = new categoryParentModel();
        $catePa->name = $request->input('name');
        if ($catePa->save()) {
            return ToolsModel::status('Thêm danh mục thành công', 200);
        }
        return ToolsModel::status('Thêm danh mục thất bại', 500);
    }

    public function delete(Request $request)
    {
        $temp = categoryParentModel::find($request->input('id'))->category;

        foreach ($temp as $item) {
            $cate = categoryModel::find($item['id']);
            $list = $cate->product;
            foreach ($list as $i) {
                $images = $i->images;
                foreach ($images as $image){
                    $image->delete();
                }
                $i->delete();
            }

            $cate->delete();

        }

        $result = categoryParentModel::find($request->input('id'))->delete();
        if ($result)
            return ToolsModel::status('Danh mục đã được xóa', 200);
        return ToolsModel::status('Danh mục đã chưa được xóa', 500);
    }

    public function update(Request $request)
    {
        $catePa = categoryParentModel::find($request->input('id'));
        $catePa->name = $request->input('name');
        if ($catePa->save()) {
            return ToolsModel::status('Cập nhật danh mục thành công', 200);
        }
        return ToolsModel::status('Cập nhật danh mục thất bại', 500);
    }
}
