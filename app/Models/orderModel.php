<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderModel extends Model
{
    use HasFactory;
    protected $table = 'order';

    protected $fillable = [
        'id_product',
        'id_user',
        'id_transaction',
        'quantity',
        'status',
    ];

    public function product(){
        return $this->hasOne('App\Models\productModel','id','id_product');
    }
}
