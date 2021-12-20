<?php

namespace App\Http\Controllers;

use App\Models\bookTableModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class bookTableController extends Controller
{
    public function insert(Request $request){
        $book = new bookTableModel();
        $book->location = $request->input('location');
        $book->name = $request->input('name');
        $book->phone_number = $request->input('phone_number');
        $book->quantity = $request->input('quantity');
        $book->day = $request->input('day');
        $book->time = $request->input('time');

        if ($book->save())
            return ToolsModel::status('Yêu cầu đã được gửi thành công', 200);
        return ToolsModel::status('Gửi yêu cầu thất bại', 500);
    }
}
