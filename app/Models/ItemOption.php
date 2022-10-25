<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'option_id',
        'on_sale'
    ];
}
