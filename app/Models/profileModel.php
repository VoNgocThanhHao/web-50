<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profileModel extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $fillable = [
        'name',
        'image',
        'description',
        'phone_number',
        'address',
        'score',
        'score_used',
        'total',
    ];
}
