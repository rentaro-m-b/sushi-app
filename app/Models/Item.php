<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'stock',
        'on_sale'
    ];
}
