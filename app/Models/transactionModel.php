<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionModel extends Model
{
    use HasFactory;

    protected $table = 'transaction';
    protected $fillable = [
        'id_user',
        'transaction_code',
        'comment',
        'name',
        'phone_number',
        'address',
        'amount',
        'payment',
        'payment_info',
        'is_moving',
        'is_receive',
    ];

    public function user(){
        return $this->hasOne('App\Models\User','id','id_user');
    }

    public function receive(){
        return $this->hasOne('App\Models\User','id','id_receive');
    }

    public function order(){
        return $this->hasMany('App\Models\orderModel','id_transaction','id');
    }
}
