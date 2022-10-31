<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\Item\StoreRequest;
use App\UseCases\Item\StoreAction;
use App\Http\Requests\Item\DestroyRequest;
use App\UseCases\Item\DestroyAction;

class ItemController extends Controller
{
    public function store(StoreRequest $request, StoreAction $action)
    {
        $data = $request->makeItem();
        $action($data);
        $responseBody = array('message' => 'ok');
        $responseCode = 200;

        return response($responseBody, $responseCode)
            ->header('Content-Type', 'application/json');
    }

    public function destroy(DestroyAction $action, Item $item)
    {
        $action($item);
        $responseBody = array('message' => 'ok');
        $responseCode = 200;

        return response($responseBody, $responseCode)
            ->header('Content-Type', 'application/json');
    }
}
