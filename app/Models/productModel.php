<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productModel extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'id_category',
        'discount',
        'view',
    ];

    public function images(){
        return $this->hasMany('App\Models\imagesModel','id_product','id');
    }

    public function category(){
        return $this->hasOne('App\Models\categoryModel','id','id_category');
    }
}
