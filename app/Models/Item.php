<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\ItemOption;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
    ];

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function itemoptions()
    {
        return $this->hasMany(ItemOption::class);
    }
}
