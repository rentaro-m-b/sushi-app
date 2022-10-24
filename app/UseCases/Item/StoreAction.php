<?php

namespace App\UseCases\Item;

use App\Models\Item;

class StoreAction
{
    public function __invoke(Item $item)
    {
        assert($item->exists);
        $item->save();

        return $item;
    }
}