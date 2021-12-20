<?php

namespace App\Http\Controllers;

use App\Models\orderModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function insert(Request $request){
        if ($request->input('quantity')) $quantity = $request->input('quantity');
        else $quantity = 1;

        $id_user = $request->input('id_user');
        $id_product = $request->input('id_product');

        $item = orderModel::where('id_user',$id_user)->where('id_product',$id_product)->where('status',0)->get()->take(1)->toArray();

        if ($item){
            $item = $item[0];
            $order = orderModel::find($item['id']);
            $order->quantity = $order['quantity'] + $quantity;
            if ($order->save())
                return ToolsModel::status('Đã thêm vào giỏ hàng thành công', 200);
            return ToolsModel::status('Thêm thất bại thất bại', 500);
        }

        $order = new orderModel();
        $order->id_product = $id_product;
        $order->id_user = $id_user;
        $order->quantity = $quantity;
        $order->status = 0;

        if ($order->save())
            return ToolsModel::status('Đã thêm vào giỏ hàng thành công', 200);
        return ToolsModel::status('Thêm thất bại', 500);
    }

    public function updateQuantity(Request $request){
        $order = orderModel::find($request->input('id'));
        $order->quantity = $request->input('quantity');
        if ($order->save())
            return true;
        return false;
    }

    public function delete(Request $request){
        $order = orderModel::find($request->input('id'));
        if ($order->delete())
            return ToolsModel::status('Đã xóa khỏi giỏ hàng thành công', 200);
        return ToolsModel::status('Xóa thất bại', 500);
    }

    public function getAmount($id_user){
        $orders = orderModel::where('id_user',$id_user)->where('status',0)->get();
        $amount = 0;
        foreach ($orders as $order){
            if ($order->product['discount']){
                $price = $order->product['price']-($order->product['price']*($order->product['discount']/100));
                $amount += $price*$order['quantity'];
            }else{
                $price = $order->product['price'];
                $amount += $price*$order['quantity'];
            }
        }
        return $amount;
    }
}
