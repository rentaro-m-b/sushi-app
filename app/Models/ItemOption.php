<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\Option;
use App\Models\ItemOption;

class ItemOption extends Model
{
    use HasFactory;

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
