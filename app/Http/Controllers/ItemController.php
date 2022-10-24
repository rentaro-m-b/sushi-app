<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Item\StoreRequest;
use App\Models\Item;
use App\UseCases\Item\StoreAction;
use App\Http\Resources\ItemResource;

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
}
