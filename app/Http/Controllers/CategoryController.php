<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\UseCases\Category\StoreAction;
use App\UseCases\Category\UpdateAction;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = Category::orderByDesc('created_at')->get();
        $responseBody = $categories;
        $responseCode = 200;

        return response($responseBody, $responseCode)
            ->header('Content-Type', 'application/json');
    }
    public function store(StoreRequest $request, StoreAction $action)
    {
        $data = $request->makeCategory();

        return new CategoryResource($action($data));
    }

    public function update(UpdateRequest $request, Category $category, UpdateAction $action)
    {   
        $data = $request->makeCategory();

        return new CategoryResource($action($data, $category));
    }
}
