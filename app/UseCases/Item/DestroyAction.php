<?php

namespace App\UseCases\Item;

use App\Models\Item;

class DestroyAction
{
    public function __invoke(Item $item)
    {
        assert($item->exists);
        $item->on_sale = 0;
        $item->save();
    }
}
