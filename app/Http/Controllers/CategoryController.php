<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\UseCases\Category\StoreAction;
use App\UseCases\Category\UpdateAction;
use App\UseCases\Category\ListAction;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function list(ListAction $action)
    {
        return CategoryResource::collection($action());
    }

    public function store(StoreRequest $request, StoreAction $action)
    {
        $data = $request->makeCategory();
        $action($data);
        $responseBody = 'ok';
        $responseCode = 200;

        return [
            $responseBody,
            $responseCode
        ];
    }

    public function update(UpdateRequest $request, Category $category, UpdateAction $action)
    {   
        $data = $request->makeCategory();
        $action($data, $category);
        $responseBody = 'ok';
        $responseCode = 200;

        return [
            $responseBody,
            $responseCode
        ];
    }
}
