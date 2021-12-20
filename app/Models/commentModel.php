<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commentModel extends Model
{
    use HasFactory;

    protected $table = 'comment';
    protected $fillable = [
        'id_user',
        'id_product',
        'message',
    ];

    public function user(){
        return $this->hasOne('App\Models\User','id','id_user');
    }
}
