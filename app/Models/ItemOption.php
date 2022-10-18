<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\Option;

class ItemOption extends Model
{
    use HasFactory;

    // public function item()
    // {
    //     return $this->belongsTo(Item::class);
    // }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
