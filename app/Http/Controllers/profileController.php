<?php

namespace App\Http\Controllers;

use App\Models\orderModel;
use App\Models\productModel;
use App\Models\profileModel;
use App\Models\ToolsModel;
use App\Models\transactionModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function getView($id){

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

        if (Auth::user()->id == $id || Auth::user()->permission == 2)
        {
            return view('admin.profile',['user'=>$user,'list'=>$list]);
        }

        return abort(404);
    }

    public function update($id, Request $request){

        $user = User::find($id);
        $user->email = $request->input('email');
        $result_1 = $user->save();

        $profile = profileModel::find($user['id_profile']);

        if ($request->image != null) {
            $image_array_1 = explode(";", $request->image);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $imageName = time() . '.png';
            file_put_contents(public_path('images/users/'.$imageName), $data);
            $profile->image = 'images/users/'.$imageName;
        }


        $profile->name = $request->input('name');
        $profile->description = $request->input('description');
        $profile->phone_number = $request->input('phone_number');
        $profile->address = $request->input('address');
        $result_2 = $profile->save();

        if ($result_1 && $result_2)
            return ToolsModel::status('Cập nhật thành công', 200);
        return ToolsModel::status('Cập nhật thất bại', 500);


    }
}
