<?php

namespace App\UseCases\Category;

use App\Models\Category;

class UpdateAction
{
    public function __invoke($data, $category)
    {
        assert($category->exists);
        $category->name = $data['name'];
        $category->save();
        
        return $category;
    }
}
