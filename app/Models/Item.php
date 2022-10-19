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

    public function scopeWhereLike($query, string $attribute, string $keyword, int $position = 0) {
        $keyword = addcslashes($keyword, '\_%');
        $condition = [
            1 => "{$keyword}%",
            -1 => "%{$keyword}",
        ][$position] ?? "%{$keyword}%";

        return $query->where($attribute, 'LIKE', $condition);
    }
}
