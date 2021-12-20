<?php

namespace App\Http\Controllers;

use App\Models\contactModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class contactController extends Controller
{
    public function insert(Request $request){
        $contact = new contactModel();
        $contact->name = trim($request->input('name'));
        $contact->email = trim($request->input('email'));
        $contact->title = trim($request->input('title'));
        $contact->content = trim($request->input('content'));

        if ($contact->save())
            return ToolsModel::status('Cảm ơn góp ý của bạn', 200);
        return ToolsModel::status('Thao tác thất bại', 500);
    }
}
