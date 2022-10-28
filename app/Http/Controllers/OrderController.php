<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\DeleteOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\UseCases\Order\Create as CreateUseCase;
use App\UseCases\Order\Delete as DeleteUseCase;

class OrderController extends Controller
{
    public function order(OrderRequest $request, CreateUseCase $create){
        //何もエラーがなければ$resultにはtrue,どこかでエラーが生じていたらfalseが入る
        $result = $create($request);
        return response(var_dump($result));
    }

    public function delete_order(DeleteOrderRequest $request, int $customer_id, int $order_id, DeleteUseCase $delete){
        //ルートモデルバインディングだと、FromRequestによるバリデーションがかけられないため、customer_id, order_idはintで受け取る。
        $result = $delete(Customer::find($customer_id), Order::find($order_id));
        //そのままメッセージを返すとエラーの場合でもステータスコードが200になってしまうので、配列のキーでエラーかどうかを表現し、それでレスポンスを変更する。
        if(array_key_exists(0, $result)){
            return response($result[0], 400);
        }else{
            return response($result[1]);
        }
    }
}
