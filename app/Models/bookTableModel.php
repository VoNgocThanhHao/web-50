<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookTableModel extends Model
{
    use HasFactory;
    protected $table = 'book_table';
    protected $fillable=[
        'location',
        'name',
        'phone_number',
        'quantity',
        'day',
        'time',
    ];
}
