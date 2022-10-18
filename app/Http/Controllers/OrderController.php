<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\UseCases\Order\Create as CreateUseCase;
use App\Models\ItemOption;
use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;


class OrderController extends Controller
{
    public function order(OrderRequest $request, CreateUseCase $createUC){
        $result = $createUC->invoke($request);
        return response(var_dump($result));
    }
}