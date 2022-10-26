<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\UseCases\Order\Create as CreateUseCase;

use App\Models\Itemoption;
use App\Models\Item;
use App\Models\Order;


class OrderController extends Controller
{
    public function order(OrderRequest $request, CreateUseCase $create){
        //何もエラーがなければ$resultにはtrue,どこかでエラーが生じていたらfalseが入る
        $result = $create($request);
        return response(var_dump($result));
    }
}
