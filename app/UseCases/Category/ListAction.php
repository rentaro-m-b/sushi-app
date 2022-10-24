<?php

namespace App\UseCases\Category;

use App\Models\Category;

class ListAction
{
    public function __invoke()
    {
        $categories = Category::orderBy('id')->get();
        
        return $categories;
    }
}
