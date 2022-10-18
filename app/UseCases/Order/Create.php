<?php
namespace App\UseCases\Order;

use App\Http\Requests\OrderRequest;
use App\Models\Order;

class Create{
    public function invoke(OrderRequest $request){
        $table_id = $request->input('table_id');
        $orders = $request->input('orders');
        foreach($orders as $order){
            //orderは配列(連想配列)
            Order::create([
                'item_id' => $order["item_id"],
                'table_id' => $table_id,
                'paid' => false
            ]);
        }
    }
}