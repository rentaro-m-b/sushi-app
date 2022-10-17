<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'stock',
        'on_sale'
    ];

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
