<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\StoreRequest;
use App\UseCases\Item\StoreAction;

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
