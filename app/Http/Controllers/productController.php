<?php

namespace App\Http\Controllers;

use App\Models\categoryModel;
use App\Models\categoryParentModel;
use App\Models\commentModel;
use App\Models\imagesModel;
use App\Models\productModel;
use App\Models\ToolsModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    public function getView(){
        $data = categoryParentModel::all();

        foreach ($data as $index => $item) {
            $data[$index]["category"] = $item->category->sortBy('name');
        }


        return view('admin.products',['data'=>$data]);
    }

    public function getProductAll(){
        $data = categoryParentModel::all();

        foreach ($data as $index => $item) {
            $data[$index]["category"] = $item->category;
        }

        return view('support.getProductAll',['data'=>$data]);
    }

    public function getProductOfCategory(Request $request){
        $data = categoryModel::find($request->input('id'))->product;

        return view('support.getProductOfCategory',['data'=>$data]);
    }

    public function getProductOfCategoryPage(Request $request){
        $data = categoryParentModel::find($request->input('id'))->category;

        return view('support.getProductOfCategoryTab',['data'=>$data,'id'=>$request->input('id')]);
    }

    public function getProductFilterAll(Request $request){

        $filterData = productModel::where('name','LIKE','%'.$request->input('name').'%')
            ->get();

        return view('support.getProductFilterAll',['data'=>$filterData]);
    }

    public function getProductFilterCategory(Request $request){

        $data = [];
        $catePa = categoryParentModel::find($request->input('id'))->category;
        foreach ($catePa as $cate){
            $products = $cate->product()->where('name','LIKE','%'.$request->input('name').'%')->get();
            foreach ($products as $product){
                $data[] = $product;
            }
        }

        return view('support.getProductFilterAll',['data'=>$data]);
    }



    public function insert(Request $request){
        $product = new productModel();
        $product->name = trim($request->input('name'));
        $product->price = $request->input('price');

        if ($request->image != 'undefined') {
            $image_array_1 = explode(";", $request->image);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $imageName = time() . '.png';
            file_put_contents(public_path('images/products/'.$imageName), $data);
            $product->image = 'images/products/'.$imageName;
        }

        $product->description = trim($request->input('description'));
        $product->discount = $request->input('discount');
        $product->id_category = $request->input('id_category');
        $product->view = 0;
        $product->save();



        $i = 0 ;
        if ($request->hasFile('images')){
            foreach ($request->images as $image){
                $image_sub = new imagesModel();
                $ext = $image->extension();
                $image_name = 'sub_'.time().$i.'.'.$ext;
                $image->move(public_path('images/products/subs'),$image_name);
                $image_sub->path = 'images/products/subs/'.$image_name;
                $image_sub->id_product = $product['id'];
                $image_sub->save();
                $i++;
            }
        }

        return ToolsModel::status('Thêm sản phẩm thành công', 200);

    }

    public function delete(Request $request){
        $product = productModel::find($request->input('id'));
        $images = $product->images;
        foreach ($images as $image){
            $image->delete();
        }
        if ($product->delete())
            return ToolsModel::status('Xóa sản phẩm thành công', 200);
        return ToolsModel::status('Xóa sản phẩm thất bại', 500);
    }





    public function getViewDetail($id_product){
        $product = productModel::find($id_product);

        $data = categoryParentModel::all();


        Carbon::setLocale('vi');
        $now = Carbon::now();

        $list_comment = commentModel::where('id_product',$id_product)->get()->sortByDesc('created_at');

        foreach ($data as $index => $item) {
            $data[$index]["category"] = $item->category->sortBy('name');
        }

        return view('admin.details-product',['product'=>$product,
            'data'=>$data , 'id_product'=>$id_product,'list_comment'=>$list_comment,
            'now'=>$now,]);
    }


    public function update(Request $request, $id_product){
        $product = productModel::find($id_product);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->id_category = $request->input('id_category');
        $product->discount = $request->input('discount');

        if ($product->save())
            return ToolsModel::status('Cập nhật sản phẩm thành công', 200);
        return ToolsModel::status('Cập nhật sản phẩm thất bại', 500);
    }

    public function updateImage(Request $request, $id_product){
        $product = productModel::find($id_product);
        $temp = explode("/", $product['image']);
        $imageName = $temp[count($temp)-1];
//        dd($request->image);
        if ($request->image != 'undefined') {
            $image_array_1 = explode(";", $request->image);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            file_put_contents(public_path('images/products/'.$imageName), $data);
            $product->image = 'images/products/'.$imageName;
        }
        if ($product->save())
            return ToolsModel::status('Cập nhật sản phẩm thành công', 200);
        return ToolsModel::status('Cập nhật sản phẩm thất bại', 500);
    }

    public function getListImage(Request $request, $id_product){
        $product = productModel::find($id_product);

        return view('support.listImageSub',['product'=>$product]);
    }
}
