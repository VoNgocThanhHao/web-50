<?php

namespace App\Http\Controllers;

use App\Models\commentModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class commentController extends Controller
{
    public function insert(Request $request, $id_product){
        $comment = new commentModel();
        $comment->id_user = $request->input('id_user');
        $comment->id_product = $id_product;
        $comment->message = $request->input('message');

        if ($comment->save())
            return ToolsModel::status('Cảm ơn góp ý của bạn', 200);
        return ToolsModel::status('Thao tác thất bại', 500);
    }
}
