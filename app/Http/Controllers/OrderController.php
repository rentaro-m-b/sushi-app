<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\UseCases\Order\Create as CreateUseCase;


class OrderController extends Controller
{
    public function order(OrderRequest $request, CreateUseCase $createUC){
        //何もエラーがなければ$resultにはtrue,どこかでエラーが生じていたらfalseが入る
        $result = $createUC($request);
        return response(var_dump($result));
    }
}
