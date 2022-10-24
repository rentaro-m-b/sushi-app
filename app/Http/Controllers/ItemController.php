<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Item\ListRequest;
use App\Models\Item;
use App\UseCases\Item\ListAction;
use App\Models\Category;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    public function list(ListRequest $request, ListAction $action)
    {
        $data = $request->makeCategory();
        return $action($data);
        
        return ItemResource::collection($action());
    }
}