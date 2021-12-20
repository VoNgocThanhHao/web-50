<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoryModel extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'name',
        'id_parent',
    ];

    public function category_parent(){
        return $this->hasOne('App\Models\categoryParentModel','id','id_parent');
    }

    public function product(){
        return $this->hasMany('App\Models\productModel','id_category','id');
    }
}
