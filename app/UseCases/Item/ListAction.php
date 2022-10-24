<?php

namespace App\UseCases\Item;

use App\Models\Item;

class ListAction
{
    public function __invoke($data)
    {
        $categories = Item::whereLike('category_id', $data['category_id'])->get();
        
        return $categories;
    }
}