<?php

namespace App\Http\Controllers;

use App\Models\orderModel;
use App\Models\productModel;
use App\Models\ToolsModel;
use App\Models\transactionModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class transactionController extends Controller
{
    public function getView(){

        return view('admin.transaction');
    }

    public function getData(){
        $data =transactionModel::all()->sortByDesc('created_at');

        foreach ($data as $index => $item) {
            $data[$index]["username"] = $item->user['username'];
            $data[$index]["name_profile"] = $item->user->profile['name'];
        }

        return datatables($data)->make(true);
    }

    public function getModal(Request $request){
        Carbon::setLocale('vi');
        $now = Carbon::now();
        $data = transactionModel::find($request->input('id'));
        $qty = 0;

        $data['is_moving'] =  Carbon::parse($data['is_moving']);
        $data['is_receive'] =  Carbon::parse($data['is_receive']);

        foreach ($data->order as $item){
            $qty += $item['quantity'];
        }

        return view('support.modalTransaction', ['data'=>$data, 'now'=>$now, 'qty'=>$qty]);
    }

    public function cancel(Request $request){
        $transaction = transactionModel::find($request->input('id'));
        if ($transaction['is_cancel'] == 0) $transaction['is_cancel'] = 1;
        elseif ($transaction['is_cancel'] == 1) $transaction['is_cancel'] = 0;

        if ($transaction->save())
            return ToolsModel::status('Cập nhật thành công', 200);
        return ToolsModel::status('Cập nhật thất bại', 500);
    }

    public function delete(Request $request){
        $transaction = transactionModel::find($request->input('id'));

        foreach ($transaction->order as $item){
            $item->delete();
        }

        if ($transaction->delete())
            return ToolsModel::status('Xóa đơn hàng thành công', 200);
        return ToolsModel::status('Xóa đơn hàng thất bại', 500);
    }


    public function getHistoryFilter(Request $request, $id_user){
        Carbon::setLocale('vi');
        $now = Carbon::now();

        $transactions = transactionModel::where('id_user',$id_user)
            ->whereBetween('created_at', [$request->input('start_day'), $request->input('end_day')])
            ->orderByDesc('created_at')->get();

        return view('support.listHistoryTransactionFilter',[
            'transactions'=> $transactions,
            'now'=>$now,
            'start_day' => $request->input('start_day'),
            'end_day' => $request->input('end_day'),
        ]);
    }

    public function getHistory($id_user){
        Carbon::setLocale('vi');
        $now = Carbon::now();

        $transactions = transactionModel::where('id_user',$id_user)->orderByDesc('created_at')->take(10)->get();

        return view('support.listHistoryTransaction',['transactions'=> $transactions, 'now'=>$now]);
    }

    public function insert(Request $request, $id_user){
        $orders = orderModel::where('id_user',$id_user)->where('status',0)->get();

        $transaction = new transactionModel();
        $transaction->id_user = $id_user;
        $transaction->comment = $request->input('comment');
        $transaction->transaction_code = $this->generateRandomString(8);
        $transaction->name = $request->input('name');
        $transaction->phone_number = $request->input('phone_number');
        $transaction->address = $request->input('address');
        $transaction->amount = $request->input('amount');
        $transaction->is_moving = null;
        $transaction->is_receive = null;
        $transaction->save();

        foreach ($orders as $order){
            $order->id_transaction = $transaction['id'];
            $order->status = 1;
            $order->save();
        }

        return true;

    }

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
