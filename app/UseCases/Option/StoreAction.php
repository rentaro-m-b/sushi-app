<?php

namespace App\UseCases\Option;

use App\Models\Option;

class StoreAction
{
    public function __invoke(Option $option)
    {
        assert($option->exists);
        $option->save();

        return $option;
    }
}
