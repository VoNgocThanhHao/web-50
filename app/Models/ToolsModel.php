<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ToolsModel extends Model
{


    public static function status($message, $code)
    {
        return json_encode((object)["status" => $code, "message" => $message]);
    }

}
