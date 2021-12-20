<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoryParentModel extends Model
{
    use HasFactory;

    protected $table = 'category_parent';

    protected $fillable = [
        'name',
    ];

    public function category(){
        return $this->hasMany('App\Models\categoryModel','id_parent','id');
    }
}
