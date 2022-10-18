<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\UseCases\Order\Create as CreateUseCase;

class OrderController extends Controller
{
    public function order(OrderRequest $request, CreateUseCase $createUC){
        $createUC->invoke($request);
    }
}
