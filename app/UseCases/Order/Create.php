<?php
namespace App\UseCases\Order;

use App\Http\Requests\OrderRequest;
use App\Models\Order;

class Create{
    public function invoke(OrderRequest $request){
        $table_id = $request->input('table_id');
        $orders = $request->input('orders');

        //適切な注文かどうか(option, volumeに関する)検証
        if(!Order::check_orders($orders)){
            return false;
        }

        foreach($orders as $order){
            Order::create([
                'item_id' => $order['item_id'],
                'table_id' => $table_id,
                'paid' => false
            ]);
        }

        return true;
    }
}