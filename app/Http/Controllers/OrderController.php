<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\UseCases\Order\Create as CreateUseCase;

class OrderController extends Controller
{
    public function order(OrderRequest $request, CreateUsecase $createUC){
        $createUC->invoke($request);
    }

    public function aiueo(Request $request){
        return response("アイウエオ");
    }
}
