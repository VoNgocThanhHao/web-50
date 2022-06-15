<?php

namespace App\Http\Controllers;

use App\Models\categoryModel;
use App\Models\categoryParentModel;
use App\Models\commentModel;
use App\Models\orderModel;
use App\Models\productModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Utils;

class pageController extends Controller
{
    public function getView()
    {

        $list_discount = productModel::where('discount','!=',null)->get();

        $list_offer = productModel::all()->sortByDesc('view')->take(8);

        return view('user.index', ['list_discount'=>$list_discount, 'list_offer'=>$list_offer]);
    }

    public function getQuantityCart(Request $request){
        $list = orderModel::where('id_user',$request->input('id'))->where('status',0)->get();
        $quantity = 0;
        foreach ($list as $item){
            $quantity += $item['quantity'];
        }

        return $quantity;
    }

    public function getViewProfile($id){
        $list = [];
        $products = productModel::all();
        foreach ($products as $index => $product){
            $list[$index]['quantity'][] = orderModel::where('id_user',$id)->where('id_product',$product['id'])->sum('quantity');
            $list[$index]['id'][] = $product['id'];
        }

        for($i = 0; $i < count($list)-1; $i++){
            for ($j = $i+1; $j < count($list); $j++){
                if ($list[$i]['quantity'] < $list[$j]['quantity']){
                    $temp = $list[$i];
                    $list[$i] = $list[$j];
                    $list[$j] = $temp;
                }
            }
        }


        $user = User::find($id);

        return view('user.profile-user',['user'=>$user,'list'=>$list]);
    }

    public function getViewProduct($id_product){

        $product = productModel::find($id_product);

        $data = categoryParentModel::all();

        Carbon::setLocale('vi');
        $now = Carbon::now();

        $list_comment = commentModel::where('id_product',$id_product)->get()->sortByDesc('created_at');

        foreach ($data as $index => $item) {
            $data[$index]["category"] = $item->category->sortBy('name');
        }

        return view('user.product-user',
            [
                'product'=>$product,
                'data'=>$data ,
                'id_product'=>$id_product,
                'list_comment'=>$list_comment,
                'now'=>$now,
            ]);
    }

    public function getBoxComment($id_product){
        Carbon::setLocale('vi');
        $now = Carbon::now();
        $list_comment = commentModel::where('id_product',$id_product)->get()->sortByDesc('created_at');
        return view('support.getComment',
            [
                'list_comment'=>$list_comment,
                'now'=>$now,
            ]);
    }


    public function getViewMenuProduct(){
        $cates = categoryParentModel::all();

        foreach ($cates as $index => $item) {
            $cates[$index]["category"] = $item->category->sortBy('name');
        }

        return view('user.menu-product',['cates'=>$cates]);
    }

    public function getDataMenuAll(){
        $products = productModel::all();
        return view('support.getUserProductMenu', ['products'=>$products]);
    }

    public function getDataMenuFilter(Request  $request){
        $name = $request->input('name');
        $type_cate = $request->input('type_cate');
        $id_cate = $request->input('id_cate');
        $discount = $request->input('discount');
        $none_discount = $request->input('none_discount');

        $products = [];

        if ($type_cate == "all"){
            if ($discount == "true" && $none_discount == "false"){
                $products = productModel::where('discount','!=',null)->where('name','LIKE','%'.$name.'%')->get();
            }elseif ($discount == "false" && $none_discount == "true"){
                $products = productModel::where('discount',null)->where('name','LIKE','%'.$name.'%')->get();
            }else{
                $products = productModel::where('name','LIKE','%'.$name.'%')->get();
            }
        }elseif ($type_cate == "parent"){
            $cates = categoryParentModel::find($id_cate)->category;
            foreach ($cates as $cate){
                if ($discount == "true" && $none_discount == "false"){
                    foreach ($cate->product()->where('discount','!=',null)->where('name','LIKE','%'.$name.'%')->get() as $product){
                        $products[] = $product;
                    }
                }elseif ($discount == "false" && $none_discount == "true"){
                    foreach ($cate->product()->where('discount',null)->where('name','LIKE','%'.$name.'%')->get() as $product){
                        $products[] = $product;
                    }
                }else{
                    foreach ($cate->product()->where('name','LIKE','%'.$name.'%')->get() as $product){
                        $products[] = $product;
                    }
                }
            }
        }elseif ($type_cate == "child"){
            if ($discount == "true" && $none_discount == "false"){
                $products = categoryModel::find($id_cate)->product()->where('discount','!=',null)->where('name','LIKE','%'.$name.'%')->get();
            }elseif ($discount == "false" && $none_discount == "true"){
                $products = categoryModel::find($id_cate)->product()->where('discount',null)->where('name','LIKE','%'.$name.'%')->get();
            }else{
                $products = categoryModel::find($id_cate)->product()->where('name','LIKE','%'.$name.'%')->get();
            }
        }
        return view('support.getUserProductMenu', ['products'=>$products]);
    }

    public function getViewCart($id_user){
        $list_order = orderModel::where('id_user',$id_user)->where('status',0)->get();

        return view('user.cart',['list_order'=>$list_order]);
    }


}
