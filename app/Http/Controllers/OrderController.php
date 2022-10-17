<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\UseCases\Order\Create as CreateUseCase;

class OrderController extends Controller
{
    // public function order(OrderRequest $request, CreateUsecase $createUC){
    //     $input = $request->getContent();
    //     return response(var_dump($request->input('orders')));
    // }

    public function order(OrderRequest $request){
        $input = $request->getContent();
        return response(var_dump($request->input('orders')));
    }

    public function aiueo(Request $request){
        $input = $request->getContent();
        return response(var_dump($request->input('orders')));
    }
}
