<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'table_id',
        'paid'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
