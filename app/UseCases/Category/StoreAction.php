<?php

namespace App\UseCases\Category;

use App\Models\Category;

class StoreAction
{
    public function __invoke(Category $category)
    {
        assert($category->exists);
        $category->save();
        
        return $category;
    }
}
