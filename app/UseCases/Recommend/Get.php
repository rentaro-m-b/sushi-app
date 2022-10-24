<?php
namespace App\UseCases\Recommend;

use App\Models\Item;
use App\Http\Resources\ItemResource;

class Get{
    public function __invoke(){
        $items = Item::inRandomOrder()->take(3)->get();
        return $items;
    }
}